package SERVER;

import java.io.*;
import java.sql.*;
import java.util.*;

import org.fusesource.jansi.Ansi;

public class AttemptChallenge {
    private static final String QUESTION_QUERY = "SELECT * FROM question, answer WHERE question.questionID = answer.questionID AND question.challengeID = ?";
    private static final String ATTEMPT_QUERY = "SELECT COUNT(*) as attemptCount FROM Attempt WHERE participantID = ? AND challengeID = ?";
    private static final String INSERT_ATTEMPT = "INSERT INTO Attempt (participantID, challengeID, attemptNumber, score) VALUES (?, ?, ?, ?)";
    private static final String UPDATE_ATTEMPT_SCORE = "UPDATE Attempt SET score = ? WHERE attemptID = ?";
    private static final String BEST_SCORE_QUERY = "SELECT MAX(score) as bestScore FROM Attempt WHERE participantID = ? AND challengeID = ?";
    private static final String UPDATE_CHALLENGE_PROGRESS = "INSERT INTO challengeprogress (participantID, challengeID, status) VALUES (?, ?, ?) ON DUPLICATE KEY UPDATE status = ?";
    private static final String INSERT_QUESTION_RESPONSE = "INSERT INTO QuestionResponse (attemptID, questionID, isCorrect, timeTaken) VALUES (?, ?, ?, ?)";

