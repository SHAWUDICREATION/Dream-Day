<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $category = $_POST['category'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Insert into users table
    $sql_users = "INSERT INTO users (name, email, phone, address, password, category) VALUES ('$name', '$email', '$phone', '$address', '$password', '$category')";
    
    if ($conn->query($sql_users) === TRUE) {
        // Insert into relevant category table
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

        $sql_category = "INSERT INTO $table (name, email, phone, address, password) VALUES ('$name', '$email', '$phone', '$address', '$password')";
        
        if ($conn->query($sql_category) === TRUE) {
            header("Location: forms.html");
            exit();
        } else {
            echo "Error: " . $sql_category . "<br>" . $conn->error;
        }
    } else {
        echo "Error: " . $sql_users . "<br>" . $conn->error;
    }

    $conn->close();
}
?>