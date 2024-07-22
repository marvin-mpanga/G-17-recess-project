package SERVER;

import java.io.IOException;
import java.net.ServerSocket;
import java.net.Socket;
import java.util.concurrent.ExecutorService;
import java.util.concurrent.Executors;
import java.util.concurrent.TimeUnit;

public class Server {
    private static final int PORT = 1234;
    private static ServerSocket serverSocket;
    private static ExecutorService threadPool;

    public static void main(String[] args) {
        threadPool = Executors.newCachedThreadPool();

        try {
            serverSocket = new ServerSocket(PORT);
            System.out.println("Server started on port " + PORT);

            while (!serverSocket.isClosed()) {
                try {
                    Socket clientSocket = serverSocket.accept();
                    threadPool.execute(new ClientHandler(clientSocket));
                } catch (IOException e) {
                    if (!serverSocket.isClosed()) {
                        System.err.println("Error accepting client connection: " + e.getMessage());
                    }
                }
            }
        } catch (IOException e) {
            System.err.println("Could not listen on port " + PORT);
        } finally {
            shutdown();
        }
    }

    public static void shutdown() {
        System.out.println("Shutting down server...");
        if (serverSocket != null && !serverSocket.isClosed()) {
            try {
                serverSocket.close();
            } catch (IOException e) {
                System.err.println("Error closing server socket: " + e.getMessage());
            }
        }
        if (threadPool != null) {
            threadPool.shutdown();
            try {
                if (!threadPool.awaitTermination(60, TimeUnit.SECONDS)) {
                    threadPool.shutdownNow();
                }
            } catch (InterruptedException e) {
                threadPool.shutdownNow();
            }
        }
        Database.closeConnection();
        System.out.println("Server shutdown complete.");
    }
}