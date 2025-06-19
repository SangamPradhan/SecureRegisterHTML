<?php
// register.php
session_start();
require 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Get form data
        $firstName = trim($_POST['firstName'] ?? '');
        $lastName = trim($_POST['lastName'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';
        $confirmPassword = $_POST['confirmPassword'] ?? '';
        
        // Validation
        $errors = [];
        
        if (empty($firstName)) {
            $errors[] = "First name is required";
        }
        
        if (empty($lastName)) {
            $errors[] = "Last name is required";
        }
        
        if (empty($email)) {
            $errors[] = "Email is required";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Invalid email format";
        }
        
        if (empty($password)) {
            $errors[] = "Password is required";
        } elseif (strlen($password) < 6) {
            $errors[] = "Password must be at least 6 characters long";
        }
        
        if ($password !== $confirmPassword) {
            $errors[] = "Passwords do not match";
        }
        
        // Check if email already exists
        if (empty($errors)) {
            $checkEmailSql = "SELECT id FROM users WHERE email = :email";
            $checkStmt = $pdo->prepare($checkEmailSql);
            $checkStmt->bindParam(':email', $email);
            $checkStmt->execute();
            
            if ($checkStmt->rowCount() > 0) {
                $errors[] = "Email already exists";
            }
        }
        
        if (!empty($errors)) {
            // Return JSON error for AJAX
            header('Content-Type: application/json');
            echo json_encode([
                'success' => false,
                'message' => implode(', ', $errors)
            ]);
            exit;
        }
        
        // Hash the password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        
        // Insert user into database
        $sql = "INSERT INTO users (first_name, last_name, email, password) VALUES (:firstName, :lastName, :email, :password)";
        $stmt = $pdo->prepare($sql);
        
        $stmt->bindParam(':firstName', $firstName);
        $stmt->bindParam(':lastName', $lastName);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hashedPassword);
        
        if ($stmt->execute()) {
            // Return JSON success for AJAX
            header('Content-Type: application/json');
            echo json_encode([
                'success' => true,
                'message' => 'Registration Successful! You can now login.'
            ]);
            exit;
        } else {
            header('Content-Type: application/json');
            echo json_encode([
                'success' => false,
                'message' => 'Registration failed. Please try again.'
            ]);
            exit;
        }
        
    } catch (PDOException $e) {
        error_log("Registration error: " . $e->getMessage());
        header('Content-Type: application/json');
        echo json_encode([
            'success' => false,
            'message' => 'Database error occurred. Please try again.'
        ]);
        exit;
    }
} else {
    header('Location: ../front/login.html');
    exit;
}
?>