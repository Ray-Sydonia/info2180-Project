<?php
include 'utils/function.php';
$conn = getConn();

$created_at = date('Y-m-d h:i');
$password = 'Password123';
$hashed_password = password_hash("$password", PASSWORD_DEFAULT);
$sql = $conn->exec("INSERT INTO users (firstname, lastname, password, email, role, created_at) VALUES('Admin', 'User', '$hashed_password', 'admin@project2.com', 'Admin', '$created_at')");

// List of fictional first and last names for users
$userFirstNames = ["Jan", "David", "Andy", "Darryl", "Erin"];
$userLastNames = ["Levinson", "Wallace", "Bernard", "Philbin", "Hannon"];

// List of fictional first and last names for contacts
$contactFirstNames = ["John", "Emma", "Michael", "Olivia", "William"];
$contactLastNames = ["Anderson", "Taylor", "Davis", "Miller", "Moore"];

// Function to generate a random password meeting the specified regex conditions
/**
 * @throws Exception
 */
function generateRandomPassword(): string
{
    $length = 10;
    $characters = '#abcdefghilkmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';

    // Define the regex pattern
    $pattern = '/^(?=.*[a-zA-Z])(?=.*\d)(?=.*[A-Z]).{8,}$/';

    do {
        $password = '';
        while (strlen($password) < $length) {
            $password .= $characters[random_int(0, strlen($characters) - 1)];
        }
    } while (!preg_match($pattern, $password));

    return $password;
}


// Function to generate a random value from an array
function getRandomValue($array) {
    return $array[array_rand($array)];
}

// Function to generate a personal email based on first and last names
function generatePersonalEmail($firstName, $lastName): string
{
    $domain = "personal.com";
    return strtolower($firstName) . '.' . strtolower($lastName) . '@' . $domain;
}

// Function to fill out the database queries for users
/**
 * @throws Exception
 */
function fillUserQueries($firstNames, $lastNames): array
{
    $queries = [];

    foreach (array_combine($firstNames, $lastNames) as $firstName => $lastName) {
        $password = password_hash(generateRandomPassword(), PASSWORD_DEFAULT);
        $email = generatePersonalEmail($firstName, $lastName);
        $role = ($firstName == "Alice" && $lastName == "Smith") ? "Admin" : "Member"; // Only one admin
        $createdAt = date('Y-m-d h:i'); // Current timestamp

        // Insert into users table query
        $userQuery = "INSERT INTO users (firstname, lastname, email, password, role, created_at) VALUES ('$firstName', '$lastName', '$email', '$password', '$role', '$createdAt')";
        $queries[] = $userQuery;
    }

    return $queries;
}

// Function to fill out the database queries for contacts
function fillContactQueries($contactFirstNames, $contactLastNames): array
{
    $conn = getConn();
    $queries = [];

    // Define arrays of possible values for title, type, created_by, and assigned_to
    $titles = ["Mr.", "Ms."];
    $types = ["Sales Lead", "Support"];

    // Query all user IDs
    $userIdsQuery = "SELECT id FROM users";
    $userIdsResult = $conn->query($userIdsQuery);
    $userIds = $userIdsResult->fetchAll(PDO::FETCH_COLUMN);

    foreach (array_combine($contactFirstNames, $contactLastNames) as $contactFirstName => $contactLastName) {
        // Assuming certain values for other fields in the contact table
        $title = getRandomValue($titles);
        $telephone = "123-456-7890";
        $company = "ABC Corp";
        $type = getRandomValue($types);
        $createdBy = getRandomValue($userIds);
        $assignedTo = getRandomValue($userIds);
        $createdAt = date("F j, Y"); // Current timestamp
        $updatedAt = $createdAt; // Using the same timestamp for created_at and updated_at

        // Generate a personal email for contacts
        $personalEmail = generatePersonalEmail($contactFirstName, $contactLastName);

        // Insert into contacts table query
        $contactQuery = "INSERT INTO contacts (title, firstname, lastname, email, telephone, company, type, assigned_to, created_by, created_at, updated_at) VALUES ('$title', '$contactFirstName', '$contactLastName', '$personalEmail', '$telephone', '$company', '$type', '$assignedTo', '$createdBy', '$createdAt', '$updatedAt')";
        $queries[] = $contactQuery;
    }

    return $queries;
}

// Example usage for users
try {
    $userQueries = fillUserQueries($userFirstNames, $userLastNames);
} catch (Exception $e) {
    echo $e->getMessage();
    die();
}

// Output the generated user queries
foreach ($userQueries as $query) {
    $conn->exec($query);
}

// Example usage for contacts
$contactQueries = fillContactQueries($contactFirstNames, $contactLastNames);

// Output the generated contact queries
foreach ($contactQueries as $query) {
    $conn->exec($query);
}
