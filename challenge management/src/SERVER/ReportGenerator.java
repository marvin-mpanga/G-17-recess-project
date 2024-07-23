package SERVER;

import javax.imageio.ImageIO;
import java.awt.image.BufferedImage;
import java.io.*;
import java.sql.*;
import java.util.Base64;
import java.util.HashMap;
import java.util.Map;

public class ReportGenerator {
    private static final String REPORT_QUERY = "SELECT c.challengeName, a.attemptNumber, a.score, " +
            "q.questionTxt, qr.isCorrect " +
            "FROM Attempt a " +
            "JOIN challenge c ON a.challengeID = c.challengeID " +
            "JOIN QuestionResponse qr ON a.attemptID = qr.attemptID " +
            "JOIN question q ON qr.questionID = q.questionID " +
            "WHERE a.participantID = ? " +
            "ORDER BY c.challengeName, a.attemptNumber, q.questionID";

    private static final String PARTICIPANT_QUERY = "SELECT firstName, lastName, imageFile FROM Participant WHERE participantID = ?";

    public static void generateReport(Connection connection, String participantID, PrintWriter consoleWriter) {
        try {
            String summaryReport = generateSummaryReport(connection, participantID);
            consoleWriter.println(summaryReport);
            consoleWriter.println("A detailed report has been generated and is ready to be sent via email.");
        } catch (SQLException e) {
            consoleWriter.println("Error generating report: " + e.getMessage());
        }
    }

    public static String getDetailedReportForEmail(Connection connection, String participantID) {
        try {
            BufferedImage participantImage = getParticipantImage(connection, participantID);
            return generateDetailedReport(connection, participantID, participantImage);
        } catch (SQLException e) {
            return "Error generating detailed report: " + e.getMessage();
        }
    }

    private static String generateSummaryReport(Connection connection, String participantID) throws SQLException {
        StringBuilder summaryBuilder = new StringBuilder();
        summaryBuilder.append("\n╔════════════════════════════════════════════════════════════════════════╗\n");
        summaryBuilder.append("║                    MATH CHALLENGE SUMMARY                                ║\n");
        summaryBuilder.append("╠═══════════════════════╦═══════════════╦═══════════════════╦══════════════╗\n");
        summaryBuilder.append("║      Challenge        ║   Attempts    ║ Best Score (0-30) ║ Overall Mark ║\n");
        summaryBuilder.append("╠═══════════════════════╬═══════════════╬═══════════════════╬══════════════╣\n");

        Map<String, ChallengeSummary> challengeSummaries = new HashMap<>();

        try (PreparedStatement statement = connection.prepareStatement(REPORT_QUERY)) {
            statement.setString(1, participantID);
            ResultSet resultSet = statement.executeQuery();

            while (resultSet.next()) {
                String challengeName = resultSet.getString("challengeName");
                int attemptNumber = resultSet.getInt("attemptNumber");
                int score = resultSet.getInt("score");

                ChallengeSummary challengeSummary = challengeSummaries.computeIfAbsent(challengeName, k -> new ChallengeSummary());
                challengeSummary.addAttempt(attemptNumber, score);
            }
        }

        int overallBestMark = 0;
        for (Map.Entry<String, ChallengeSummary> entry : challengeSummaries.entrySet()) {
            ChallengeSummary challengeSummary = entry.getValue();
            int bestScore = challengeSummary.getBestScore();
            int overallMark = (bestScore * 100) / 30; // Convert best score to a mark out of 100
            overallBestMark = Math.max(overallBestMark, overallMark);
            appendChallengeSummary(summaryBuilder, entry.getKey(), challengeSummary.getAttemptCount(), bestScore, overallMark);
        }

        summaryBuilder.append("╠═══════════════════════╩═══════════════╩═══════════════════╩═════════════╣\n");
        summaryBuilder.append(String.format("║ Overall Best Mark: %-54d ║\n", overallBestMark));
        summaryBuilder.append("╚═════════════════════════════════════════════════════════════════════════╝\n");
        return summaryBuilder.toString();
    }

    private static void appendChallengeSummary(StringBuilder summaryBuilder, String challengeName, int attemptCount, int bestScore, int overallMark) {
        summaryBuilder.append(String.format("║ %-21s ║ %-13d ║ %-17d ║ %-11d ║\n",
                truncate(challengeName, 21), attemptCount, bestScore, overallMark));
    }

    private static String truncate(String text, int maxLength) {
        return text.length() > maxLength ? text.substring(0, maxLength - 3) + "..." : text;
    }

    private static String generateDetailedReport(Connection connection, String participantID, BufferedImage participantImage) throws SQLException {
        StringBuilder report = new StringBuilder();
        report.append("<!DOCTYPE html><html lang='en'><head><meta charset='UTF-8'><title>Math Challenge Report</title>");
        appendStyles(report);
        report.append("</head><body>");

        appendHeader(report);
        appendParticipantInfo(report, connection, participantID, participantImage);

        Map<String, ChallengeSummary> challengeSummaries = new HashMap<>();
        Map<String, StringBuilder> challengeDetails = new HashMap<>();

        collectChallengeData(connection, participantID, challengeSummaries, challengeDetails);

        appendOverallSummary(report, challengeSummaries);
        appendChallengeDetails(report, challengeDetails);

        report.append("</body></html>");
        return report.toString();
    }

