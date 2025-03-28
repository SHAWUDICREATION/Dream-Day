<?php
include 'config.php';

$sql = "SELECT * FROM messages ORDER BY created_at DESC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="shortcut icon" type="x-icon" href="Images/logo.webp">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            margin: 0;
        }
        .main-content {
            display: flex;
            flex: 1;
        }
        .sidebar {
            width: 250px;
            background: #ff80ab;
            color: white;
            padding: 20px;
        }
        .sidebar h2 {
            text-align: center;
        }
        .sidebar a {
            color: white;
            text-decoration: none;
            display: block;
            padding: 10px;
        }
        .container {
            flex: 1;
            padding: 20px;
        }
        .styled-table {
            width: 100%;
            border-collapse: collapse;
        }
        .styled-table th, .styled-table td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: center;
        }
        .styled-table tr:nth-of-type(even) {
            background: #f3f3f3;
        }
        .delete-btn {
            background-color: red;
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
            border-radius: 5px;
        }
        .delete-btn:hover {
            background-color: darkred;
        }
        footer {
            text-align: center;
            padding: 10px;
            background-color: #fcb69f;
            color: white;
            margin-top: auto;
        }
    </style>
    <script>
        function confirmDelete(id) {
            if (confirm("Are you sure you want to delete this message?")) {
                window.location.href = "delete_message.php?id=" + id;
            }
        }
    </script>
</head>
<body>

<div class="main-content">
    <div class="sidebar">
        <h2>Admin Panel</h2>
        
        <a href="client.php"><i class="fas fa-users"></i> Clients</a>
        <a href="vendors.php"><i class="fas fa-users"></i> Vendors</a>
        <a href="client_messages.php"><i class="fas fa-envelope"></i> Client Messages</a>
        <a href="vendor_ads.php"><i class="fas fa-ad"></i> Vendor Ads</a>
    </div>

    <div class="container">
    <h2>Client Messages</h2>
    <table class="styled-table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Message</th>
            <th>Date</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>

        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['name']}</td>
                        <td>{$row['email']}</td>
                        <td>{$row['message']}</td>
                        <td>{$row['created_at']}</td>
                        <td><button class='delete-btn' onclick='confirmDelete(" . $row['id'] . ")'>Delete</button></td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No messages found</td></tr>";
        }
        $conn->close();
        ?>
        </tbody>

    </table>
    </div>
</div>

<footer>
    &copy; 2024 Dream Wedding. All rights reserved.
</footer>

</body>
</html>






