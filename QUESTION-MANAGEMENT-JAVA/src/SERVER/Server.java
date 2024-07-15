package SERVER;

import java.io.IOException;
import java.net.ServerSocket;
import java.net.Socket;

public class Server {
    public static void main(String[] args) {
        try (ServerSocket server = new ServerSocket(1234)) {
            while(true){
                Socket socket=server.accept();
                

                new ClientHandler(socket).start();
            }
        } catch (IOException e) {
            
            e.printStackTrace();
        }
    }
}
