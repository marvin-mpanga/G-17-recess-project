package SERVER;

import java.io.PrintWriter;
import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;

public class ReportGenerator {
    private static final String REPORT_QUERY = "SELECT c.challengeName, a.attemptNumber, a.score " +
                                               "FROM Attempt a " +
                                               "JOIN challenge c ON a.challengeID = c.challengeID " +
                                               "WHERE a.participantID = ? " +
                                               "ORDER BY c.challengeName, a.attemptNumber";

    public static void generateReport(Connection connection, PrintWriter writer, String participantID) {
        try (PreparedStatement statement = connection.prepareStatement(REPORT_QUERY)) {
            statement.setString(1, participantID);
            ResultSet resultSet = statement.executeQuery();

            writer.println("\n+-------------------------+---------+-------+");
            writer.println("|       Challenge Name    | Attempt | Score |");
            writer.println("+-------------------------+---------+-------+");

            String currentChallenge = "";
            int bestScore = 0;

            while (resultSet.next()) {
                String challengeName = resultSet.getString("challengeName");
                int attemptNumber = resultSet.getInt("attemptNumber");
                int score = resultSet.getInt("score");

                if (!challengeName.equals(currentChallenge)) {
                    if (!currentChallenge.isEmpty()) {
                        writer.println("+-------------------------+---------+-------+");
                        writer.printf("| %-23s | %-7s | %-5s |%n", "Best score for " + currentChallenge, "", bestScore);
                        writer.println("+-------------------------+---------+-------+");
                    }
                    currentChallenge = challengeName;
                    bestScore = score;
                } else {
                    bestScore = Math.max(bestScore, score);
                }

                writer.printf("| %-23s | %-7d | %-5d |%n", challengeName, attemptNumber, score);
            }

            if (!currentChallenge.isEmpty()) {
                writer.println("+-------------------------+---------+-------+");
                writer.printf("| %-23s | %-7s | %-5s |%n", "Best score for " + currentChallenge, "", bestScore);
                writer.println("+-------------------------+---------+-------+");
            }

            writer.println("|        End of Report    |         |       |");
            writer.println("+-------------------------+---------+-------+");
            writer.flush();

        } catch (SQLException e) {
            writer.println("Error generating report: " + e.getMessage());
            e.printStackTrace();
        }
    }
}
