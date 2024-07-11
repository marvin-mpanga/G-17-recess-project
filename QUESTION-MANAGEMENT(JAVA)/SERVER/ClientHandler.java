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

public class ClientHandler extends Thread {
    private Socket socket;
    private static Connection connection;
    private BufferedReader clientReader;
    private PrintWriter writer;
    private String loggedInUsername = null;
    public static final String USER_ID="SELECT participantID FROM participant WHERE userName=?";

    public ClientHandler(Socket socket) {
        this.socket = socket;
    }

    @Override
    public void run() {
        try {
            connection = Database.databaseConnection();
        } catch (SQLException e) {
            e.printStackTrace();
        }

        try {
            clientReader = new BufferedReader(new InputStreamReader(socket.getInputStream()));
            writer = new PrintWriter(socket.getOutputStream(), true);

            String command;
            while ((command = clientReader.readLine()) != null) {
                switch (command.toLowerCase().trim()) {
                    case "login":
                        loggedInUsername = Login.login(socket, connection, writer, clientReader);
                        break;
                    case "viewchallenges":
                        if (loggedInUsername != null) {
                            try (PreparedStatement statement = connection.prepareStatement(USER_ID)) {
                                statement.setString(1, loggedInUsername);
                                ResultSet rs = statement.executeQuery();
                                if (rs.next()) {
                                    
                                    String participantID = rs.getString("participantID");
                                    ChooseChallenge.viewChallenges(connection, writer, clientReader, participantID);
                                    
                                    break;
                                }
                            } catch (SQLException e) {
                                
                                e.printStackTrace();
                            }
                           
                        } else {
                            writer.println("You must login first.");
                        }
                        break;
                    case "logout":
                        loggedInUsername = null;
                        writer.println("You have been logged out.");
                        break;
                    default:
                        writer.println("Invalid command");
                        break;
                }
            }
        } catch (IOException e) {
            e.printStackTrace();
        } finally {
            try {
                socket.close();
            } catch (IOException e) {
                e.printStackTrace();
            }
        }
    }
}