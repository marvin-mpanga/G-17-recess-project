package SERVER;

import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStreamReader;
import java.io.PrintWriter;
import java.net.Socket;
import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;

public class ClientHandler implements Runnable {
    private final Socket socket;
    private Connection connection;
    private PrintWriter writer;
    private BufferedReader reader;
    private String loggedInUsername = null;
    private String participantID = null;
    private String userEmail = null;
    public static final String USER_ID = "SELECT participantID, email FROM participant WHERE userName=?";

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
                switch (command.toLowerCase().trim()) {
                    case "login":
                        loggedInUsername = Login.login(connection, writer, reader);
                        if (loggedInUsername != null) {
                            setParticipantIDAndEmail();
                            writer.println("Type 'viewchallenges' to see available challenges.");
                        }
                        break;
                    case "viewchallenges":
                        if (loggedInUsername != null) {
                            ChooseChallenge.viewChallenges(connection, writer, reader, participantID);
                        } else {
                            writer.println("You must login first.");
                        }
                        break;
                    case "logout":
                        logout();
                        break;
                    case "exit":
                        logout();
                        return;
                    default:
                        writer.println("Invalid command. Available commands: login, viewchallenges, logout, exit");
                        break;
                }
            }
        } catch (IOException | SQLException e) {
            System.err.println("Error in ClientHandler: " + e.getMessage());
        } finally {
            cleanup();
        }
    }

    private void logout() {
        if (loggedInUsername != null) {
            generateAndSendReport();
            loggedInUsername = null;
            participantID = null;
            userEmail = null;
            writer.println("You have been logged out.");
        } else {
            writer.println("You are not currently logged in.");
        }
    }

    private void generateAndSendReport() {
        if (loggedInUsername != null) {
            ReportGenerator.generateReport(connection, participantID, writer);

            if (userEmail != null) {
                String detailedReport = ReportGenerator.getDetailedReportForEmail(connection, participantID);
                EmailSender.sendReportEmail(userEmail, detailedReport);

                writer.println("A detailed report has been sent to your email: " + userEmail);
            } else {
                writer.println("Unable to send detailed report via email. Email address not available.");
            }
        } else {
            writer.println("You are not currently logged in.");
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