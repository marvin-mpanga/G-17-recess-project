package SERVER;

import java.io.*;
import java.nio.file.Files;
import java.sql.*;

public class Registration {

    public static void register(Connection connection, PrintWriter writer, BufferedReader reader) throws IOException, SQLException {
        boolean registrationSuccess = false;
        while (!registrationSuccess) {
            writer.println("Enter: username firstname lastname email password dateOfBirth(YYYY-MM-DD) schoolRegistrationNumber");
            writer.println("Note: If your school registration number contains spaces, enclose it in quotes.");
            String input = reader.readLine();

// Split the input, keeping quoted parts together
            String[] registrationDetails = input.split("\\s+(?=(?:[^\"]*\"[^\"]*\")*[^\"]*$)");

// Remove quotes from the last element if present
            if (registrationDetails.length > 0) {
                int lastIndex = registrationDetails.length - 1;
                registrationDetails[lastIndex] = registrationDetails[lastIndex].replaceAll("\"", "");
            }

            if (registrationDetails.length != 7) {
                writer.println("Invalid registration format. Please try again.");
                continue;
            }

            String username = registrationDetails[0];
            String firstname = registrationDetails[1];
            String lastname = registrationDetails[2];
            String email = registrationDetails[3];
            String password=registrationDetails[4];
            String dateOfBirth = registrationDetails[5];
            String schoolRegistrationNumber = registrationDetails[6];

            if (!isValidSchoolRegistrationNumber(schoolRegistrationNumber, connection)) {
                writer.println("Invalid schoolRegistrationNumber. Please try again.");
                continue;
            }

            if (isRejected(schoolRegistrationNumber, connection)) {
                writer.println("Registration denied: cannot register under this school.");
                return;
            }

            writer.println("Enter the full path to your image file:");
            String imageFilePath = reader.readLine().trim();

            File imageFile = new File(imageFilePath);
            if (!imageFile.exists() || !imageFile.isFile()) {
                writer.println("Image file not found. Please check the file path and try again.");
                continue;
            }

            savePupilRecordToFile(username, firstname, lastname, email, password, dateOfBirth, schoolRegistrationNumber, imageFilePath);
            writer.println("Pupil record saved successfully.");

            String repEmail = getRepresentativeEmailBySchoolNumber(schoolRegistrationNumber, connection);
            if (repEmail != null) {
                EmailSender_Registration.sendVerificationRequestEmail(repEmail, firstname);
            }

            registrationSuccess = true;
        }
    }

    public static boolean isValidRepresentative(String repName, String repPassword, Connection connection) {
        try (PreparedStatement stmt = connection.prepareStatement("SELECT COUNT(*) FROM representative WHERE name = ? AND password = ?")) {
            stmt.setString(1, repName);
            stmt.setString(2, repPassword);
            ResultSet rs = stmt.executeQuery();
            return rs.next() && rs.getInt(1) > 0;
        } catch (SQLException e) {
            System.err.println("Error validating representative: " + e.getMessage());
            return false;
        }
    }

    public static boolean viewApplicants(PrintWriter writer, String representativeSchoolNumber) {
        String filePath = "pupil_records.txt";
        boolean foundRecords = false;
        try (BufferedReader reader = new BufferedReader(new FileReader(filePath))) {
            String currentLine;
            while ((currentLine = reader.readLine()) != null) {
                String[] fields = currentLine.split("\\|");
                if (fields.length >= 6 && fields[6].equals(representativeSchoolNumber)) {
                    writer.println(currentLine);
                    foundRecords = true;
                }
            }
            if (!foundRecords) {
                writer.println("No applicants found for your school.");
            } else {
                writer.println("End of list");
            }
            writer.flush();
        } catch (IOException e) {
            writer.println("Error reading applicant records: " + e.getMessage());
        }
        return foundRecords;
    }

    public static void handleVerify(String command, PrintWriter writer, Connection connection) {
        String[] verificationParts = command.split("\\s+", 3);
        if (verificationParts.length != 3) {
            writer.println("Invalid command format. Use 'verify YES/NO username'.");
            return;
        }

        String response = verificationParts[1];
        String username = verificationParts[2];

        if (response.equalsIgnoreCase("YES")) {
            verifyPupilRecord(username, true, writer, connection);
        } else if (response.equalsIgnoreCase("NO")) {
            verifyPupilRecord(username, false, writer, connection);
        } else {
            writer.println("Invalid response. Use YES or NO.");
        }
    }

    private static void verifyPupilRecord(String username, boolean isVerified, PrintWriter writer, Connection connection) {
        String filePath = "pupil_records.txt";
        File tempFile = new File("temp_pupil_records.txt");

        try (BufferedReader reader = new BufferedReader(new FileReader(filePath));
             PrintWriter fileWriter = new PrintWriter(new FileWriter(tempFile))) {

            String currentLine;
            boolean found = false;
            while ((currentLine = reader.readLine()) != null) {
                String[] fields = currentLine.split("\\|");
                if (fields[0].equalsIgnoreCase(username)) {
                    found = true;
                    if (isVerified) {
                        saveParticipantToDatabase(fields, connection);
                        EmailSender_Registration.sendVerificationStatusEmail(fields[3], true);
                    } else {
                        saveRejectedToDatabase(fields, connection);
                        EmailSender_Registration.sendVerificationStatusEmail(fields[3], false);
                    }
                } else {
                    fileWriter.println(currentLine);
                }
            }

            if (!found) {
                writer.println("No record found for username: " + username);
                return;
            }

        } catch (IOException | SQLException e) {
            writer.println("Error processing pupil record: " + e.getMessage());
            return;
        }

        if (!replaceFile(filePath, tempFile)) {
            writer.println("Error updating pupil records file.");
            return;
        }

        writer.println("Pupil record for " + username + " " + (isVerified ? "verified" : "rejected") + " successfully.");
    }

