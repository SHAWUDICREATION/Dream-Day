<?php
$servername = "localhost"; // Use "127.0.0.1" or "localhost"
$username = "root";        // Default username for XAMPP
$password = "";            // Default password for XAMPP is empty
$dbname = "wedding_management"; // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>