package SERVER;

import java.io.*;
import java.sql.*;
import java.util.*;

public class AttemptChallenge {
    private static final String QUESTION_QUERY = "SELECT * FROM question, answer WHERE question.questionID = answer.questionID AND question.challengeID = ?";
    private static final String ATTEMPT_QUERY = "SELECT COUNT(*) as attemptCount FROM Attempt WHERE participantID = ? AND challengeID = ?";
    private static final String INSERT_ATTEMPT = "INSERT INTO Attempt (participantID, challengeID, attemptNumber, score) VALUES (?, ?, ?, ?)";
    private static final String UPDATE_ATTEMPT_SCORE = "UPDATE Attempt SET score = ? WHERE attemptID = ?";
    private static final String BEST_SCORE_QUERY = "SELECT MAX(score) as bestScore FROM Attempt WHERE participantID = ? AND challengeID = ?";
    private static final String UPDATE_CHALLENGE_PROGRESS = "INSERT INTO ChallengeProgress (participantID, challengeID, status) VALUES (?, ?, ?) ON DUPLICATE KEY UPDATE status = ?";
    private static final String INSERT_QUESTION_RESPONSE = "INSERT INTO QuestionResponse (attemptID, questionID, isCorrect, timeTaken) VALUES (?, ?, ?, ?)";

    public static void startQuiz(Connection connection, PrintWriter writer, BufferedReader reader, String challengeID, String participantID, TimeManager timeManager) {
        try {
            if (!participantExists(connection, participantID)) {
                writer.println("Error: Participant not found.");
                return;
            }
            updateChallengeProgress(connection, participantID, challengeID, "incomplete");
            
            boolean continueAttempting = true;
            while (continueAttempting) {
                int attemptNumber = getAttemptNumber(connection, participantID, challengeID);
                
                if (attemptNumber > 3) {
                    writer.println("You have already attempted this challenge 3 times. No more attempts allowed.");
                    return;
                }
        
                List<Map<String, String>> questions = getQuestions(connection, challengeID);
        
                if (questions.isEmpty()) {
                    writer.println("No questions found for this challenge.");
                    return;
                }
        
                // Insert attempt before starting the quiz
                int attemptID = insertAttempt(connection, participantID, challengeID, attemptNumber, 0);
        
                int score;
                try {
                    score = conductQuiz(connection, writer, reader, questions, timeManager, attemptID);
                } catch (IOException e) {
                    writer.println("Error during quiz: " + e.getMessage());
                    return;
                }
        
                // Update the attempt with the final score
                updateAttemptScore(connection, attemptID, score);
        
                int bestScore = getBestScore(connection, participantID, challengeID);
        
                writer.println("\nQuiz completed!");
                writer.println("Your score for this attempt: " + score);
                writer.println("Your best score for this challenge: " + bestScore);
                writer.println("Time taken: " + timeManager.getElapsedTimeFormatted());
                writer.println("You have " + (3 - attemptNumber) + " attempts remaining.");
                writer.flush();

                if (attemptNumber < 3 && !timeManager.isTimeUp()) {
                    writer.println("Would you like to try this challenge again? (yes/no)");
                    String response = reader.readLine().trim().toLowerCase();
                    if (!response.equals("yes")) {
                        continueAttempting = false;
                    }
                } else {
                    continueAttempting = false;
                }
            }

            updateChallengeProgress(connection, participantID, challengeID, "complete");

            writer.println("Would you like to try other challenges? (yes/no)");
            String response = reader.readLine().trim().toLowerCase();
            if (response.equals("yes")) {
                ChooseChallenge.viewChallenges(connection, writer, reader, participantID);
            } else {
                ReportGenerator.generateReport(connection, writer, participantID);
            }

        } catch (SQLException | IOException e) {
            writer.println("Error during quiz: " + e.getMessage());
            e.printStackTrace();
        }
    }