    private static void appendStyles(StringBuilder report) {
        report.append("<style>");
        report.append("body { font-family: 'Arial', sans-serif; line-height: 1.6; color: #333; max-width: 800px; margin: 0 auto; padding: 20px; background-color: #f4f4f4; }");
        report.append("h1 { color: #2c3e50; text-align: center; }");
        report.append("h2 { color: #3498db; }");
        report.append("h3 { color: #e74c3c; }");
        report.append("table { width: 100%; border-collapse: collapse; margin-bottom: 20px; background-color: #fff; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }");
        report.append("th, td { padding: 12px; text-align: left; border-bottom: 1px solid #ddd; }");
        report.append("th { background-color: #3498db; color: #fff; }");
        report.append("tr:hover { background-color: #f5f5f5; }");
        report.append(".correct { color: #27ae60; }");
        report.append(".incorrect { color: #c0392b; }");
        report.append(".participant-info { display: flex; align-items: center; margin-bottom: 20px; background-color: #fff; padding: 20px; border-radius: 5px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }");
        report.append(".participant-image { width: 100px; height: 100px; border-radius: 50%; margin-right: 20px; object-fit: cover; }");
        report.append(".summary-chart { width: 100%; height: 300px; margin-bottom: 20px; background-color: #fff; padding: 20px; border-radius: 5px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }");
        report.append(".header { text-align: center; margin-bottom: 30px; background-color: #3498db; color: #fff; padding: 20px; border-radius: 5px; }");
        report.append(".challenge-section { background-color: #fff; padding: 20px; margin-bottom: 20px; border-radius: 5px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }");
        report.append(".overall-summary { background-color: #2ecc71; color: #fff; padding: 20px; margin-bottom: 20px; border-radius: 5px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }");
        report.append("</style>");
    }

    private static void appendHeader(StringBuilder report) {
        report.append("<div class='header'>");
        report.append("<h1>Ultimate Math Challenge</h1>");
        report.append("<p>Pushing the Boundaries of Mathematical Excellence</p>");
        report.append("</div>");
    }

    private static void appendParticipantInfo(StringBuilder report, Connection connection, String participantID, BufferedImage participantImage) throws SQLException {
        try (PreparedStatement statement = connection.prepareStatement(PARTICIPANT_QUERY)) {
            statement.setString(1, participantID);
            ResultSet resultSet = statement.executeQuery();
            if (resultSet.next()) {
                String firstName = resultSet.getString("firstName");
                String lastName = resultSet.getString("lastName");
                String base64Image = (participantImage != null) ? imageToBase64(participantImage) : "";

                report.append("<div class='participant-info'>");
                if (!base64Image.isEmpty()) {
                    report.append("<img src='data:image/jpeg;base64,").append(base64Image).append("' alt='Participant' class='participant-image'>");
                }
                report.append("<h2>Performance Report for ").append(firstName).append(" ").append(lastName).append("</h2>");
                report.append("</div>");
            }
        }
    }

    private static void collectChallengeData(Connection connection, String participantID,
                                             Map<String, ChallengeSummary> challengeSummaries,
                                             Map<String, StringBuilder> challengeDetails) throws SQLException {
        try (PreparedStatement statement = connection.prepareStatement(REPORT_QUERY)) {
            statement.setString(1, participantID);
            ResultSet resultSet = statement.executeQuery();

            while (resultSet.next()) {
                String challengeName = resultSet.getString("challengeName");
                int attemptNumber = resultSet.getInt("attemptNumber");
                int score = resultSet.getInt("score");
                boolean isCorrect = resultSet.getBoolean("isCorrect");
                String questionText = resultSet.getString("questionTxt");

                ChallengeSummary summary = challengeSummaries.computeIfAbsent(challengeName, k -> new ChallengeSummary());
                summary.addAttempt(attemptNumber, score);

                StringBuilder details = challengeDetails.computeIfAbsent(challengeName, k -> new StringBuilder());
                appendQuestionDetails(details, attemptNumber, questionText, isCorrect);
            }
        }
    }

    private static void appendOverallSummary(StringBuilder report, Map<String, ChallengeSummary> challengeSummaries) {
        report.append("<div class='overall-summary'>");
        report.append("<h2>Overall Summary</h2>");
        report.append("<table>");
        report.append("<tr><th>Challenge</th><th>Attempts</th><th>Best Score (0-30)</th><th>Overall Mark</th></tr>");

        int overallBestMark = 0;
        for (Map.Entry<String, ChallengeSummary> entry : challengeSummaries.entrySet()) {
            ChallengeSummary summary = entry.getValue();
            int bestScore = summary.getBestScore();
            int overallMark = (bestScore * 100) / 30; // Convert best score to a mark out of 100
            overallBestMark = Math.max(overallBestMark, overallMark);

            report.append("<tr>");
            report.append("<td>").append(entry.getKey()).append("</td>");
            report.append("<td>").append(summary.getAttemptCount()).append("</td>");
            report.append("<td>").append(bestScore).append("</td>");
            report.append("<td>").append(overallMark).append("%</td>");
            report.append("</tr>");
        }
        report.append("<tr><th colspan='3'>Overall Best Mark</th><td>").append(overallBestMark).append("%</td></tr>");
        report.append("</table>");
        report.append("</div>");

        appendSummaryChart(report, challengeSummaries);
    }

