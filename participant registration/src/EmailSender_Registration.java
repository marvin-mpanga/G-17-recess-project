
import javax.mail.*;
import javax.mail.internet.*;
import java.util.Properties;

public class EmailSender_Registration {

    private static final String SMTP_SERVER = "smtp.gmail.com";
    private static final String USERNAME = "tumukundeandrew07@gmail.com";
    private static final String PASSWORD = "lcuc vpwi adxo cjmi";
    private static final String FROM_EMAIL = "tumukundeandrew07@gmail.com";

    private static Session getSession() {
        Properties properties = new Properties();
        properties.put("mail.smtp.auth", "true");
        properties.put("mail.smtp.starttls.enable", "true");
        properties.put("mail.smtp.host", SMTP_SERVER);
        properties.put("mail.smtp.port", "587");
        properties.put("mail.smtp.ssl.protocols", "TLSv1.2");

        return Session.getInstance(properties, new Authenticator() {
            @Override
            protected PasswordAuthentication getPasswordAuthentication() {
                return new PasswordAuthentication(USERNAME, PASSWORD);
            }
        });
    }

    public static void sendEmail(String to, String subject, String body) {
        try {
            Message message = new MimeMessage(getSession());
            message.setFrom(new InternetAddress(FROM_EMAIL));
            message.setRecipients(Message.RecipientType.TO, InternetAddress.parse(to));
            message.setSubject(subject);
            message.setText(body);

            Transport.send(message);
            System.out.println("Email sent to " + to);
        } catch (MessagingException e) {
            e.printStackTrace();
        }
    }

    public static void sendVerificationRequestEmail(String repEmail, String username) {
        String subject = "New Pupil Registration - Verification Required";
        String body = "A new pupil named " + username + " has registered. Please verify their registration.";
        sendEmail(repEmail, subject, body);
        System.out.println("EMAIL SENT SUCCESSFULLY");
    }

    public static void sendVerificationStatusEmail(String email, boolean isVerified) {
        String subject = isVerified ? "Registration Verified" : "Registration Denied";
        String body = isVerified ? "Your registration has been successfully verified." : "Your registration has been denied.";
        sendEmail(email, subject, body);
    }

//        public static void main(String[] args) {
//            sendVerificationRequestEmail("tumukundeandrew07@gmail.com","andrew");
//        }

}


