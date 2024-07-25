package SERVER;

import jakarta.mail.*;
import jakarta.mail.internet.*;

import java.util.Properties;

public class EmailSender {
    private static final String SMTP_HOST = EmailConfig.SMTP_HOST;
    private static final String SMTP_PORT = EmailConfig.SMTP_PORT;
    private static final String USERNAME = EmailConfig.USERNAME;
    private static final String PASSWORD = EmailConfig.PASSWORD;

    public static void sendReportEmail(String recipientEmail, String reportContent) {
        if (recipientEmail == null || recipientEmail.isEmpty()) {
            System.err.println("Error: Recipient email is null or empty");
            return;
        }

        if (SMTP_HOST == null || SMTP_PORT == null || USERNAME == null || PASSWORD == null) {
            System.err.println("Error: Email configuration is incomplete. Please check your environment variables.");
            return;
        }

        try {
            sendEmail(recipientEmail, "Your Math Challenge Report", reportContent);
            System.out.println("Email sent successfully to " + recipientEmail);
        } catch (MessagingException e) {
            System.err.println("Error sending email: " + e.getMessage());
        }
    }

    private static void sendEmail(String recipientEmail, String subject, String reportContent) throws MessagingException {
        Properties props = new Properties();
        props.put("mail.smtp.auth", "true");
        props.put("mail.smtp.starttls.enable", "true");
        props.put("mail.smtp.host", SMTP_HOST);
        props.put("mail.smtp.port", SMTP_PORT);
        props.put("mail.smtp.ssl.protocols", "TLSv1.2");
        props.put("mail.smtp.ssl.trust", "*");
        props.put("mail.debug", "true");

        Session session = Session.getInstance(props, new Authenticator() {
            @Override
            protected PasswordAuthentication getPasswordAuthentication() {
                return new PasswordAuthentication(USERNAME, PASSWORD);
            }
        });

        try {
            Message message = new MimeMessage(session);
            message.setFrom(new InternetAddress(USERNAME));
            message.setRecipients(Message.RecipientType.TO, InternetAddress.parse(recipientEmail));
            message.setSubject(subject);

            // Create the message body part
            MimeBodyPart messageBodyPart = new MimeBodyPart();
            messageBodyPart.setContent(reportContent, "text/html; charset=utf-8");

            // Create a multipart message
            Multipart multipart = new MimeMultipart();
            multipart.addBodyPart(messageBodyPart);


            // Set the complete message parts
            message.setContent(multipart);

            Transport.send(message);
        } catch (AddressException e) {
            throw new MessagingException("Invalid email address: " + recipientEmail, e);
        } catch (MessagingException e) {
            throw new MessagingException("Failed to send email: " + e.getMessage(), e);
        }
    }
}