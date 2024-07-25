package SERVER;

import java.io.*;
import java.sql.*;

public class Registration {

    public static void register(Connection connection, PrintWriter writer, BufferedReader reader) throws IOException, SQLException {
        writer.println("Enter: username firstname lastname email dateOfBirth schoolRegistrationNumber imageFile");
        String[] registrationDetails = reader.readLine().split("\\s+");

        if (registrationDetails.length != 7) {
            writer.println("Invalid registration format.");
            return;
        }

        String username = registrationDetails[0];
        String firstname = registrationDetails[1];
        String lastname = registrationDetails[2];
        String email = registrationDetails[3];
        String dateOfBirth = registrationDetails[4];
        String schoolRegistrationNumber = registrationDetails[5];
        String imageFile = registrationDetails[6];

        if (!isValidSchoolRegistrationNumber(schoolRegistrationNumber, connection)) {
            writer.println("Invalid schoolRegistrationNumber. Please try again.");
            return;
        }

        if (isRejected(schoolRegistrationNumber, connection)) {
            writer.println("Registration denied: cannot register under this school.");
            return;
        }

        savePupilRecordToFile(username, firstname, lastname, email, dateOfBirth, schoolRegistrationNumber, imageFile);
        writer.println("Pupil record saved successfully.");

        String repEmail = getRepresentativeEmailBySchoolNumber(schoolRegistrationNumber, connection);
        if (repEmail != null) {
            EmailSender_Registration.sendVerificationRequestEmail(repEmail, firstname);
        }
    }

    public static boolean isValidRepresentative(String repName, String repPassword, Connection connection) {
        try (PreparedStatement stmt = connection.prepareStatement("SELECT COUNT(*) FROM school_representative WHERE name = ? AND password = ?")) {
            stmt.setString(1, repName);
            stmt.setString(2, repPassword);
            ResultSet rs = stmt.executeQuery();
            return rs.next() && rs.getInt(1) > 0;
        } catch (SQLException e) {
            System.err.println("Error validating representative: " + e.getMessage());
            return false;
        }
    }

    public static void viewApplicants(PrintWriter writer) {
        String filePath = "pupil_records.txt";
        try (BufferedReader reader = new BufferedReader(new FileReader(filePath))) {
            String currentLine;
            while ((currentLine = reader.readLine()) != null) {
                writer.println(currentLine);
            }
            writer.println("End of list");
            writer.flush();
        } catch (IOException e) {
            writer.println("Error reading applicant records: " + e.getMessage());
        }
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
                String[] fields = currentLine.split(",");
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

    private static void saveParticipantToDatabase(String[] fields, Connection connection) throws SQLException {
        String sql = "INSERT INTO participant (firstname, lastname, email, schoolRegistrationNumber) VALUES (?, ?, ?, ?)";
        try (PreparedStatement stmt = connection.prepareStatement(sql)) {
            stmt.setString(1, fields[1]);
            stmt.setString(2, fields[2]);
            stmt.setString(3, fields[3]);
            stmt.setString(4, fields[5]);
            stmt.executeUpdate();
        }
    }

    private static void saveRejectedToDatabase(String[] fields, Connection connection) throws SQLException {
        String sql = "INSERT INTO rejected (firstname, lastname, email, schoolRegistrationNumber) VALUES (?, ?, ?, ?)";
        try (PreparedStatement stmt = connection.prepareStatement(sql)) {
            stmt.setString(1, fields[1]);
            stmt.setString(2, fields[2]);
            stmt.setString(3, fields[3]);
            stmt.setString(4, fields[5]);
            stmt.executeUpdate();
        }
    }

    public static boolean isValidSchoolRegistrationNumber(String schoolRegistrationNumber, Connection connection) throws SQLException {
        try (PreparedStatement stmt = connection.prepareStatement("SELECT COUNT(*) FROM school WHERE schoolRegistrationNumber = ?")) {
            stmt.setString(1, schoolRegistrationNumber);
            ResultSet rs = stmt.executeQuery();
            return rs.next() && rs.getInt(1) > 0;
        }
    }

    public static boolean isRejected(String schoolRegistrationNumber, Connection connection) throws SQLException {
        try (PreparedStatement stmt = connection.prepareStatement("SELECT COUNT(*) FROM rejected WHERE schoolRegistrationNumber = ?")) {
            stmt.setString(1, schoolRegistrationNumber);
            ResultSet rs = stmt.executeQuery();
            return rs.next() && rs.getInt(1) > 0;
        }
    }

    public static void savePupilRecordToFile(String username, String firstname, String lastname, String email, String dateOfBirth, String schoolRegistrationNumber, String imageFile) {
        String filePath = "pupil_records.txt";
        try (FileWriter fw = new FileWriter(filePath, true);
             BufferedWriter bw = new BufferedWriter(fw);
             PrintWriter out = new PrintWriter(bw)) {
            out.println(username + "," + firstname + "," + lastname + "," + email + "," + dateOfBirth + "," + schoolRegistrationNumber + "," + imageFile);
        } catch (IOException e) {
            System.err.println("Error saving pupil record to file: " + e.getMessage());
        }
    }

    public static String getRepresentativeEmailBySchoolNumber(String schoolRegistrationNumber, Connection connection) throws SQLException {
        try (PreparedStatement stmt = connection.prepareStatement("SELECT repEmail FROM school_representative WHERE schoolRegistrationNumber = ?")) {
            stmt.setString(1, schoolRegistrationNumber);
            ResultSet rs = stmt.executeQuery();
            if (rs.next()) {
                return rs.getString("repEmail");
            }
        }
        return null;
    }
}