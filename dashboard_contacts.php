<?php
include 'utils/function.php';


$filter = filter_input(INPUT_GET, 'filter', FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?? 'all';

if (!$filter || $filter === 'all') {
    $stmt = $conn->prepare("SELECT id, CONCAT(title, ' ', firstname, ' ', lastname) AS fullName, email, company, type, assigned_to FROM Contacts");
    $stmt->execute();
} else if ($filter === 'assigned') {
    session_start();
    $user_id = $_SESSION['id'];
    $stmt = $conn->prepare("SELECT id, CONCAT(title, ' ', firstname, ' ', lastname) AS fullName, email, company, type, assigned_to FROM Contacts WHERE assigned_to = $user_id");
    $stmt->execute();
} else {
    $stmt = $conn->prepare("SELECT id, CONCAT(title, ' ', firstname, ' ', lastname) AS fullName, email, company, type, assigned_to FROM Contacts WHERE type LIKE :filter");
    $stmt->execute(['filter' => "%$filter%"]);
}
$contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<table>
    <thead>
    <tr>
        <th scope="col">Name</th>
        <th scope="col">Email</th>
        <th scope="col">Company</th>
        <th scope="col">Type</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($contacts as $contact): ?>
        <tr>
            <th scope="row"><?= $contact['fullName'] ?></th>
            <td><?= $contact['email'] ?></td>
            <td><?= $contact['company'] ?></td>
            <td><span class="<?= str_replace(' ', '_', $contact['type']) ?>"><?= $contact['type'] ?></span><a
                        id="<?= $contact['fullName'] ?>"
                        class="contactInfo"
                        href="view_contact_info.php">View</a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

