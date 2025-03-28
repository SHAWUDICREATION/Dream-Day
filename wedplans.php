<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $phonenum = $_POST['phonenum'];
    $email = $_POST['email'];
    $weddingdate = $_POST['weddingdate'];
    $plan = $_POST['plan'];

    $sql = "INSERT INTO wedplans (firstname, lastname, phonenum, email, weddingdate, plan) VALUES ('$firstname', '$lastname', '$phonenum', '$email', '$weddingdate', '$plan')";

    if ($conn->query($sql) === TRUE) {
       
        header("Location: pay.html");
        exit(); 
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