    private static boolean replaceFile(String originalPath, File tempFile) {
        File originalFile = new File(originalPath);
        return originalFile.delete() && tempFile.renameTo(originalFile);
    }

    private static void saveParticipantToDatabase(String[] fields, Connection connection) throws SQLException, IOException {
        if (fields.length < 7) {
            throw new IllegalArgumentException("Insufficient data in fields array. Expected at least 8 elements, but got " + fields.length);
        }

        String sql = "INSERT INTO participant (userName, firstname, lastname, email, password, DOB, registrationNumber, imageFile) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        try (PreparedStatement stmt = connection.prepareStatement(sql)) {
            stmt.setString(1, fields[0]); // userName
            stmt.setString(2, fields[1]); // firstname
            stmt.setString(3, fields[2]); // lastname
            stmt.setString(4, fields[3]); // email
            stmt.setString(5, fields[4]); // password
            stmt.setString(6, fields[5]); // dateOfBirth
            stmt.setString(7, fields[6]); // registrationNumber

            // Read the image file and set it as a BLOB
            String imagePath = fields[7];
            File imageFile = new File(imagePath);
            if (imageFile.exists()) {
                byte[] fileContent = Files.readAllBytes(imageFile.toPath());
                stmt.setBlob(8, new ByteArrayInputStream(fileContent), fileContent.length);
            } else {
                stmt.setNull(8, java.sql.Types.BLOB);
                System.err.println("Image file not found: " + imagePath);
            }

            stmt.executeUpdate();
        }
    }
    private static void saveRejectedToDatabase(String[] fields, Connection connection) throws SQLException {
        String sql = "INSERT INTO rejected (firstname, lastname, email, registrationNumber) VALUES (?, ?, ?, ?)";
        try (PreparedStatement stmt = connection.prepareStatement(sql)) {
            stmt.setString(1, fields[1]);
            stmt.setString(2, fields[2]);
            stmt.setString(3, fields[3]);
            stmt.setString(4, fields[5]);
            stmt.executeUpdate();
        }
    }

    public static boolean isValidSchoolRegistrationNumber(String schoolRegistrationNumber, Connection connection) throws SQLException {
        String sql = "SELECT COUNT(*) FROM school WHERE TRIM(UPPER(school.registrationNumber)) = TRIM(UPPER(?))";
        try (PreparedStatement stmt = connection.prepareStatement(sql)) {
            stmt.setString(1, schoolRegistrationNumber);
            ResultSet rs = stmt.executeQuery();
            return rs.next() && rs.getInt(1) > 0;
        }
    }

    public static boolean isRejected(String schoolRegistrationNumber, Connection connection) throws SQLException {
        try (PreparedStatement stmt = connection.prepareStatement("SELECT COUNT(*) FROM rejected WHERE rejected.registrationNumber = ?")) {
            stmt.setString(1, schoolRegistrationNumber);
            ResultSet rs = stmt.executeQuery();
            return rs.next() && rs.getInt(1) > 0;
        }
    }

    private static void savePupilRecordToFile(String username, String firstname, String lastname, String email, String password, String dateOfBirth, String schoolRegistrationNumber, String imageFile) {
        String filePath = "pupil_records.txt";
        try (FileWriter fw = new FileWriter(filePath, true);
             BufferedWriter bw = new BufferedWriter(fw);
             PrintWriter out = new PrintWriter(bw)) {
            out.println(username + "|" + firstname + "|" + lastname + "|" + email + "|" + password + "|" + dateOfBirth + "|" + schoolRegistrationNumber + "|" + imageFile);
        } catch (IOException e) {
            System.err.println("Error saving pupil record to file: " + e.getMessage());
        }
    }

    public static String getRepresentativeEmailBySchoolNumber(String schoolRegistrationNumber, Connection connection) throws SQLException {
        try (PreparedStatement stmt = connection.prepareStatement("SELECT email FROM representative WHERE registrationNumber = ?")) {
            stmt.setString(1, schoolRegistrationNumber);
            ResultSet rs = stmt.executeQuery();
            if (rs.next()) {
                return rs.getString("email");
            }
        }
        return null;
    }

    public static String getRepresentativeSchoolNumber(String repName, Connection connection) throws SQLException {
        try (PreparedStatement stmt = connection.prepareStatement("SELECT registrationNumber FROM representative WHERE name = ?")) {
            stmt.setString(1, repName);
            ResultSet rs = stmt.executeQuery();
            if (rs.next()) {
                return rs.getString("registrationNumber");
            }
        }
        return null;
    }
}