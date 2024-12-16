<?php
// Include database connection file
require_once 'db_connection.php';



if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $firstname = trim($_POST['firstname']);
    $lastname = trim($_POST['lastname']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $role = trim($_POST['role']);

    // Password validation (at least 8 characters, 1 letter, 1 number, 1 uppercase)
    if (!preg_match('/^(?=.*[a-zA-Z])(?=.*\d)(?=.*[A-Z]).{8,}$/', $password)) {
        echo "<script>alert('Password must be at least 8 characters long and contain at least one letter, one number, and one uppercase letter.');</script>";
        exit; // Stop execution if validation fails
    }

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    // Prepare SQL query to insert new user into the users table
    $sql = "INSERT INTO users (firstname, lastname, email, password, role, created_at) 
            VALUES (:firstname, :lastname, :email, :password, :role, NOW())";

    // Use prepared statements to prevent SQL injection
    if ($stmt = $conn->prepare($sql)) {
        // Bind parameters using bindParam for PDO
        $stmt->bindParam(':firstname', $firstname);
        $stmt->bindParam(':lastname', $lastname);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hashed_password);
        $stmt->bindParam(':role', $role);

        // Execute the statement
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            // Success message
            header('Location: users.php');
            echo "<script>alert('User added successfully!'); window.location.href='users.php';</script>";
        } else {
            // Error message
            echo "<script>alert('Error adding user.');</script>";
        }

        $stmt->close();
    } else {
        echo "<script>alert('Error preparing statement.');</script>";
    }

    // Close the database connection
    $conn = null;
}
?>
