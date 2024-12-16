<?php
include 'utils/function.php';
$conn = getConn();

$firstname = filter_input(INPUT_POST, 'first_name', FILTER_SANITIZE_SPECIAL_CHARS);
$lastname = filter_input(INPUT_POST, 'last_name', FILTER_SANITIZE_SPECIAL_CHARS);
$password = password_hash(filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS), PASSWORD_DEFAULT);
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_SPECIAL_CHARS);
$role = filter_input(INPUT_POST, 'role', FILTER_SANITIZE_SPECIAL_CHARS);
$created_at = date('Y-m-d h:i:s');

$sql = $conn->exec("INSERT INTO users (firstname, lastname, password, email, role, created_at) VALUES('$firstname', '$lastname', '$password', '$email', '$role', '$created_at')");

echo "<script>alert('User created successfully!');window.location.href='home.php';</script>";