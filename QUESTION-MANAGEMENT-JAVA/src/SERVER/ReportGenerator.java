package SERVER;

import java.io.PrintWriter;
import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;

public class ReportGenerator {
    private static final String REPORT_QUERY = "SELECT c.challengeName, a.attemptNumber, a.score, " +
                                               "q.questionTxt, qr.isCorrect, qr.timeTaken " +
                                               "FROM Attempt a " +
                                               "JOIN challenge c ON a.challengeID = c.challengeID " +
                                               "JOIN QuestionResponse qr ON a.attemptID = qr.attemptID " +
                                               "JOIN question q ON qr.questionID = q.questionID " +
                                               "WHERE a.participantID = ? " +
                                               "ORDER BY c.challengeName, a.attemptNumber, q.questionID";

    public static void generateReport(Connection connection, PrintWriter writer, String participantID) {
        try (PreparedStatement statement = connection.prepareStatement(REPORT_QUERY)) {
            statement.setString(1, participantID);
            ResultSet resultSet = statement.executeQuery();

            String currentChallenge = "";
            int currentAttempt = -1;
            int totalScore = 0;
            int questionCount = 0;

            while (resultSet.next()) {
                String challengeName = resultSet.getString("challengeName");
                int attemptNumber = resultSet.getInt("attemptNumber");
                
                if (!challengeName.equals(currentChallenge) || attemptNumber != currentAttempt) {
                    if (!currentChallenge.isEmpty()) {
                        printAttemptSummary(writer, totalScore, questionCount);
                    }
                    currentChallenge = challengeName;
                    currentAttempt = attemptNumber;
                    totalScore = resultSet.getInt("score");
                    questionCount = 0;
                    
                    writer.println("\n+-------------------------+----------+--------+----------+");
                    writer.println("| Challenge: " + challengeName);
                    writer.println("| Attempt: " + attemptNumber);
                    writer.println("+-------------------------+----------+--------+----------+");
                    writer.println("|       Question          | Correct? | Score  |   Time   |");
                    writer.println("+-------------------------+----------+--------+----------+");
                }

                String questionText = resultSet.getString("questionTxt");
                boolean isCorrect = resultSet.getBoolean("isCorrect");
                int timeTaken = resultSet.getInt("timeTaken");
                int questionScore = isCorrect ? 3 : -3;

                writer.printf("| %-23s | %-8s | %-6d | %-8d |\n", 
                              truncate(questionText, 23), 
                              isCorrect ? "Yes" : "No", 
                              questionScore, 
                              timeTaken);

                questionCount++;
            }

            if (!currentChallenge.isEmpty()) {
                printAttemptSummary(writer, totalScore, questionCount);
            }

            writer.println("+-------------------------+----------+--------+----------+");
            writer.println("|        End of Report    |          |        |          |");
            writer.println("+-------------------------+----------+--------+----------+");
            writer.flush();

        } catch (SQLException e) {
            writer.println("Error generating report: " + e.getMessage());
            e.printStackTrace();
        }
    }

    private static void printAttemptSummary(PrintWriter writer, int totalScore, int questionCount) {
        writer.println("+-------------------------+----------+--------+----------+");
        writer.printf("| Total Score: %-11d | Questions Answered: %-13d |\n", totalScore, questionCount);
        writer.println("+-------------------------+----------+--------+----------+");
    }

    private static String truncate(String text, int length) {
        return text.length() > length ? text.substring(0, length - 3) + "..." : text;
    }
}