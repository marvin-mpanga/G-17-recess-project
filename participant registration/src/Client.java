
import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStreamReader;
import java.io.PrintWriter;
import java.net.Socket;
import java.util.Scanner;

public class Client {
    public static void main(String[] args) {
        System.out.println("Client connected....");
        try (
                Socket socket = new Socket("localhost", 2222);
                BufferedReader in = new BufferedReader(new InputStreamReader(socket.getInputStream()));
                PrintWriter out = new PrintWriter(socket.getOutputStream(), true);
                Scanner scanner = new Scanner(System.in)) {

            Menu();
            String command, response;
            do {
                System.out.println("Enter the command:");
                command = scanner.nextLine();
                out.println(command);

                if (command.equalsIgnoreCase("exit")) {
                    System.out.println("Process terminated.");
                    break;
                }

                if (command.equalsIgnoreCase("view applicants")) {
                    while (true) {
                        response = in.readLine();
                        if (response == null || response.equals("end of list")) {
                            break;
                        }
                        System.out.println(response);
                    }
                } else if (command.toLowerCase().startsWith("verify")) {
                    System.out.println("Enter 'YES/NO and username' to verify applicants, or 'done' to finish:");
                    while (true) {
                        String verifyCommand = scanner.nextLine();
                        if (verifyCommand.equalsIgnoreCase("done")) {
                            break;
                        }
                        out.println(verifyCommand);
                        response = in.readLine();
                        if (response == null) {
                            System.out.println("Connection closed by server.");
                            break;
                        }
                        System.out.println(response);
                    }
                } else {
                    response = in.readLine();
                    if (response == null) {
                        System.out.println("Connection closed by server.");
                        break;
                    }
                    System.out.println(response);
                }
            } while (!command.equalsIgnoreCase("exit"));

        } catch (IOException e) {
            System.out.println("Error: " + e.getMessage());
            e.printStackTrace();
        }
    }

    public static void Menu() {
        System.out.println("MENU:");
        String menu = """
                register username firstname lastname email dateOfBirth schoolRegistrationNumber imageFile
                login username password
                view applicants
                verify applicants
                exit
                 """;
        System.out.println(menu);
    }
}
