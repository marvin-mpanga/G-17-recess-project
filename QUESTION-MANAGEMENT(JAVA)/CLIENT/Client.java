package CLIENT;

import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStreamReader;
import java.io.PrintWriter;
import java.net.Socket;

public class Client {
    private static Socket socket;
    private static BufferedReader consoleReader;
    private static BufferedReader socketReader;
    private static PrintWriter socketWriter;

    public static void main(String[] args) {
        try {
            socket = new Socket("localhost", 1234);
            System.out.println("################################################################");
            System.out.println("ENTER COMMAND 'login' TO LOG-IN");
            System.out.println("################################################################");

            socketReader = new BufferedReader(new InputStreamReader(socket.getInputStream()));
            consoleReader = new BufferedReader(new InputStreamReader(System.in));
            socketWriter = new PrintWriter(socket.getOutputStream(), true);

            // Start a thread for reading from the console and sending to the server
            Thread consoleThread = new Thread(() -> {
                try {
                    String command;
                    while ((command = consoleReader.readLine()) != null) {
                        System.out.println("Sending command: " + command);  // Debug print
                        socketWriter.println(command);
                    }
                } catch (IOException e) {
                    System.err.println("Error reading from console: " + e.getMessage());
                }
            });
            consoleThread.start();

            // Use the main thread for reading from the socket and printing to console
            String serverResponse;
            while ((serverResponse = socketReader.readLine()) != null) {
                System.out.println(serverResponse);
            }

        } catch (IOException e) {
            System.err.println("Error: " + e.getMessage());
            e.printStackTrace();
        } finally {
            try {
                if (socket != null) socket.close();
            } catch (IOException e) {
                System.err.println("Error closing socket: " + e.getMessage());
            }
        }
    }
}