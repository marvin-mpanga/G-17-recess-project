package SERVER;

import java.io.BufferedReader;
import java.io.IOException;
import java.io.PrintWriter;
import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;

public class Login {
    private static final String LOGIN_QUERY = "SELECT * FROM participant WHERE username = ? AND password = ?";

    public static String login(Connection connection, PrintWriter writer, BufferedReader reader) {
        try {
            writer.println("Enter username:");
            String username = reader.readLine();
            writer.println("Enter password:");
            String password = reader.readLine();

            try (PreparedStatement statement = connection.prepareStatement(LOGIN_QUERY)) {
                statement.setString(1, username);
                statement.setString(2, password);
                ResultSet resultSet = statement.executeQuery();

                if (resultSet.next()) {
                    writer.println("Login successful. Welcome, " + username + "!");
                    return username;
                } else {
                    writer.println("Invalid username or password. Please try again.");
                }
            }
        } catch (IOException | SQLException e) {
            writer.println("Error during login: " + e.getMessage());
            e.printStackTrace();
        }
        return null;
    }
}