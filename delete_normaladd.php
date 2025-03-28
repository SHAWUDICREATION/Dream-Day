<?php
include 'db_connect.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = "DELETE FROM normalads WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "<script>alert('Ad deleted successfully!'); window.location.href='normalads.php';</script>";
    } else {
        echo "<script>alert('Error deleting ad.'); window.location.href='normalads.php';</script>";
    }
} else {
    echo "<script>alert('Invalid request.'); window.location.href='normalads.php';</script>";
}
?>