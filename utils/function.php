<?php
/**
 * @return PDO|void
 */
function getConn()
{
    $host = "localhost";
    $db_username = "pro_user";
    $db_password = "password123";
    $database = "dolphin_crm";

    try {
        $conn = new PDO("mysql:host=$host;dbname=$database;charset=utf8mb4", $db_username, $db_password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
        die();
    }
    return $conn;
}
