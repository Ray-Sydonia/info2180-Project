<?php
include 'utils/function.php';
$conn = getConn();

// Get the form inputs
$stmt = $conn->prepare("SELECT id, CONCAT(firstname, ' ', lastname) AS fullName FROM users");
$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>


<div class="info">
    <h1>New Contact</h1>
    <div id="new-contact">
        <form action="contact_insert.php" method="post">
            <div class="title">
                <label for="title">Title</label>
                <select name="title" id="title">
                    <option value="Mr.">Mr.</option>
                    <option value="Mrs.">Mrs.</option>
                    <option value="Ms.">Ms.</option>
                    <option value="Dr.">Dr.</option>
                </select>
            </div>

            <div class="first_name">
                <label for="first_name">First Name</label>
                <input type="text" name="first_name" id="first_name" value="" placeholder="John" >
            </div>

            <div class="last_name">
                <label for="last_name">Last Name</label>
                <input type="text" name="last_name" id="last_name" value="" placeholder="Doe" >
            </div>

            <div class="email">
                <label for="email">Email</label>
                <input type="text" name="email" id="email" value="" placeholder="something@example.com" required>
            </div>

            <div class="telephone">
                <label for="telephone">Telephone</label>
                <input type="text" name="telephone" id="telephone" value="" >
            </div>

            <div class="company">
                <label for="company">Company</label>
                <input type="text" name="company" id="company" value="" >
            </div>

            <div class="type">
                <label for="type">Type</label>
                <select name="type" id="type">
                    <option value="Sales Lead">Sales Lead</option>
                    <option value="Support">Support</option>
                </select>
            </div>

            <div class="assigned_to">
                <label for="assigned_to">Assigned To</label>
                <select name="assigned_to" id="assigned_to">
                    <?php foreach ($users as $user): ?>
                        <option value="<?= $user['id'] ?>"><?= $user['fullName'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="save">
                <input type="submit" value="Send">
            </div>
        </form>
    </div>
</div>
