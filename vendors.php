<?php
include 'config.php';

// Update expired users before fetching data
$update_sql = "UPDATE users SET 
                payment_status = 'Expired' 
               WHERE expiration_date IS NOT NULL 
               AND expiration_date < CURDATE()";
$conn->query($update_sql);

$sql = "SELECT * FROM users ORDER BY id DESC";
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
        footer {
            text-align: center;
            padding: 10px;
            background-color: #fcb69f;
            color: white;
            margin-top: auto;
        }
        .btn-small {
            padding: 5px 10px;
            font-size: 14px;
        }
    </style>
        
        
            
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
    <h2>Vendors</h2>
    <table class="styled-table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Category</th>
                <th>Payment</th>
                <th>Package</th>
                <th>Expiry Date</th>
                
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result && $result->num_rows > 0) {  // ✅ Ensures $result is valid
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>{$row['name']}</td>";
                    echo "<td>{$row['email']}</td>";
                    echo "<td>{$row['phone']}</td>";
                    echo "<td>{$row['category']}</td>";
                    echo "<td>" . ($row['payment_status'] ?: 'Not Paid') . "</td>";
                    echo "<td>" . ($row['package_name'] ?: 'N/A') . "</td>";
                    echo "<td>" . ($row['expiration_date'] ?: 'N/A') . "</td>";
                    
                
                    

                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='8'>No records found</td></tr>";
            }
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