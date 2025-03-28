<?php
include 'db_connect.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = "DELETE FROM premiumads WHERE id = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
            header("Location: premiumads.php"); // Redirect to the correct page after deletion
            exit();
        } else {
            echo "<script>alert('Error deleting ad: " . $stmt->error . "');</script>";
        }
    } else {
        echo "<script>alert('Error preparing statement: " . $conn->error . "');</script>";
    }
} else {
    echo "<script>alert('Invalid request. No ID provided.');</script>";
}
?>
