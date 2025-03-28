<?php
include 'db.php';

$sql = "SELECT name, description, image_url FROM premiumads";
$result = $conn->query($sql);

$ads = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $ads[] = $row;
    }
}

echo json_encode($ads);
?>
