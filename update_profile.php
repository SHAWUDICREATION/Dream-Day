<?php
include 'config.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $profile_photo = $_POST['profile_photo'];
    $website = $_POST['website'];

    // Update users table
    $sql_users = "UPDATE users SET name='$name', email='$email', phone='$phone', address='$address', profile_photo='$profile_photo', website='$website' WHERE id='$user_id'";

    if ($conn->query($sql_users) === TRUE) {
        // Fetch user category
        $sql = "SELECT category FROM users WHERE id='$user_id'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            $category = $user['category'];

            // Update relevant category table
            switch ($category) {
                case 'Ashtaka':
                    $table = 'ashtaka';
                    break;
                case 'Astrology':
                    $table = 'astrology';
                    break;
                case 'Car Renters':
                    $table = 'carrenters';
                    break;
                case 'Caterers':
                    $table = 'caterers';
                    break;
                case 'Cinematography':
                    $table = 'cinematography';
                    break;
                case 'Photography':
                    $table = 'photography';
                    break;
                case 'Wedding Cakes':
                    $table = 'weddingcakes';
                    break;
                case 'Dancing Groups':
                    $table = 'dancinggroups';
                    break;
                case 'Bands / DJ':
                    $table = 'bands';
                    break;
                case 'Hair Beauty Salons & Spa':
                    $table = 'salon';
                    break;
                case 'Flowers':
                    $table = 'flowers';
                    break;
                case 'Wedding Story Album':
                    $table = 'album';
                    break;
                default:
                    $table = 'users';
                    break;
            }

            $sql_category = "UPDATE $table SET name='$name', email='$email', phone='$phone', address='$address', profile_photo='$profile_photo', website='$website' WHERE email='$email'";

            if ($conn->query($sql_category) === TRUE) {
                header("Location: dashboard.html");
                exit();
            } else {
                echo "Error: " . $sql_category . "<br>" . $conn->error;
            }
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Error: " . $sql_users . "<br>" . $conn->error;
    }

    $conn->close();
}
?>