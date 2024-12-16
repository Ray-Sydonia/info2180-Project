<?php
session_start();
require 'database_connection.php'; // Include DB connection

if (isset($_GET['contact_id'])) {
    $contact_id = intval($_GET['contact_id']);
    
    // Fetch contact details
    $stmt = $pdo->prepare("SELECT contacts.*, users.firstname AS assigned_firstname, users.lastname AS assigned_lastname FROM contacts LEFT JOIN users ON contacts.assigned_to = users.id WHERE contacts.id = ?");
    $stmt->execute([$contact_id]);
    $contact = $stmt->fetch();
    
    // Fetch notes
    $stmt = $pdo->prepare("SELECT notes.comment, notes.created_at, users.firstname, users.lastname FROM notes LEFT JOIN users ON notes.created_by = users.id WHERE notes.contact_id = ?");
    $stmt->execute([$contact_id]);
    $notes = $stmt->fetchAll();
    
    echo json_encode(['contact' => $contact, 'notes' => $notes]);
}
?>