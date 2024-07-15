package SERVER;

import java.sql.*;
import java.io.PrintWriter;
import java.util.*;

public class ChallengeStatistics {
    private static final String INCOMPLETE_CHALLENGES_QUERY = "SELECT p.userName, c.challengeName FROM ChallengeProgress cp JOIN Participant p ON cp.participantID = p.participantID JOIN Challenge c ON cp.challengeID = c.challengeID WHERE cp.status = 'incomplete'";
    private static final String MOST_CORRECT_QUESTION_QUERY = "SELECT q.questionTxt, COUNT(*) as correct_count FROM QuestionResponse qr JOIN Question q ON qr.questionID = q.questionID WHERE q.challengeID = ? AND qr.isCorrect = true GROUP BY qr.questionID ORDER BY correct_count DESC LIMIT 1";
    private static final String QUESTION_REPETITION_QUERY = "SELECT questionID, COUNT(*) as repetition_count FROM QuestionResponse qr JOIN Attempt a ON qr.attemptID = a.attemptID WHERE a.participantID = ? AND a.challengeID = ? GROUP BY questionID";

    public static void getIncompleteChallengers(Connection connection, PrintWriter writer) {
        try (PreparedStatement statement = connection.prepareStatement(INCOMPLETE_CHALLENGES_QUERY);
             ResultSet resultSet = statement.executeQuery()) {
            
            writer.println("Participants with incomplete challenges:");
            while (resultSet.next()) {
                String userName = resultSet.getString("userName");
                String challengeName = resultSet.getString("challengeName");
                writer.println(userName + " - " + challengeName);
            }
        } catch (SQLException e) {
            writer.println("Error retrieving incomplete challenges: " + e.getMessage());
        }
    }

    public static void getMostCorrectQuestion(Connection connection, PrintWriter writer, String challengeID) {
        try (PreparedStatement statement = connection.prepareStatement(MOST_CORRECT_QUESTION_QUERY)) {
            statement.setString(1, challengeID);
            try (ResultSet resultSet = statement.executeQuery()) {
                if (resultSet.next()) {
                    String questionText = resultSet.getString("questionTxt");
                    int correctCount = resultSet.getInt("correct_count");
                    writer.println("Most correctly answered question for this challenge:");
                    writer.println("Question: " + questionText);
                    writer.println("Correct answers: " + correctCount);
                } else {
                    writer.println("No data available for this challenge.");
                }
            }
        } catch (SQLException e) {
            writer.println("Error retrieving most correct question: " + e.getMessage());
        }
    }

    public static void getQuestionRepetitionPercentage(Connection connection, PrintWriter writer, String participantID, String challengeID) {
        try (PreparedStatement statement = connection.prepareStatement(QUESTION_REPETITION_QUERY)) {
            statement.setString(1, participantID);
            statement.setString(2, challengeID);
            try (ResultSet resultSet = statement.executeQuery()) {
                Map<String, Integer> questionCounts = new HashMap<>();
                int totalQuestions = 0;
                while (resultSet.next()) {
                    String questionID = resultSet.getString("questionID");
                    int count = resultSet.getInt("repetition_count");
                    questionCounts.put(questionID, count);
                    totalQuestions += count;
                }
                
                int repeatedQuestions = (int) questionCounts.values().stream().filter(count -> count > 1).count();
                double repetitionPercentage = (repeatedQuestions * 100.0) / questionCounts.size();
                
                writer.println("Question repetition statistics:");
                writer.println("Total unique questions: " + questionCounts.size());
                writer.println("Total questions answered: " + totalQuestions);
                writer.println("Repeated questions: " + repeatedQuestions);
                writer.printf("Repetition percentage: %.2f%%\n", repetitionPercentage);
            }
        } catch (SQLException e) {
            writer.println("Error calculating question repetition: " + e.getMessage());
        }
    }
}