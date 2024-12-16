<?php
include 'utils/function.php';


$conn = getConn();

$sql = $conn->prepare("SELECT * FROM users");
$sql->execute();
$users = $sql->fetchAll(PDO::FETCH_ASSOC);

(!$users) && include_once 'login_initialUsers.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@400;600&family=Roboto:wght@300;400;700&display=swap"
          rel="stylesheet">
    <link rel="stylesheet" href="styles.css" media="screen"/>
    <script src="https://code.jquery.com/jquery-3.6.1.js"></script>
    <script src="utils/functions.js" charset="utf-8"></script>
    <script src="index.js" charset="utf-8"></script>
</head>
<body id="login">
<header>
    <h1>Login</h1>
</header>

<main>
    <form action="login_authenticate.php" method="post">
        <div>
            <label style="display: none" for="email">Email:</label>
            <input type="text" name="email" id="email" placeholder="Email address" required>
        </div>
        <div>
            <label style="display: none" for="password">Password:</label>
            <input type="password" name="password" id="password" placeholder="Password" required>
        </div>
        <input type="submit" value="Login">
    </form>
</main>
<footer>
    <hr>
    <p>Copyright &copy; 2024 Dolphin CRM</p>
</footer>
</body>
</html>