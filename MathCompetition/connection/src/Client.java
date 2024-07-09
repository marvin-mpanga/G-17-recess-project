import java.io.*;
import java.net.Socket;
import java.io.InputStreamReader;
import java.io.BufferedReader;
import java.io.PrintWriter;
import java.util.Scanner;

public class Client {

    public static void main(String[] args) {
        String hostname = "localhost";
        int port = 2222; // Port number on which the server listens

        try (Socket socket = new Socket(hostname, port);
             PrintWriter output = new PrintWriter(socket.getOutputStream(), true);
             BufferedReader input = new BufferedReader(new InputStreamReader(socket.getInputStream()))) {

            System.out.println("Connected to the server.");

            Scanner scanner = new Scanner(System.in);

            // Send the "register" command
            output.println("register");

            System.out.print("Enter username: ");
            String username = scanner.nextLine();

            System.out.print("Enter firstname: ");
            String firstname = scanner.nextLine();

            System.out.print("Enter lastname: ");
            String lastname = scanner.nextLine();

            System.out.print("Enter date of birth: ");
            String dateOfBirth = scanner.nextLine();

            System.out.print("Enter school registration number: ");
            String schoolRegistrationNumber = scanner.nextLine();

            System.out.print("Enter the image URL: ");
            String imageFile = scanner.nextLine();

            // Send data to the server
            output.println(username);
            output.println(firstname);
            output.println(lastname);
            output.println(dateOfBirth);
            output.println(schoolRegistrationNumber);
            output.println(imageFile);

            // Read server response
            String serverResponse;
            while ((serverResponse = input.readLine()) != null) {
                System.out.println("Server response: " + serverResponse);
            }

        } catch (IOException e) {
            e.printStackTrace();
        }
    }
}