    private static boolean participantExists(Connection connection, String participantID) throws SQLException {
        String query = "SELECT 1 FROM participant WHERE ParticipantID = ?";
        try (PreparedStatement stmt = connection.prepareStatement(query)) {
            stmt.setString(1, participantID);
            try (ResultSet rs = stmt.executeQuery()) {
                return rs.next();
            }
        }
    }

    private static void updateChallengeProgress(Connection connection, String participantID, String challengeID, String status) throws SQLException {
        try (PreparedStatement statement = connection.prepareStatement(UPDATE_CHALLENGE_PROGRESS)) {
            statement.setString(1, participantID);
            statement.setString(2, challengeID);
            statement.setString(3, status);
            statement.setString(4, status);
            statement.executeUpdate();
        }
    }

    private static int getAttemptNumber(Connection connection, String participantID, String challengeID) throws SQLException {
        try (PreparedStatement statement = connection.prepareStatement(ATTEMPT_QUERY)) {
            statement.setString(1, participantID);
            statement.setString(2, challengeID);
            ResultSet resultSet = statement.executeQuery();
            if (resultSet.next()) {
                return resultSet.getInt("attemptCount") + 1;
            }
        }
        return 1;
    }

    private static List<Map<String, String>> getQuestions(Connection connection, String challengeID) throws SQLException {
        List<Map<String, String>> questions = new ArrayList<>();
        try (PreparedStatement statement = connection.prepareStatement(QUESTION_QUERY)) {
            statement.setString(1, challengeID);
            ResultSet resultSet = statement.executeQuery();
            while (resultSet.next()) {
                Map<String, String> question = new HashMap<>();
                question.put("id", resultSet.getString("questionID"));
                question.put("text", resultSet.getString("questionTxt"));
                question.put("answer", resultSet.getString("answerText"));
                questions.add(question);
            }
        }
        return questions;
    }

    private static int conductQuiz(Connection connection, PrintWriter writer, BufferedReader reader, List<Map<String, String>> questions, TimeManager timeManager, int attemptID) throws IOException, SQLException {
        Collections.shuffle(questions);
        int numQuestions = Math.min(10, questions.size());
        int score = 0;

        writer.println("-----------------------------------------------------------------------------------------------");
        writer.println("|                                          Quiz Starting                                       |");
        writer.println("-----------------------------------------------------------------------------------------------");
        writer.println("You will be asked " + numQuestions + " questions.");
        writer.println("Instructions:");
        writer.println("A correct answer will earn you 3 marks.");
        writer.println("An incorrect answer will deduct 3 marks.");
        writer.println("If you're not sure, enter '-' to skip the question (no marks awarded or deducted).");
        writer.println("Good luck!");
        writer.println("-----------------------------------------------------------------------------------------------");
        writer.flush();

        for (int i = 0; i < numQuestions; i++) {
            if (timeManager.isTimeUp()) {
                writer.println("-----------------------------------------------------------------------------------------------");
                writer.println("|                                      Time's up! The challenge has ended.                    |");
                writer.println("-----------------------------------------------------------------------------------------------");
                break;
            }

            Map<String, String> question = questions.get(i);
            writer.println("-----------------------------------------------------------------------------------------------");
            writer.println("|                                  Remaining time: " + timeManager.getRemainingTimeFormatted() + "                                  |");
            writer.println("-----------------------------------------------------------------------------------------------");
            writer.println("\nQuestion " + (i + 1) + ": " + question.get("text"));
            writer.print("Your answer: ");
            writer.flush();

            long startTime = System.currentTimeMillis();
            String userAnswer = getUserAnswerWithTimeout(reader, timeManager);
            long endTime = System.currentTimeMillis();
            int timeTaken = (int) ((endTime - startTime) / 1000); // Convert to seconds

            if (userAnswer == null) {
                writer.println("Time's up! Moving to the next question.");
                insertQuestionResponse(connection, attemptID, question.get("id"), false, timeTaken);
                continue;
            }

            String correctAnswer = question.get("answer");
            boolean isCorrect = false;

            if (userAnswer.equals("-")) {
                writer.println("-----------------------------------------------------------------------------------------------");
                writer.println("|                                   Question skipped. The correct answer was: " + correctAnswer + "                    |");
                writer.println("-----------------------------------------------------------------------------------------------");
            } else if (userAnswer.equalsIgnoreCase(correctAnswer)) {
                score += 3;
                isCorrect = true;
                writer.println("-----------------------------------------------------------------------------------------------");
                writer.println("|                                   Correct! You earned 3 marks.                                 |");
                writer.println("-----------------------------------------------------------------------------------------------");
            } else {
                score -= 3;
                writer.println("-----------------------------------------------------------------------------------------------");
                writer.println("|                               Incorrect. The correct answer was: " + correctAnswer + "                        |");
                writer.println("|                                    You lost 3 marks.                                           |");
                writer.println("-----------------------------------------------------------------------------------------------");
            }
            writer.println("|                                     Your current score: " + score + "                                      |");
            writer.println("|                                     Time taken: " + timeTaken + " seconds                                 |");
            writer.println("-----------------------------------------------------------------------------------------------");
            writer.flush();

            insertQuestionResponse(connection, attemptID, question.get("id"), isCorrect, timeTaken);
        }

        return score;
    }

