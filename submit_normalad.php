<?php
include 'db_connect.php'; // Ensure this file connects to the `wedding_management` database

// Simulate a logged-in vendor (replace this with actual session-based logic)
session_start();
if (!isset($_SESSION['vendor_id'])) {
    die("Error: Vendor not logged in.");
}
$vendor_id = $_SESSION['vendor_id']; // Use the logged-in vendor's ID

if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $website = $_POST['website'];
    $price = $_POST['price'];
    $category = $_POST['category'];
    $package = $_POST['package'];
    $image_url = $_POST['image_url']; // Get the image URL from the form

    // Insert into the `normalads` table
    $sql = "INSERT INTO normalads (vendor_id, name, email, phone, website, price, category, package, image) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("issssssss", $vendor_id, $name, $email, $phone, $website, $price, $category, $package, $image_url);
    if ($stmt->execute()) {
        echo "<div class='success-message'>Ad successfully created!</div>";
    } else {
        echo "Error: " . $stmt->error;
        }
    } else {
        echo "Error preparing statement: " . $conn->error;
    }
}
?>
<style>
    .success-message {
        background-color: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
        padding: 15px;
        border-radius: 5px;
        font-size: 16px;
        text-align: center;
        margin: 20px auto;
        width: 50%;
    }
</style>