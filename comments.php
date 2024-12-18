<?php
include 'utils/function.php';
session_start();

// Fetch the contact name from the GET parameter
$contactName = filter_input(INPUT_GET, 'contactName', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

// Fetch the comment from the POST parameter
$comment = filter_input(INPUT_POST, 'comment', FILTER_SANITIZE_SPECIAL_CHARS);

// Initialize timestamps and user ID
$created_at = date("Y-m-d H:i:s");
$userId = $_SESSION['id'];

// Fetch the contact's ID based on the contact name
$sql = $conn->prepare("SELECT id FROM Contacts WHERE CONCAT(title, ' ', firstname, ' ', lastname) LIKE :contactName");
$sql->execute(['contactName' => "%$contactName%"]);
$contact = $sql->fetch(PDO::FETCH_ASSOC);
$contactId = $contact['id'];

// Add a new note if a comment is provided
if ($comment) {
    $sql = $conn->exec("INSERT INTO notes (contact_id, comment, created_by, created_at) 
                        VALUES ('$contactId', '$comment', '$userId', '$created_at')");
}

// Retrieve existing notes for the contact
$stmt = $conn->prepare("SELECT CONCAT(users.firstname, ' ', users.lastname) AS fullName, notes.comment, notes.created_at 
                        FROM notes 
                        JOIN users ON notes.created_by = users.id 
                        WHERE notes.contact_id = :contactId");
$stmt->execute(['contactId' => $contactId]);
$notes = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="infoContainer">
    <div>
        <div class="notesHead">
            <img src="img/edit_note_black_24dp.svg" alt="">
            <p>Notes</p>
        </div>
        <hr>
        <div id="notes">
            <?php foreach ($notes as $note): ?>
                <p class="noteHead"><strong><?= $note['fullName'] ?></strong></p>
                <p class="gray"><?= $note['comment'] ?></p>
                <p class="gray"><?= date('F j, Y \a\t h:i a', strtotime($note['created_at'])) ?></p>
            <?php endforeach; ?>
        </div>
        <div>
            <form action="view_contact_info.php" method="post">
                <label for="comment"><strong>Add a note about <?= $contactName ?></strong></label>
                <textarea name="comment" id="comment" cols="40" rows="5" placeholder="Enter details here" required></textarea>
                <button id="addNote" type="submit" value="<?= $contactName ?>">Add Note</button>
            </form>
        </div>
    </div>
</div>