    private static String getUserAnswerWithTimeout(BufferedReader reader, TimeManager timeManager) throws IOException {
        long startTime = System.currentTimeMillis();
        long timeoutMillis = timeManager.getRemainingTimeInSeconds() * 1000;

        while (System.currentTimeMillis() - startTime < timeoutMillis) {
            if (reader.ready()) {
                return reader.readLine().trim();
            }
            try {
                Thread.sleep(100); // Small delay to prevent busy waiting
            } catch (InterruptedException e) {
                Thread.currentThread().interrupt();
                return null;
            }
        }
        return null; // Timeout occurred
    }

    private static int insertAttempt(Connection connection, String participantID, String challengeID, int attemptNumber, int score) throws SQLException {
        if (!participantExists(connection, participantID)) {
            throw new SQLException("Participant with ID " + participantID + " does not exist.");
        }
        try (PreparedStatement statement = connection.prepareStatement(INSERT_ATTEMPT, Statement.RETURN_GENERATED_KEYS)) {
            statement.setString(1, participantID);
            statement.setString(2, challengeID);
            statement.setInt(3, attemptNumber);
            statement.setInt(4, score);
            statement.executeUpdate();
            
            try (ResultSet generatedKeys = statement.getGeneratedKeys()) {
                if (generatedKeys.next()) {
                    return generatedKeys.getInt(1);
                } else {
                    throw new SQLException("Creating attempt failed, no ID obtained.");
                }
            }
        }
    }

    private static void updateAttemptScore(Connection connection, int attemptID, int score) throws SQLException {
        try (PreparedStatement statement = connection.prepareStatement(UPDATE_ATTEMPT_SCORE)) {
            statement.setInt(1, score);
            statement.setInt(2, attemptID);
            statement.executeUpdate();
        }
    }

    private static int getBestScore(Connection connection, String participantID, String challengeID) throws SQLException {
        try (PreparedStatement statement = connection.prepareStatement(BEST_SCORE_QUERY)) {
            statement.setString(1, participantID);
            statement.setString(2, challengeID);
            ResultSet resultSet = statement.executeQuery();
            if (resultSet.next()) {
                return resultSet.getInt("bestScore");
            }
        }
        return 0;
    }

    private static void insertQuestionResponse(Connection connection, int attemptID, String questionID, boolean isCorrect, int timeTaken) throws SQLException {
        try (PreparedStatement statement = connection.prepareStatement(INSERT_QUESTION_RESPONSE)) {
            statement.setInt(1, attemptID);
            statement.setString(2, questionID);
            statement.setBoolean(3, isCorrect);
            statement.setInt(4, timeTaken);
            statement.executeUpdate();
        }
    }
}