package SERVER;

import java.io.*;
import java.net.Socket;
import java.sql.*;

public class ClientHandler implements Runnable {
    private final Socket socket;
    private Connection connection;
    private PrintWriter writer;
    private BufferedReader reader;
    private String loggedInUsername = null;
    private String participantID = null;
    private String userEmail = null;
    private static final String USER_ID = "SELECT participantID, email FROM participant WHERE userName=?";

    public ClientHandler(Socket socket) {
        this.socket = socket;
    }

    @Override
    public void run() {
        try {
            connection = Database.databaseConnection();
            reader = new BufferedReader(new InputStreamReader(socket.getInputStream()));
            writer = new PrintWriter(socket.getOutputStream(), true);

            WelcomeMessage.displayWelcomeMessage(writer);

            String command;
            while ((command = reader.readLine()) != null) {
                try {
                    handleCommand(command);
                } catch (SQLException e) {
                    System.err.println("Database error while handling command: " + command);
                    e.printStackTrace();
                    writer.println("An error occurred. Please try again later.");
                } catch (IOException e) {
                    System.err.println("I/O error while handling command: " + command);
                    e.printStackTrace();
                    break;  // Break the loop on I/O error as the connection might be compromised
                }
            }
        } catch (IOException | SQLException e) {
            System.err.println("Error in ClientHandler: " + e.getMessage());
            e.printStackTrace();
        } finally {
            cleanup();
        }
    }

    private void handleCommand(String command) throws IOException, SQLException {
        switch (command.toLowerCase().trim()) {
            case "register":
                Registration.register(connection, writer, reader);
                break;
            case "loginrepresentative":
                handleRepresentativeLogin();
                break;
            case "loginparticipant":
                handleParticipantLogin();
                break;
            case "viewchallenges":
                handleViewChallenges();
                break;
            case "logoutrepresentative":
            case "logoutparticipant":
                logout();
                break;
            case "exitparticipant":
                logout();
                throw new IOException("Client requested exit");
            default:
                writer.println("Invalid command. Available commands: register, loginrepresentative, loginparticipant, viewchallenges, logout, exit");
                break;
        }
    }

    private void handleRepresentativeLogin() throws IOException {
        writer.println("Enter: username password");
        String[] loginDetails = reader.readLine().split("\\s+");
        if (loginDetails.length != 2) {
            writer.println("Invalid login format.");
            return;
        }
        if (Registration.isValidRepresentative(loginDetails[0], loginDetails[1], connection)) {
            writer.println("Login successful");
            loggedInUsername = loginDetails[0];
            try {
                handleViewApplicants();
            } catch (SQLException e) {
                throw new RuntimeException(e);
            }
        } else {
            writer.println("Login failed: Invalid name or password.");
        }
    }

    private void handleViewApplicants() throws IOException, SQLException {
        writer.println("Enter 'viewApplicants' to view the applicants");
        if (reader.readLine().equalsIgnoreCase("viewApplicants")) {
            String repSchoolNumber = Registration.getRepresentativeSchoolNumber(loggedInUsername, connection);
            if (repSchoolNumber != null) {
                boolean applicantsFound = Registration.viewApplicants(writer, repSchoolNumber);
                if (applicantsFound) {
                    handleVerification();
                } else {
                    writer.println("No applicants to verify. Logging out.");
                }
            } else {
                writer.println("Error: Unable to retrieve school registration number for the representative.");
            }
        } else {
            writer.println("Invalid command.");
        }
        logout();
    }

    private void handleVerification() throws IOException {
        writer.println("Enter 'verify YES/NO username' to verify applicants or 'exit' to finish.");
        String command;
        while ((command = reader.readLine()) != null) {
            if (command.startsWith("verify")) {
                Registration.handleVerify(command, writer, connection);
            } else if (command.equalsIgnoreCase("exit")) {
                break;
            } else {
                writer.println("Invalid command. Use 'verify YES/NO username' or 'exit'.");
            }
        }
        writer.println("Verification process completed. Logging out.");
    }

    private void handleParticipantLogin() {
        loggedInUsername = Login.login(connection, writer, reader);
        if (loggedInUsername != null) {
            setParticipantIDAndEmail();
            writer.println("Type 'viewchallenges' to see available challenges.");
        }
    }

    private void handleViewChallenges() throws SQLException {
        if (loggedInUsername != null) {
            ChooseChallenge.viewChallenges(connection, writer, reader, participantID);
        } else {
            writer.println("You must login first.");
        }
    }

    private void logout() {
        if (loggedInUsername != null) {
            if (participantID != null) {
                generateAndSendReport();
            }
            loggedInUsername = null;
            participantID = null;
            userEmail = null;
            writer.println("You have been logged out.");
        } else {
            writer.println("You are not currently logged in.");
        }
    }

    private void generateAndSendReport() {
        ReportGenerator.generateReport(connection, participantID, writer);
        if (userEmail != null) {
            String detailedReport = ReportGenerator.getDetailedReportForEmail(connection, participantID);
            EmailSender.sendReportEmail(userEmail, detailedReport);
            writer.println("A detailed report has been sent to your email: " + userEmail);
        } else {
            writer.println("Unable to send detailed report via email. Email address not available.");
        }
    }

    private void setParticipantIDAndEmail() {
        try (PreparedStatement statement = connection.prepareStatement(USER_ID)) {
            statement.setString(1, loggedInUsername);
            ResultSet rs = statement.executeQuery();
            if (rs.next()) {
                participantID = rs.getString("participantID");
                userEmail = rs.getString("email");
            }
        } catch (SQLException e) {
            System.err.println("Error setting participant ID and email: " + e.getMessage());
        }
    }

    private void cleanup() {
        try {
            if (reader != null) reader.close();
            if (writer != null) writer.close();
            if (socket != null) socket.close();
        } catch (IOException e) {
            System.err.println("Error closing client resources: " + e.getMessage());
        }
    }
}