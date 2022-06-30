import java.sql.*;

public class Connect {

    // Constants
    private static final String DB_USERNAME = "pinar.yucel";
    private static final String DB_NAME = "pinar_yucel";
    private static final String DB_PASSWORD = "PdePaySb";
	private static final String DB_URL = "jdbc:mysql://pinar.yucel@dijkstra.ug.bcc.bilkent.edu.tr/" + DB_NAME + "?user=" + DB_USERNAME + "&password=" + DB_PASSWORD;

    public static void main(String[] args) {

        try (Connection conn = DriverManager.getConnection(DB_URL);
             Statement stmt = conn.createStatement()) {
        	
        	// Drop the tables if they already exist
            stmt.executeUpdate("DROP TABLE IF EXISTS apply;");
            stmt.executeUpdate("DROP TABLE IF EXISTS student;");
            stmt.executeUpdate("DROP TABLE IF EXISTS company;");
            
            // Create tables
            stmt.executeUpdate(
                    "CREATE TABLE student(" +
                            "sid            CHAR(12) PRIMARY KEY," +
                            "sname          VARCHAR(50)," +
                            "bdate          DATE," +
                            "address        VARCHAR(50)," +
                            "scity          VARCHAR(20)," +
                            "year           CHAR(20)," +
                            "gpa            FLOAT," +
                            "nationality    VARCHAR(20)" +
                            ");"
            );

            stmt.executeUpdate(
                    "CREATE TABLE company(" +
                            "cid            CHAR(8) PRIMARY KEY," +
                            "cname          VARCHAR(20)," +
                            "quota          INT" +
                            ");"
            );
            
            stmt.executeUpdate(
                    "CREATE TABLE apply(" +
                            "sid    CHAR(12)," +
                            "cid    CHAR(8)," +
                            "PRIMARY KEY (sid, cid)," +
                            "FOREIGN KEY (sid) REFERENCES student(sid) ON DELETE CASCADE," +
                            "FOREIGN KEY (cid) REFERENCES company(cid) ON DELETE CASCADE" +
                            ") ENGINE=InnoDB;"
            );
            
            // Insert values
            stmt.executeUpdate( "INSERT INTO student VALUES ('21000001', 'John', '1999-05-14', 'Windy', 'Chicago', 'senior', '2.33', 'US');");
            stmt.executeUpdate( "INSERT INTO student VALUES ('21000002', 'Ali', '2001-09-30', 'Nisantasi', 'Istanbul', 'junior', '3.26', 'TC');");
            stmt.executeUpdate( "INSERT INTO student VALUES ('21000003', 'Veli', '2003-02-25', 'Nisantasi', 'Istanbul', 'freshman', '2.41', 'TC');");
            stmt.executeUpdate( "INSERT INTO student VALUES ('21000004', 'Ayse', '2003-01-15', 'Tunali', 'Ankara', 'freshman', '2.55', 'TC');");
            
            stmt.executeUpdate( "INSERT INTO company VALUES ('C101', 'microsoft', '2');");
            stmt.executeUpdate( "INSERT INTO company VALUES ('C102', 'merkez bankasi', '5');");
            stmt.executeUpdate( "INSERT INTO company VALUES ('C103', 'tai', '3');");
            stmt.executeUpdate( "INSERT INTO company VALUES ('C104', 'tubitak', '5');");
            stmt.executeUpdate( "INSERT INTO company VALUES ('C105', 'aselsan', '3');");
            stmt.executeUpdate( "INSERT INTO company VALUES ('C106', 'havelsan', '4');");
            stmt.executeUpdate( "INSERT INTO company VALUES ('C107', 'milsoft', '2');");
            
            stmt.executeUpdate( "INSERT INTO apply VALUES ('21000001', 'C101');");
            stmt.executeUpdate( "INSERT INTO apply VALUES ('21000001', 'C102');");
            stmt.executeUpdate( "INSERT INTO apply VALUES ('21000001', 'C103');");
            stmt.executeUpdate( "INSERT INTO apply VALUES ('21000002', 'C101');");
            stmt.executeUpdate( "INSERT INTO apply VALUES ('21000002', 'C105');");
            stmt.executeUpdate( "INSERT INTO apply VALUES ('21000003', 'C104');");
            stmt.executeUpdate( "INSERT INTO apply VALUES ('21000003', 'C105');");
            stmt.executeUpdate( "INSERT INTO apply VALUES ('21000004', 'C107');");

            ResultSet resultSet = stmt.executeQuery("SELECT * FROM student;");
            
            try {
                printTable(resultSet);
            } catch (SQLException ex) {
            	System.out.println("Could not print the table."); 
                ex.printStackTrace();
            }
        } catch (SQLException ex){ // handle the exception
        	System.out.println("Could not connect to the database."); 
            ex.printStackTrace();
        }
    }
    
    private static void printTable(ResultSet resultSet) throws SQLException {
        ResultSetMetaData metaData = resultSet.getMetaData();
        System.out.println("Table: " + metaData.getTableName(1));
        int columnCount = metaData.getColumnCount();
        
        // print the attribute names
        for (int i = 1; i <= columnCount; i++) { 
            System.out.printf("%-15s", metaData.getColumnLabel(i));
        }
        
        System.out.println();
        
        while (resultSet.next()) {
        	// print tuples
            for (int i = 1; i <= columnCount; i++) {
                System.out.printf("%-15s", resultSet.getString(i));
            }
            
            System.out.println(); 
        }
        
        System.out.println();
    }
}
