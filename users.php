<?php
// Database credentials
$host = 'localhost';       // Your database host
$username = 'pro_user';        // Your database username
$password = 'password123';            // Your database password
$dbname = 'dolphin_crm';   // Your database name

try {
    // Create a database connection
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Prepare the SQL SELECT statement
    $sql = "SELECT id, CONCAT(firstname, ' ', lastname) AS name, email, role, created_at FROM Users";
    $stmt = $conn->prepare($sql);

    // Execute the statement
    $stmt->execute();

    // Fetch all users
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Users</title>
    <link href="users.css" type="text/css" rel="stylesheet" />
</head>
<body>
  <div class="container">
    <div class="header">
      <h1>Dolphin CRM</h1>
    </div>
    <div class="sidebar">
        <a href="home.php" class="active">Home</a>
        <a href="new_contact.php">New Contact</a>
        <a href="users.php">Users</a>
        <hr>
        <a href="logout.php">Logout</a>
    </div>
    <div class="content">
    <div class="header-row">
      <h2>Users</h2>
      <a href="NewUser.html" class="add-button">+ Add User</a>
    </div>
    <div class="table-container">
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Created At</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                    <tr>
                        
                        <td><?php echo htmlspecialchars($user['name']); ?></td>
                        <td><?php echo htmlspecialchars($user['email']); ?></td>
                        <td><?php echo htmlspecialchars($user['role']); ?></td>
                        <td><?php echo htmlspecialchars($user['created_at']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
       
    </div>
  </div>
</body>
</html>