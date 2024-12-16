<?php
session_start();
require 'database_connection.php';

$_SESSION['user_id'] = $user_id;


// Check if user is logged in
//if (!isset($_SESSION['user_id'])) {
    //echo json_encode(['success' => false, 'message' => 'User not logged in.']);
    //exit;
//}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize and validate input
    $title = htmlspecialchars($_POST['title']);
    $firstname = htmlspecialchars($_POST['firstname']);
    $lastname = htmlspecialchars($_POST['lastname']);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $telephone = htmlspecialchars($_POST['telephone']);
    $company = htmlspecialchars($_POST['company']);
    $type = htmlspecialchars($_POST['type']);
    $assigned_to = intval($_POST['assigned_to']);
    $created_by = $_SESSION['user_id']; 

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(['success' => false, 'message' => 'Invalid email address.']);
        exit;
    }

    // Validate required fields
    if ($firstname && $lastname && $email) {
        $stmt = $pdo->prepare("INSERT INTO contacts (title, firstname, lastname, email, telephone, company, type, assigned_to, created_by, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), NOW())");

        if ($stmt->execute([$title, $firstname, $lastname, $email, $telephone, $company, $type, $assigned_to, $created_by])) {
            echo json_encode(['success' => true, 'message' => 'Contact created successfully.']);
        } else {
            // Log error if query fails
            $errorInfo = $stmt->errorInfo();
            error_log("Error executing statement: " . implode(", ", $errorInfo));
            echo json_encode(['success' => false, 'message' => 'Error creating contact.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'First name, last name, and email are required.']);
    }
}
?>

