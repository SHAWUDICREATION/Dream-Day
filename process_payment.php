<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];

    
    $check_sql = "SELECT * FROM wedplans WHERE email = ?";
    $stmt = $conn->prepare($check_sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        
        $update_sql = "UPDATE wedplans SET payment_status = 'Successful' WHERE email = ?";
        $update_stmt = $conn->prepare($update_sql);
        $update_stmt->bind_param("s", $email);

        if ($update_stmt->execute()) {
            echo "success";
        } else {
            echo "Error updating payment: " . $conn->error;
        }

        $update_stmt->close();
    } else {
        echo "Email not found in records.";
    }

    $stmt->close();
    $conn->close();
}
?>
