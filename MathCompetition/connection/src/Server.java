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

            String command = input.readLine();

            if ("register".equalsIgnoreCase(command)) {
                // Handle pupil registration
                String username = input.readLine();
                String firstname = input.readLine();
                String lastname = input.readLine();
                String dateOfBirth = input.readLine();
                String schoolRegistrationNumber = input.readLine();
                String imageFile = input.readLine();

                // Check if the schoolRegistrationNumber is valid
                if (schoolRegistrationNumber == null || !isValidSchoolRegistrationNumber(schoolRegistrationNumber)) {
                    output.println("Invalid schoolRegistrationNumber.");
                    return; // Exit the method or handle the error appropriately
                }

                // Save pupil record to file
                savePupilRecordToFile(username, firstname, lastname, dateOfBirth, schoolRegistrationNumber, imageFile);
                output.println("Pupil record saved successfully.");

            } else if ("login".equalsIgnoreCase(command)) {
                // Authenticate school representative
                String repName = input.readLine();
                String repPassword = input.readLine();

                if (!isValidRepresentative(repName, repPassword)) {
                    output.println("Login failed: Invalid name or password");
                    return;
                }
                output.println("Login successful");

                // Waiting for "view applicants" command
                command = input.readLine();
                if ("view applicants".equalsIgnoreCase(command)) {
                    viewApplicants(output);
                } else {
                    output.println("Invalid command.");
                    return;
                }

                while ((command = input.readLine()) != null) {
                    if ("verify".equalsIgnoreCase(command)) {
                        String verificationCommand = input.readLine();
                        String[] parts = verificationCommand.split(" ");
                        if (parts.length == 2) {
                            String response = parts[0];
                            String username = parts[1];

                            if ("YES".equalsIgnoreCase(response)) {
                                verifyPupilRecord(username, true);
                                output.println("Pupil record for " + username + " verified successfully.");
                            } else if ("NO".equalsIgnoreCase(response)) {
                                verifyPupilRecord(username, false);
                                output.println("Pupil record verification for " + username + " denied.");
                            } else {
                                output.println("Invalid command. Use YES/NO followed by username.");
                            }
                        } else {
                            output.println("Invalid command format. Use YES/NO followed by username.");
                        }
                    }
                }
            }

        } catch (IOException | SQLException ex) {
            ex.printStackTrace();
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

    private void savePupilRecordToFile(String username, String firstname, String lastname, String dateOfBirth, String schoolRegistrationNumber, String imageFile) {
        String filePath = "pupil_records.txt";

        try (FileWriter fw = new FileWriter(filePath, true);
             BufferedWriter bw = new BufferedWriter(fw);
             PrintWriter out = new PrintWriter(bw)) {

            out.println(username + "," + firstname + "," + lastname + "," + dateOfBirth + "," + schoolRegistrationNumber + "," + imageFile);

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
                        saveParticipantToDatabase(fields[1], fields[2], fields[4]);
                        // Do not write the verified record back to the file
                    } else {
                        saveRejectedToDatabase(fields[1], fields[2], fields[4]);
                        // Do not write the rejected record back to the file
                    }
                } else {
                    writer.println(currentLine);
                }
            }

            if (!found) {
                System.err.println("Pupil record not found for username: " + username);
            }

        } catch (IOException e) {
            e.printStackTrace();
        }

        // Ensure the original file is deleted and the temp file is renamed properly
        File originalFile = new File(filePath);
        if (originalFile.delete()) {
            if (!tempFile.renameTo(originalFile)) {
                System.err.println("Failed to rename temp file to original file");
            }
        } else {
            System.err.println("Failed to delete original file");
        }
    }


    private void saveRejectedToDatabase(String firstname, String lastname, String schoolRegistrationNumber) throws SQLException {
        String dbURL = "jdbc:mysql://localhost:3306/math_challenge";
        String user = "root";
        String pass = "";

        try (Connection conn = DriverManager.getConnection(dbURL, user, pass);
             PreparedStatement stmt = conn.prepareStatement("INSERT INTO rejected (firstname, lastname, schoolRegistrationNumber) VALUES (?, ?, ?)")) {

            stmt.setString(1, firstname);
            stmt.setString(2, lastname);
            stmt.setString(3, schoolRegistrationNumber);
            stmt.executeUpdate();
        }
    }

    private void saveParticipantToDatabase(String firstname, String lastname, String schoolRegistrationNumber) throws SQLException {
        String dbURL = "jdbc:mysql://localhost:3306/math_challenge";
        String user = "root";
        String pass = "";

        try (Connection conn = DriverManager.getConnection(dbURL, user, pass);
             PreparedStatement stmt = conn.prepareStatement("INSERT INTO participant (firstname, lastname, schoolRegistrationNumber) VALUES (?, ?, ?)")) {

            stmt.setString(1, firstname);
            stmt.setString(2, lastname);
            stmt.setString(3, schoolRegistrationNumber);
            stmt.executeUpdate();
        }
    }
}

