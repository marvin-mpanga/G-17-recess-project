package SERVER;

import java.io.*;
import java.sql.*;
import java.time.LocalDateTime;
import java.time.format.DateTimeFormatter;
import java.util.*;

public class ChooseChallenge {
    private static final String CHALLENGE_QUERY = "SELECT challengeID, challengeName, challengeDate, startTime, endTime FROM challenge WHERE ? BETWEEN CONCAT(challengeDate, ' ', startTime) AND CONCAT(challengeDate, ' ', endTime)";

    public static void viewChallenges(Connection connection, PrintWriter writer, BufferedReader reader, String participantID) throws SQLException {
        Map<String, ChallengeInfo> challengeMap = new HashMap<>();

        try {
            displayChallenges(connection, writer, challengeMap);
            if (!challengeMap.isEmpty()) {
                handleUserInput(connection, writer, reader, challengeMap, participantID);
            } else {
                writer.println("There are no available challenges right now.");
            }
        } catch (SQLException e) {
            writer.println("Error retrieving challenges: " + e.getMessage());
            e.printStackTrace();
        }
    }

    private static void displayChallenges(Connection connection, PrintWriter writer, Map<String, ChallengeInfo> challengeMap) throws SQLException {
        LocalDateTime now = LocalDateTime.now();
        String currentDateTime = now.format(DateTimeFormatter.ofPattern("yyyy-MM-dd HH:mm:ss"));

        try (PreparedStatement statement = connection.prepareStatement(CHALLENGE_QUERY)) {
            statement.setString(1, currentDateTime);
            ResultSet challenges = statement.executeQuery();
            writer.println("Available challenges:");
            while (challenges.next()) {
                String challengeID = challenges.getString("challengeID");
                String challengeName = challenges.getString("challengeName");
                String challengeDate = challenges.getString("challengeDate");
                String startTime = challenges.getString("startTime");
                String endTime = challenges.getString("endTime");

                LocalDateTime challengeEndTime = LocalDateTime.parse(challengeDate + " " + endTime, DateTimeFormatter.ofPattern("yyyy-MM-dd HH:mm:ss"));
                
                if (now.isBefore(challengeEndTime)) {
                    ChallengeInfo challengeInfo = new ChallengeInfo(challengeID, challengeDate, startTime, endTime);
                    challengeMap.put(challengeName, challengeInfo);
                    writer.println("- " + challengeName);
                }
            }
            writer.flush();

            if (challengeMap.isEmpty()) {
                writer.println("No challenges available at the moment.");
            } else {
                writer.println("Enter the name of the challenge you want to attempt (or 'exit' to go back):");
            }
            writer.flush();
        }
    }

    private static void handleUserInput(Connection connection, PrintWriter writer, BufferedReader reader, Map<String, ChallengeInfo> challengeMap, String participantID) {
        try {
            String userInput;
            while ((userInput = reader.readLine()) != null && !userInput.equalsIgnoreCase("exit")) {
                if (challengeMap.containsKey(userInput)) {
                    ChallengeInfo challengeInfo = challengeMap.get(userInput);
                    LocalDateTime now = LocalDateTime.now();
                    LocalDateTime challengeEndTime = LocalDateTime.parse(challengeInfo.challengeDate + " " + challengeInfo.endTime, DateTimeFormatter.ofPattern("yyyy-MM-dd HH:mm:ss"));
                    
                    if (now.isBefore(challengeEndTime)) {
                        writer.println("You selected challenge: " + userInput);
                        TimeManager timeManager = new TimeManager(challengeInfo.challengeDate, challengeInfo.startTime, challengeInfo.endTime);
                        AttemptChallenge.startQuiz(connection, writer, reader, challengeInfo.challengeID, participantID, timeManager);
                        return; // Exit after attempting a challenge
                    } else {
                        writer.println("This challenge has already ended. Please select another challenge.");
                    }
                } else {
                    writer.println("Invalid challenge name. Please try again.");
                }
                writer.println("Enter a challenge name or 'exit' to go back:");
                writer.flush();
            }
        } catch (IOException e) {
            writer.println("Error reading input: " + e.getMessage());
        }
    }

    private static class ChallengeInfo {
        String challengeID;
        String challengeDate;
        String startTime;
        String endTime;

        ChallengeInfo(String challengeID, String challengeDate, String startTime, String endTime) {
            this.challengeID = challengeID;
            this.challengeDate = challengeDate;
            this.startTime = startTime;
            this.endTime = endTime;
        }
    }
}