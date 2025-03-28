<?php
include 'config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $delete_sql = "DELETE FROM messages WHERE id = ?";
    $stmt = $conn->prepare($delete_sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "<script>alert('Message deleted successfully!'); window.location.href='client_messages.php';</script>";
    } else {
        echo "<script>alert('Error deleting message!'); window.location.href='client_messages.php';</script>";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "<script>alert('Invalid request!'); window.location.href='client_messages.php';</script>";
}
?>
