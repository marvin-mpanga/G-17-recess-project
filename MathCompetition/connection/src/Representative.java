import java.io.*;
import java.net.Socket;
import java.util.Scanner;

public class Representative {

    public static void main(String[] args) {
        String hostname = "localhost";
        int port = 2222; // Port number on which the server listens

        try (Socket socket = new Socket(hostname, port);
             PrintWriter output = new PrintWriter(socket.getOutputStream(), true);
             BufferedReader input = new BufferedReader(new InputStreamReader(socket.getInputStream()))) {

            System.out.println("Connected to the server.");

            Scanner scanner = new Scanner(System.in);

            // School representative login
            System.out.print("Enter your name: ");
            String repName = scanner.nextLine();

            System.out.print("Enter your password: ");
            String repPassword = scanner.nextLine();

            // Send login credentials to the server
            output.println("login");
            output.println(repName);
            output.println(repPassword);

            // Check login response from server
            String loginResponse = input.readLine();
            if (!"Login successful".equals(loginResponse)) {
                System.out.println("Login failed: " + loginResponse);
                return;
            }
            System.out.println(loginResponse);

            // Prompt representative to enter the "view applicants" command
            System.out.print("Enter 'view applicants' to see the list of applicants: ");
            String command = scanner.nextLine();
            if (!"view applicants".equalsIgnoreCase(command)) {
                System.out.println("Invalid command. Exiting...");
                return;
            }
            output.println("view applicants");

            // Read and display the list of applicants
            String applicant;
            while (!(applicant = input.readLine()).equals("end of list")) {
                System.out.println(applicant);
            }

            // Start verifying each applicant
            while (true) {
                System.out.print("Enter YES/NO and username to verify or decline, 'exit' to quit: ");
                String verificationCommand = scanner.nextLine();
                if (verificationCommand.equalsIgnoreCase("exit")) {
                    break;
                }
                output.println("verify");
                output.println(verificationCommand);

                // Read server response
                String serverResponse = input.readLine();
                System.out.println("Server response: " + serverResponse);
            }

        } catch (IOException e) {
            e.printStackTrace();
        }
    }
}

