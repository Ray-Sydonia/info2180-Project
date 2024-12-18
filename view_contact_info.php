<?php
include 'utils/function.php';
session_start();

$company = filter_input(INPUT_GET, 'company', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$contactName = filter_input(INPUT_GET, 'contactName', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$assigned_to = filter_input(INPUT_POST, 'assigned_to', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$type = filter_input(INPUT_POST, 'type', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

$comment = filter_input(INPUT_POST, 'comment', FILTER_SANITIZE_SPECIAL_CHARS);
$updated_at = date("Y-m-d H:i:s");
$created_at = date("Y-m-d H:i:s");
$userId = $_SESSION['id'];


$sql = $conn->prepare("SELECT contacts.id, CONCAT(Contacts.title, ' ', Contacts.firstname, ' ', Contacts.lastname) AS fullName, Contacts.email, Contacts.company, contacts.type, Contacts.telephone, Contacts.created_at, Contacts.updated_at, CONCAT(user2.firstname, ' ', user2.lastname) AS assigned_to, CONCAT(user1.firstname, ' ', user1.lastname) AS created_by 
FROM Contacts JOIN users user1 ON Contacts.created_by = user1.id JOIN users user2 ON Contacts.assigned_to = user2.id WHERE CONCAT(Contacts.title, ' ', Contacts.firstname, ' ', Contacts.lastname) LIKE :contactName");
$sql->execute(['contactName' => "%$contactName%"]);
$contact = $sql->fetch(PDO::FETCH_ASSOC);

$contactId = $contact['id'];
if ($comment) {
    $sql = $conn->exec("UPDATE Contacts SET updated_at = '$updated_at' WHERE CONCAT(title, ' ', firstname, ' ', lastname)  LIKE '%$contactName%'");
    $sql = $conn->exec("INSERT INTO notes (contact_id, comment, created_by, created_at) VALUES ('$contactId', '$comment', '$userId', '$created_at')");
} else if ($assigned_to) {
    $sql = $conn->exec("UPDATE Contacts SET assigned_to = '$assigned_to', updated_at = '$updated_at' WHERE CONCAT(title, ' ', firstname, ' ', lastname)  LIKE '%$contactName%'");
} else if ($type) {
    $sql = $conn->exec("UPDATE Contacts SET type = '$type', updated_at = '$updated_at' WHERE CONCAT(title, ' ', firstname, ' ', lastname)  LIKE '%$contactName%'");
} 
  

$stmt = $conn->prepare("SELECT CONCAT(users.firstname, ' ', users.lastname) AS fullName, notes.comment, notes.created_at FROM notes JOIN users ON notes.created_by = users.id WHERE notes.contact_id = :contactId");
$stmt->execute(['contactId' => $contactId]);
$notes = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="infoContainer">
    <div id="contactInfo">
        <div>
            <div>
                
                <div>
                    <h1 class="cInfo"><?= $contactName?></h1>
                    <p class="cInfo gray">Created
                        on <?= date('F j, Y', strtotime($created_at)) ?>
                        by <?= $userId?></p>
                    <p class="cInfo gray">Updated
                        on <?= date('F j, Y', strtotime($updated_at)) ?></p>
                </div>
            </div>
            <div class="contactsBtn">
                <?php if ($type == 'Sales Lead'): ?>
                    <button class="switch" value="Support" id="<?= $contactName ?>">Switch to Support
                    </button>
                <?php else: ?>
                    <button class="switch" value="Sales Lead" id="<?= $contactName ?>">Switch to Sales Lead
                    </button>
                <?php endif; ?>
                <button class="assigned_to_me" value="<?= $contactName ?>" id="<?= $userId ?>">Assign to me
                </button>
            </div>
        </div>

        <div>
            <div>
                <h4 class="cInfo gray">Email</h4>
                <p class="cInfo"><?= $contact['email'] ?></p>
            </div>
            <div>
                <h4 class="cInfo gray">Telephone</h4>
                <p class="cInfo"><?= $contact['telephone'] ?></p>
            </div>
            <div>
                <h4 class="cInfo gray">Company</h4>
                <p class="cInfo"><?= $company ?></p>
              
            </div>
            <div>
                <h4 class="cInfo gray">Assigned To</h4>
                <p class="cInfo"><?= $assigned_to ?></p>
         
            </div>
        </div>

        <div>
        <div>
        <div class="notesHead">
            <
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



