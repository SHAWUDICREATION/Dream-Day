<?php
include 'db.php';

$id = $_GET['id'];
$sql = "DELETE FROM events WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    header("Location: events.php");
} else {
    echo "Error deleting record: " . $conn->error;
}
?>