    public static void startQuiz(Connection connection, PrintWriter writer, BufferedReader reader, String challengeID, String participantID, TimeManager timeManager) {
        try {
            if (!participantExists(connection, participantID)) {
                printError(writer, "Error: Participant not found.");
                return;
            }
            updateChallengeProgress(connection, participantID, challengeID, "incomplete");

            boolean continueAttempting = true;
            while (continueAttempting) {
                int attemptNumber = getAttemptNumber(connection, participantID, challengeID);

                if (attemptNumber > 3) {
                    printWarning(writer, "You have already attempted this challenge 3 times. No more attempts allowed.");
                    return;
                }

                List<Map<String, String>> questions = getQuestions(connection, challengeID);

                if (questions.isEmpty()) {
                    printError(writer, "No questions found for this challenge.");
                    return;
                }

                int attemptID = insertAttempt(connection, participantID, challengeID, attemptNumber, 0);

                int score;
                try {
                    score = conductQuiz(connection, writer, reader, questions, timeManager, attemptID);
                } catch (IOException e) {
                    printError(writer, "Error during quiz: " + e.getMessage());
                    return;
                }

                updateAttemptScore(connection, attemptID, score);

                int bestScore = getBestScore(connection, participantID, challengeID);

                printResults(writer, score, bestScore, timeManager.getElapsedTimeFormatted(), 3 - attemptNumber);

                if (attemptNumber < 3 && !timeManager.isTimeUp()) {
                    printQuestion(writer, "Would you like to try this challenge again? (yes/no)");
                    String response = reader.readLine().trim().toLowerCase();
                    if (!response.equals("yes")) {
                        continueAttempting = false;
                    }
                } else {
                    continueAttempting = false;
                }
            }

            updateChallengeProgress(connection, participantID, challengeID, "complete");
            printInfo(writer, "Challenge completed. Type 'viewchallenges' to see more challenges or 'logout' to end your session.");

        } catch (SQLException | IOException e) {
            printError(writer, "Error during quiz: " + e.getMessage());
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
                question.put("answer", resultSet.getString("answerTxt"));
                questions.add(question);
            }
        }
        return questions;
    }

    private static int conductQuiz(Connection connection, PrintWriter writer, BufferedReader reader, List<Map<String, String>> questions, TimeManager timeManager, int attemptID) throws IOException, SQLException {
        Collections.shuffle(questions);
        int numQuestions = Math.min(10, questions.size());
        int score = 0;

        printHeader(writer, "Quiz Starting");
        printInfo(writer, "You will be asked " + numQuestions + " questions.");
        printInstructions(writer);

        for (int i = 0; i < numQuestions; i++) {
            if (timeManager.isTimeUp()) {
                printWarning(writer, "Time's up! The challenge has ended.");
                break;
            }

            Map<String, String> question = questions.get(i);
            displayQuestionHeader(writer, timeManager, i + 1);
            printQuestion(writer, question.get("text"));

            long startTime = System.currentTimeMillis();
            String userAnswer = getUserAnswerWithTimeout(reader, timeManager);
            long endTime = System.currentTimeMillis();
            int timeTaken = (int) ((endTime - startTime) / 1000);

            String correctAnswer = question.get("answer");
            boolean isCorrect = false;

            if (userAnswer == null) {
                printWarning(writer, "Time's up! Moving to the next question.");
            } else if (userAnswer.equals("-")) {
                printInfo(writer, "Question skipped. The correct answer was: " + correctAnswer);
            } else if (userAnswer.equalsIgnoreCase(correctAnswer)) {
                score += 3;
                isCorrect = true;
                printCorrect(writer, "Correct! You earned 3 marks.");
            } else {
                score -= 3;
                printIncorrect(writer, "Incorrect. The correct answer was: " + correctAnswer);
                printInfo(writer, "You lost 3 marks.");
            }

            displayQuestionFooter(writer, score, timeTaken);
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
    private static void displayQuestionHeader(PrintWriter writer, TimeManager timeManager, int questionNumber) {
        writer.println(Ansi.ansi().fgBright(Ansi.Color.CYAN).a("═".repeat(80)).reset());
        printRemainingTime(writer, timeManager.getRemainingTimeFormatted());
        writer.println(Ansi.ansi().fgBright(Ansi.Color.GREEN).bold().a("Question " + questionNumber).reset());
        writer.println(Ansi.ansi().fgBright(Ansi.Color.CYAN).a("─".repeat(80)).reset());
        writer.flush();
    }

    private static void displayQuestionFooter(PrintWriter writer, int score, int timeTaken) {
        writer.println(Ansi.ansi().fgBright(Ansi.Color.CYAN).a("─".repeat(80)).reset());
        printScore(writer, score, timeTaken);
        writer.println(Ansi.ansi().fgBright(Ansi.Color.CYAN).a("═".repeat(80)).reset());
        writer.flush();
    }

    private static void printHeader(PrintWriter writer, String message) {
        writer.println(Ansi.ansi().fgBright(Ansi.Color.CYAN).a("╔═══════════════════════════════════════════════════════════════════════════╗").reset());
        writer.println(Ansi.ansi().fgBright(Ansi.Color.CYAN).a("║ ").fgBright(Ansi.Color.WHITE).bold().a(centerText(message, 75)).fgBright(Ansi.Color.CYAN).a(" ║").reset());
        writer.println(Ansi.ansi().fgBright(Ansi.Color.CYAN).a("╚═══════════════════════════════════════════════════════════════════════════╝").reset());
        writer.flush();
    }

    private static void printInfo(PrintWriter writer, String message) {
        writer.println(Ansi.ansi().fgBright(Ansi.Color.CYAN).a("INFO: ").reset().a(message).reset());
        writer.flush();
    }

    private static void printWarning(PrintWriter writer, String message) {
        writer.println(Ansi.ansi().fgBright(Ansi.Color.YELLOW).a("WARNING: ").reset().a(message).reset());
        writer.flush();
    }

    private static void printError(PrintWriter writer, String message) {
        writer.println(Ansi.ansi().fgBright(Ansi.Color.RED).a("ERROR: ").reset().a(message).reset());
        writer.flush();
    }

    private static void printQuestion(PrintWriter writer, String message) {
        writer.println(Ansi.ansi().fgBright(Ansi.Color.WHITE).bold().a(message).reset());
        writer.flush();
    }

    private static void printCorrect(PrintWriter writer, String message) {
        writer.println(Ansi.ansi().fgBright(Ansi.Color.GREEN).bold().a("CORRECT: ").reset().a(message).reset());
        writer.flush();
    }

    private static void printIncorrect(PrintWriter writer, String message) {
        writer.println(Ansi.ansi().fgBright(Ansi.Color.RED).bold().a("INCORRECT: ").reset().a(message).reset());
        writer.flush();
    }

    private static void printScore(PrintWriter writer, int score, int timeTaken) {
        writer.println(Ansi.ansi().fgBright(Ansi.Color.YELLOW).a("Current score: ").bold().a(score).reset());
        writer.println(Ansi.ansi().fgBright(Ansi.Color.YELLOW).a("Time taken: ").bold().a(timeTaken + " seconds").reset());
        writer.flush();
    }

    private static void printRemainingTime(PrintWriter writer, String remainingTime) {
        writer.println(Ansi.ansi().fgBright(Ansi.Color.CYAN).a("Remaining time: ").bold().a(remainingTime).reset());
        writer.flush();
    }

    private static void printResults(PrintWriter writer, int score, int bestScore, String elapsedTime, int remainingAttempts) {
        printHeader(writer, "Quiz Completed");
        printInfo(writer, "Your score for this attempt: " + score);
        printInfo(writer, "Your best score for this challenge: " + bestScore);
        printInfo(writer, "Time taken: " + elapsedTime);
        printInfo(writer, "You have " + remainingAttempts + " attempts remaining.");
        writer.flush();
    }

    private static void printInstructions(PrintWriter writer) {
        writer.println(Ansi.ansi().fgBright(Ansi.Color.CYAN).a("Instructions:").reset());
        writer.println(Ansi.ansi().fgBright(Ansi.Color.WHITE).a("- A correct answer will earn you 3 marks.").reset());
        writer.println(Ansi.ansi().fgBright(Ansi.Color.WHITE).a("- An incorrect answer will deduct 3 marks.").reset());
        writer.println(Ansi.ansi().fgBright(Ansi.Color.WHITE).a("- If you're not sure, enter '-' to skip the question (no marks awarded or deducted).").reset());
        writer.println(Ansi.ansi().fgBright(Ansi.Color.YELLOW).bold().a("Good luck!").reset());
        writer.println(Ansi.ansi().fgBright(Ansi.Color.CYAN).a("═".repeat(80)).reset());
        writer.flush();
    }

    private static String centerText(String text, int width) {
        int padding = (width - text.length()) / 2;
        return " ".repeat(padding) + text + " ".repeat(padding);
    }


}
