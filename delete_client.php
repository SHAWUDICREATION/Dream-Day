<?php
include 'db.php';

$id = $_GET['id'];
$sql = "DELETE FROM clients WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    header("Location: client.php");
} else {
    echo "Error deleting record: " . $conn->error;
}
?>
