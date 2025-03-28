<?php
include 'config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $delete_sql = "DELETE FROM users WHERE id = ?";
    $stmt = $conn->prepare($delete_sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "<script>alert('Vendor deleted successfully!'); window.location.href='vendors.php';</script>";
    } else {
        echo "<script>alert('Error deleting vendor!'); window.location.href='vendors.php';</script>";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "<script>alert('Invalid request!'); window.location.href='vendors.php';</script>";
}
?>
