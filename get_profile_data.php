<?php
include 'config.php';
session_start();

$user_id = $_SESSION['user_id'];

// Fetch user data from the users table
$sql = "SELECT * FROM users WHERE id='$user_id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    echo json_encode($user);
} else {
    echo json_encode(['error' => 'User not found']);
}

$conn->close();
?>