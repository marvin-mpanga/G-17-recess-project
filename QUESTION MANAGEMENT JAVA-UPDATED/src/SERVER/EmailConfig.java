package SERVER;

public class EmailConfig {
    public static final String SMTP_HOST = System.getenv("MATH_CHALLENGE_SMTP_HOST");
    public static final String SMTP_PORT = System.getenv("MATH_CHALLENGE_SMTP_PORT");
    public static final String USERNAME = System.getenv("MATH_CHALLENGE_EMAIL_USERNAME");
    public static final String PASSWORD = System.getenv("MATH_CHALLENGE_EMAIL_PASSWORD");
}