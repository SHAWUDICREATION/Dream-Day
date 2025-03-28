<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $package = trim($_POST['package']);
    $payment_date = trim($_POST['payment_date']);

  
    if ($package === "Normal") {
        $expiration_date = date('Y-m-d', strtotime($payment_date . ' +1 month'));
    } elseif ($package === "Premium") {
        $expiration_date = date('Y-m-d', strtotime($payment_date . ' +3 months'));
    } else {
        echo "Invalid package type.";
        exit();
    }

 
    $check_sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($check_sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        
        $update_sql = "UPDATE users SET payment_status = 'Successful', package_name = ?, payment_date = ?, expiration_date = ? WHERE email = ?";
        $update_stmt = $conn->prepare($update_sql);
        $update_stmt->bind_param("ssss", $package, $payment_date, $expiration_date, $email);

        if ($update_stmt->execute()) {
            echo "success";
        } else {
            echo "Error updating payment: " . $update_stmt->error;
        }

        $update_stmt->close();
    } else {
        echo "Email not found in records.";
    }

    $stmt->close();
    $conn->close();
}
?>
