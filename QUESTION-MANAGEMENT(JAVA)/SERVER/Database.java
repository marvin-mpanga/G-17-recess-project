package SERVER;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.SQLException;

public class Database {
    private static final String DB_URL = "jdbc:mysql://localhost:3306/math_challenge";
    private static final String DB_USER="root";
    private static final String DB_PASSWORD="";
    Connection connection;
    
    public  static Connection databaseConnection() throws SQLException {

        
        return DriverManager.getConnection(DB_URL, DB_USER, DB_PASSWORD);
    }
    
}
