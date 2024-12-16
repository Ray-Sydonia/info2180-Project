<?php
include 'utils/function.php';
$conn = getConn();

$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

$sql = $conn->prepare("SELECT id, password, role FROM users WHERE email = :email");
$sql->execute(['email' => $email]);
$user = $sql->fetch(PDO::FETCH_ASSOC);

if ($user && password_verify($password, $user['password'])) {
    session_start();
    $_SESSION['id'] = $user['id'];
    $_SESSION['role'] = $user['role'];
    header('Location: home.php');
} else {
    header('Location: login.php');
}
