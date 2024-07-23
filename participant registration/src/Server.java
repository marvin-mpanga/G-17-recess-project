

import java.io.*;
import java.net.ServerSocket;
import java.net.Socket;
import java.sql.*;

public class Server {

    public static void main(String[] args) {
        int port = 2222; // The port number on which the server listens

        try (ServerSocket serverSocket = new ServerSocket(port)) {
            System.out.println("Server is listening on port " + port);

            while (true) {
                Socket socket = serverSocket.accept();
                System.out.println("New client connected");
                new ClientHandler(socket).start();
            }

        } catch (IOException ex) {
            ex.printStackTrace();
        }
    }
}

 class ClientHandler extends Thread {

    private final Socket socket;

    public ClientHandler(Socket socket) {
        this.socket = socket;
    }

    public void run() {
        try (BufferedReader input = new BufferedReader(new InputStreamReader(socket.getInputStream()));
             PrintWriter output = new PrintWriter(socket.getOutputStream(), true)) {

            String commandLine;
            while ((commandLine = input.readLine()) != null) {
                String[] parts = commandLine.split("\\s+");

                if ("register".equalsIgnoreCase(parts[0])) {
                    handleRegister(parts, output);
                } else if ("login".equalsIgnoreCase(parts[0])) {
                    handleLogin(parts, input, output);
                } else {
                    output.println("Invalid command.");
                }
            }

        } catch (IOException | SQLException ex) {
            ex.printStackTrace();
        }
    }

    private void handleRegister(String[] parts, PrintWriter output) throws SQLException {
        if (parts.length != 8) {
            output.println("Invalid registration format.");
            return;
        }
        String username = parts[1];
        String firstname = parts[2];
        String lastname = parts[3];
        String email = parts[4];
        String dateOfBirth = parts[5];
        String schoolRegistrationNumber = parts[6];
        String imageFile = parts[7];

        if (!isValidSchoolRegistrationNumber(schoolRegistrationNumber)) {
            output.println("Invalid schoolRegistrationNumber. Please try again.");
            return;
        }

        if (isRejected(schoolRegistrationNumber)) {
            output.println("Registration denied: cannot register under this school.");
            return;
        }

        savePupilRecordToFile(username, firstname, lastname, email, dateOfBirth, schoolRegistrationNumber, imageFile);
        output.println("Pupil record saved successfully.");

        // Send email to the school representative
        String repEmail = getRepresentativeEmailBySchoolNumber(schoolRegistrationNumber);
        if (repEmail != null) {
            EmailSender.sendVerificationRequestEmail(repEmail, firstname );
        }
    }

    private void handleLogin(String[] parts, BufferedReader input, PrintWriter output) throws IOException, SQLException {
        if (parts.length != 3) {
            output.println("Invalid login format.");
            return;
        }
        String repName = parts[1];
        String repPassword = parts[2];

        if (!isValidRepresentative(repName, repPassword)) {
            output.println("Login failed: Invalid name or password.");
            return;
        }
        output.println("Login successful");

        while (true) {
            String command = input.readLine();

            if (command==null) break;
            else if ("view applicants".equalsIgnoreCase(command)) {
                viewApplicants(output);
            }
            else if (command.startsWith("verify")) {
                handleVerify(command, output);
            } else {
                output.println("Invalid command.");
            }
        }
    }

    private void handleVerify(String command, PrintWriter output) throws SQLException {
        String[] verificationParts = command.split("\\s+", 3);

        if (verificationParts.length == 3) {
            String response = verificationParts[1];
            String username = verificationParts[2];

            if (response.equalsIgnoreCase("YES")) {
                verifyPupilRecord(username, true);
                output.println("Pupil record for " + username + " verified successfully.");

            } else if (response.equalsIgnoreCase("NO")) {
                verifyPupilRecord(username, false);
                output.println("Pupil record verification for " + username + " denied.");
            } else {
                output.println("Invalid command. Use YES/NO followed by username.");
            }
        } else {
            output.println("Invalid command format. Use YES/NO followed by username.");
        }
    }

    private boolean isRejected(String schoolRegistrationNumber) throws SQLException {
        String dbURL = "jdbc:mysql://localhost:3306/math_challenge";
        String user = "root";
        String pass = "";

        try (Connection conn = DriverManager.getConnection(dbURL, user, pass);
             PreparedStatement stmt = conn.prepareStatement("SELECT COUNT(*) FROM rejected WHERE schoolRegistrationNumber = ?")) {

            stmt.setString(1, schoolRegistrationNumber);
            ResultSet rs = stmt.executeQuery();

            return rs.next() && rs.getInt(1) > 0;
        }
    }

    private boolean isValidRepresentative(String name, String password) throws SQLException {
        String dbURL = "jdbc:mysql://localhost:3306/math_challenge";
        String user = "root";
        String pass = "";

        try (Connection conn = DriverManager.getConnection(dbURL, user, pass);
             PreparedStatement stmt = conn.prepareStatement("SELECT COUNT(*) FROM school_representative WHERE name = ? AND password = ?")) {

            stmt.setString(1, name);
            stmt.setString(2, password);
            ResultSet rs = stmt.executeQuery();

            return rs.next() && rs.getInt(1) > 0;
        }
    }

    private boolean isValidSchoolRegistrationNumber(String schoolRegistrationNumber) throws SQLException {
        String dbURL = "jdbc:mysql://localhost:3306/math_challenge";
        String user = "root";
        String password = "";

        try (Connection conn = DriverManager.getConnection(dbURL, user, password);
             PreparedStatement stmt = conn.prepareStatement("SELECT COUNT(*) FROM school WHERE schoolRegistrationNumber = ?")) {

            stmt.setString(1, schoolRegistrationNumber);
            ResultSet rs = stmt.executeQuery();

            return rs.next() && rs.getInt(1) > 0;
        }
    }

    private void savePupilRecordToFile(String username, String firstname, String lastname, String email, String dateOfBirth, String schoolRegistrationNumber, String imageFile) {
        String filePath = "pupil_records.txt";

        try (FileWriter fw = new FileWriter(filePath, true);
             BufferedWriter bw = new BufferedWriter(fw);
             PrintWriter out = new PrintWriter(bw)) {

            out.println(username + "," + firstname + "," + lastname + "," + email + "," + dateOfBirth + "," + schoolRegistrationNumber + "," + imageFile);

        } catch (IOException e) {
            e.printStackTrace();
        }
    }

    private void viewApplicants(PrintWriter output) {
        String filePath = "pupil_records.txt";

        try (BufferedReader reader = new BufferedReader(new FileReader(filePath))) {
            String currentLine;

            while ((currentLine = reader.readLine()) != null) {
                output.println(currentLine);
            }

            output.println("end of list");

        } catch (IOException e) {
            e.printStackTrace();
        }
    }

    private void verifyPupilRecord(String username, boolean isVerified) throws SQLException {
        String filePath = "pupil_records.txt";
        File tempFile = new File("temp_pupil_records.txt");

        try (BufferedReader reader = new BufferedReader(new FileReader(filePath));
             PrintWriter writer = new PrintWriter(new FileWriter(tempFile))) {

            String currentLine;
            boolean found = false;
            while ((currentLine = reader.readLine()) != null) {
                String[] fields = currentLine.split(",");
                if (fields[0].equalsIgnoreCase(username)) {
                    found = true;
                    if (isVerified) {
                        saveParticipantToDatabase(fields[1], fields[2], fields[3], fields[5]);
                        EmailSender.sendVerificationStatusEmail(fields[3], true);
                    } else {
                        saveRejectedToDatabase(fields[1], fields[2], fields[3], fields[5]);
                        EmailSender.sendVerificationStatusEmail(fields[3], false);
                    }
                } else {
                    writer.println(currentLine);
                }
            }

            if (!found) {
                System.err.println("No record for this username: " + username);
                return;
            }

        } catch (IOException e) {
            e.printStackTrace();
        }

        File originalFile = new File(filePath);
        if (originalFile.delete()) {
            if (!tempFile.renameTo(originalFile)) {
                System.err.println("Failed to rename temp file to original file");
            }
        } else {
            System.err.println("Failed to delete original file");
        }
    }

    private void saveRejectedToDatabase(String firstname, String lastname, String email, String schoolRegistrationNumber) throws SQLException {
        String dbURL = "jdbc:mysql://localhost:3306/math_challenge";
        String user = "root";
        String pass = "";

        try (Connection conn = DriverManager.getConnection(dbURL, user, pass);
             PreparedStatement stmt = conn.prepareStatement("INSERT INTO rejected (firstname, lastname, email, schoolRegistrationNumber) VALUES (?, ?, ?, ?)")) {

            stmt.setString(1, firstname);
            stmt.setString(2, lastname);
            stmt.setString(3, email);
            stmt.setString(4, schoolRegistrationNumber);
            stmt.executeUpdate();
        }
    }

    private void saveParticipantToDatabase(String firstname, String lastname, String email, String schoolRegistrationNumber) throws SQLException {
        String dbURL = "jdbc:mysql://localhost:3306/math_challenge";
        String user = "root";
        String pass = "";

        try (Connection conn = DriverManager.getConnection(dbURL, user, pass);
             PreparedStatement stmt = conn.prepareStatement("INSERT INTO participant (firstname, lastname, email, schoolRegistrationNumber) VALUES (?, ?, ?, ?)")) {

            stmt.setString(1, firstname);
            stmt.setString(2, lastname);
            stmt.setString(3, email);
            stmt.setString(4, schoolRegistrationNumber);
            stmt.executeUpdate();
        }
    }

    private String getRepresentativeEmailBySchoolNumber(String schoolRegistrationNumber) throws SQLException {
        String dbURL = "jdbc:mysql://localhost:3306/math_challenge";
        String user = "root";
        String pass = "";

        try (Connection conn = DriverManager.getConnection(dbURL, user, pass);
             PreparedStatement stmt = conn.prepareStatement("SELECT repEmail FROM school_representative WHERE schoolRegistrationNumber = ?")) {

            stmt.setString(1, schoolRegistrationNumber);
            ResultSet rs = stmt.executeQuery();

            if (rs.next()) {
                return rs.getString("repEmail");
            }
        }

        return null;
    }
}