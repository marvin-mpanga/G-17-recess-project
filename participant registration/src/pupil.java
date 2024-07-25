import java.io.*;
import java.net.Socket;
import java.util.Scanner;

public class pupil {

    public static void main(String[] args) {
        String hostname = "localhost";
        int port = 8000; // Port number on which the server listens

        try (Socket socket = new Socket(hostname, port);
             PrintWriter output = new PrintWriter(socket.getOutputStream(), true);
             BufferedReader input = new BufferedReader(new InputStreamReader(socket.getInputStream()))) {

            System.out.println("Connected to the server.");

            Scanner scanner = new Scanner(System.in);

            // Prompt for the "register" command
            System.out.print("Enter registration details (register username firstname lastname email dateOfBirth schoolRegistrationNumber imageFile): ");
            String commandLine = scanner.nextLine();

            // Send the full command line to the server
            output.println(commandLine);

            // Read and display server response
            String serverResponse = input.readLine();
            System.out.println("Server response: " + serverResponse);

        } catch (IOException e) {
            e.printStackTrace();
        }
    }
}
