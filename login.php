<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Fetch user details from the database
    $sql = "SELECT * FROM users WHERE email=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Verify password
        if (password_verify($password, $row['password'])) {
            session_start();
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['expiration_date'] = $row['expiration_date']; // Store expiration date in session
            $_SESSION['package_name'] = $row['package_name']; // Store package name in session

            // Check if the user has paid
            if (!empty($row['payment_date']) && strtotime($row['expiration_date']) > time()) {
                // Redirect based on the package type
                if ($row['package_name'] === 'Premium') {
                    header("Location: dashboardadspremium.php"); // Redirect to premium dashboard
                } else {
                    header("Location: dashboardadsnormal.php"); // Redirect to normal dashboard
                }
            } else {
                // User has not paid or their package has expired
                header("Location: dashboard.html");
            }
            
            exit();
        } else {
            echo "Invalid password";
        }
    } else {
        echo "No user found with this email";
    }

    $stmt->close();
    $conn->close();
}
?>
