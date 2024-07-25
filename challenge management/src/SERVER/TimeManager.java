package SERVER;

import java.time.LocalDateTime;
import java.time.format.DateTimeFormatter;
import java.time.temporal.ChronoUnit;

public class TimeManager {
    private LocalDateTime startTime;
    private final LocalDateTime endTime;
    private final LocalDateTime quizStartTime;

    public TimeManager(String startDate, String startTime, String endTime) {
        DateTimeFormatter formatter = DateTimeFormatter.ofPattern("yyyy-MM-dd HH:mm:ss");
        this.startTime = LocalDateTime.parse(startDate + " " + startTime, formatter);
        this.endTime = LocalDateTime.parse(startDate + " " + endTime, formatter);
        this.quizStartTime = LocalDateTime.now();
    }

    public long getRemainingTimeInSeconds() {
        LocalDateTime now = LocalDateTime.now();
        return ChronoUnit.SECONDS.between(now, endTime);
    }

    public String getRemainingTimeFormatted() {
        long seconds = getRemainingTimeInSeconds();
        long minutes = seconds / 60;
        seconds %= 60;
        return String.format("%02d:%02d", minutes, seconds);
    }

    public boolean isTimeUp() {
        return LocalDateTime.now().isAfter(endTime);
    }

    public String getElapsedTimeFormatted() {
        LocalDateTime now = LocalDateTime.now();
        long seconds = ChronoUnit.SECONDS.between(quizStartTime, now);
        long minutes = seconds / 60;
        seconds %= 60;
        return String.format("%02d:%02d", minutes, seconds);
    }
}