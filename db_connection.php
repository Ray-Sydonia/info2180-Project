<?php

$host = 'localhost';
$username = 'pro_user';
$password = 'password123';
$dbname = 'dolphin_crm';

try {
    // Establish a database connection
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    
    // Set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // No need to check for $conn->connect_error in PDO

    echo "Connected successfully"; // Optional, just to check if the connection is successful
}
catch(PDOException $e) {
    // Catch any connection errors
    echo "Connection failed: " . $e->getMessage();
}

?>
