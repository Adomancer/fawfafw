/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package cafeseven;

import java.sql.*;
import java.util.ArrayList;
import java.util.List;
import java.util.Optional;
import java.util.logging.Level;
import java.util.logging.Logger;

/**
 *
 * @author dimdd
 */
public class Database {
    private static Connection conn = null;

    public Connection getConn() {
        String url = "jdbc:mysql://localhost:3306/cafedb";
        String username = "root";
        String password = "";
        try {
            Class.forName("com.mysql.jdbc.Driver");
            if(conn == null || conn.isClosed()) {
                Database.conn = DriverManager.getConnection(url, username, password);
            }
        } catch (SQLException e) {
            System.out.println("Failed to get connection \n" + e.getMessage());
} catch (ClassNotFoundException er) {
                System.out.println("Failed to get connection \n" + er.getMessage());
        } finally {
            return Database.conn;
        }
    }
    
    public Optional<User> getUser(String email) {
        try(Connection db = this.getConn()) {
            if(db == null) {
                return Optional.ofNullable(null);
            }
            
            try(PreparedStatement ps = db.prepareStatement("SELECT * from users WHERE email = ?")) {
                ps.setString(1, email);
                try (ResultSet rs = ps.executeQuery()) {
                    if(rs.next()) {
                        int id = rs.getInt("id");
                        String emails = rs.getString("email");
                        String firstName = rs.getString("first_name");
                        String lastName = rs.getString("last_name");
                        String password = rs.getString("password");
                        User user = new User(id, emails, firstName, lastName, password);
                        return Optional.ofNullable(user);
                    }
                    return Optional.ofNullable(null);
                }
            }
            
        } catch (SQLException err) {
            System.out.println(err.getMessage());
            return Optional.ofNullable(null);
        }
    }
    
    public void addItems(String name, int price, String category) {
        try (Connection db = this.getConn()) {
            if (db == null) {
                return;
            }
            try (PreparedStatement ps = db.prepareStatement("INSERT INTO items (name, price, category) VALUES (?, ?, ?)", Statement.RETURN_GENERATED_KEYS)) {
                ps.setString(1, name);
                ps.setInt(2, price);
                ps.setString(3, category);
                ps.executeUpdate();
            }
        } catch (SQLException err) {
            System.out.println(err.getMessage());
        }
    }
    
    public Optional<List<ItemsClass>> getItems() {
        try(Connection db = this.getConn()) {
            if(db == null) {
                return Optional.ofNullable(null);
            }
            
            try(PreparedStatement ps = db.prepareStatement("SELECT * from items")) {
                try (ResultSet rs = ps.executeQuery()) {
                    List<ItemsClass> items = new ArrayList<>();
                    while(rs.next()) {
                        int id = rs.getInt("id");
                        String name = rs.getString("name");
                        int price = rs.getInt("price");
                        String category = rs.getString("category");
                        ItemsClass item = new ItemsClass(id, name, price, category);
                        items.add(item);
                    }
                    if(items.size() < 1) {
                        return Optional.ofNullable(null);
                    }
                    return Optional.ofNullable(items);
                }
            }
            
        } catch (SQLException err) {
            System.out.println(err.getMessage());
            return Optional.ofNullable(null);
        }
    }
    
    public void deleteItems(int id) {
        try (Connection db = this.getConn()) {
           if(db == null) {
               System.out.println("Failed to delete game DB Error.");
               return;
           }
           try (PreparedStatement ps = db.prepareStatement("DELETE FROM items WHERE id = ?")) {
               ps.setInt(1, id);
               ps.executeUpdate();
           }
       } catch (SQLException e) {
           System.out.println(e.getMessage());
       }
    }
    
    public void updateItems(int id, String name, int price, String category) {
        try (Connection db = this.getConn()) {
            if(db == null) {
                System.out.println("Failed to edit game DB Error.");
                return;
            }
            try (PreparedStatement ps = db.prepareStatement("UPDATE items SET name = ?, price = ?, category = ? WHERE id = ?")) {
                ps.setString(1, name);
                ps.setInt(2, price);
                ps.setString(3, category);
                ps.setInt(4, id);
                ps.executeUpdate();
            }
        } catch (SQLException e) {
           System.out.println(e.getMessage());
       }
    }
}
