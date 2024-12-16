<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dolphin CRM</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@400;600&family=Roboto:wght@300;400;700&display=swap"
          rel="stylesheet">
    <link rel="stylesheet" href="styles.css" media="screen"/>
    <script src="https://code.jquery.com/jquery-3.6.1.js"></script>
    <script src="utils/functions.js" charset="utf-8"></script>
    <script src="index.js" charset="utf-8"></script>
</head>
<body>
<header id="head">
    <img src="img/dolphin.png" alt="">
    <p>Dolphin CRM</p>
</header>
<main class="main">
    <section id="nav">
        <?php include 'home_nav.php'; ?>
    </section>
    <section id="results">
        <?php include 'dashboard.php'; ?>
    </section>
</main>
</body>
</html>