    private static void appendSummaryChart(StringBuilder report, Map<String, ChallengeSummary> challengeSummaries) {
        report.append("<div class='summary-chart'>");
        report.append("<h3>Challenge Performance Chart</h3>");
        report.append("<svg width='100%' height='100%' viewBox='0 0 800 300'>");

        int barWidth = 800 / (challengeSummaries.size() * 2 + 1);
        int x = barWidth;
        int maxScore = 30; // Max score is always 30

        String[] colors = {"#3498db", "#e74c3c", "#2ecc71", "#f39c12", "#9b59b6", "#1abc9c", "#d35400", "#34495e"};
        int colorIndex = 0;

        for (Map.Entry<String, ChallengeSummary> entry : challengeSummaries.entrySet()) {
            ChallengeSummary summary = entry.getValue();
            int height = (summary.getBestScore() * 250) / maxScore;
            String color = colors[colorIndex % colors.length];
            report.append("<rect x='").append(x).append("' y='").append(300 - height).append("' width='").append(barWidth).append("' height='").append(height).append("' fill='").append(color).append("'></rect>");
            report.append("<text x='").append(x + barWidth / 2).append("' y='290' text-anchor='middle' font-size='12' transform='rotate(-45 ").append(x + barWidth / 2).append(",290)'>").append(entry.getKey()).append("</text>");
            report.append("<text x='").append(x + barWidth / 2).append("' y='").append(285 - height).append("' text-anchor='middle' font-size='12' fill='#fff'>").append(summary.getBestScore()).append("</text>");
            x += barWidth * 2;
            colorIndex++;
        }

        // Add y-axis
        report.append("<line x1='0' y1='0' x2='0' y2='250' stroke='#333' stroke-width='2'/>");
        for (int i = 0; i <= 10; i++) {
            int y = 250 - (i * 25);
            report.append("<line x1='-5' y1='").append(y).append("' x2='5' y2='").append(y).append("' stroke='#333' stroke-width='1'/>");
            report.append("<text x='-10' y='").append(y + 5).append("' text-anchor='end' font-size='10'>").append(i * 3).append("</text>");
        }

        report.append("</svg>");
        report.append("</div>");
    }

    private static void appendChallengeDetails(StringBuilder report, Map<String, StringBuilder> challengeDetails) {
        for (Map.Entry<String, StringBuilder> entry : challengeDetails.entrySet()) {
            report.append("<div class='challenge-section'>");
            report.append("<h2>Challenge: ").append(entry.getKey()).append("</h2>");
            report.append("<table>");
            report.append("<tr><th>Attempt</th><th>Question</th><th>Correct?</th></tr>");
            report.append(entry.getValue());
            report.append("</table>");
            report.append("</div>");
        }
    }

    private static void appendQuestionDetails(StringBuilder details, int attemptNumber, String questionText, boolean isCorrect) {
        details.append("<tr>");
        details.append("<td>").append(attemptNumber).append("</td>");
        details.append("<td>").append(questionText).append("</td>");
        details.append("<td class='").append(isCorrect ? "correct" : "incorrect").append("'>")
                .append(isCorrect ? "Yes" : "No").append("</td>");
        details.append("</tr>");
    }

    public static BufferedImage getParticipantImage(Connection connection, String participantID) {
        try (PreparedStatement statement = connection.prepareStatement(PARTICIPANT_QUERY)) {
            statement.setString(1, participantID);
            ResultSet resultSet = statement.executeQuery();
            if (resultSet.next()) {
                Blob blob = resultSet.getBlob("imageFile");
                if (blob != null) {
                    try (InputStream inputStream = blob.getBinaryStream()) {
                        return ImageIO.read(inputStream);
                    } catch (IOException e) {
                        System.err.println("Error reading participant image: " + e.getMessage());
                    }
                }
            }
        } catch (SQLException e) {
            System.err.println("Error retrieving participant image: " + e.getMessage());
        }
        return null;
    }

    private static String imageToBase64(BufferedImage image) {
        try {
            ByteArrayOutputStream outputStream = new ByteArrayOutputStream();
            ImageIO.write(image, "jpeg", outputStream);
            return Base64.getEncoder().encodeToString(outputStream.toByteArray());
        } catch (IOException e) {
            System.err.println("Error converting image to Base64: " + e.getMessage());
            return "";
        }
    }

    private static class ChallengeSummary {
        private int attemptCount;
        private int bestScore;

        void addAttempt(int attemptNumber, int score) {
            attemptCount = Math.max(attemptCount, attemptNumber);
            bestScore = Math.max(bestScore, score);
        }

        int getAttemptCount() {
            return attemptCount;
        }

        int getBestScore() {
            return bestScore;
        }
    }
}