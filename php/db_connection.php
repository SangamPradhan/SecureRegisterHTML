<?php
// db_connection.php
$host = "localhost";
$dbname = "auth_system";
$port = "3308";
$username = "root"; // Default XAMPP username
$password = ""; // Default XAMPP password

try {
    // Create PDO connection with additional options
    $pdo = new PDO(
        "mysql:host=$host;dbname=$dbname;port=$port;charset=utf8mb4", 
        $username, 
        $password,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ]
    );
    
    // Test the connection
    // echo "Connected successfully to database: $dbname";
    
} catch (PDOException $e) {
    // Log error details
    error_log("Database connection failed: " . $e->getMessage());
    
    // Display user-friendly error message
    die("Database connection failed. Please check your database configuration.");
}
?>