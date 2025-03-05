<?php
include 'db.php';

$id = $_GET['id'];
$sql = "DELETE FROM ads WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    header("Location: ads.php");
} else {
    echo "Error deleting record: " . $conn->error;
}
?>