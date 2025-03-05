<?php
include 'config.php';


$sql = "SELECT * FROM wedplans ORDER BY id DESC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    </style>
</head>
<body>

<div class="main-content">
    <div class="sidebar">
        <h2>Admin Panel</h2>
        <a href="packages.php"><i class="fas fa-user-cog"></i> Packages</a>
        <a href="client.php"><i class="fas fa-users"></i> Clients</a>
    </div>

    <div class="container">
        <h2>Clients</h2>
    
        <table class="styled-table">
            <thead>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Wedding Date</th>
                    <th>Plan</th>
                    
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['firstname'] . "</td>";
                        echo "<td>" . $row['lastname'] . "</td>";
                        echo "<td>" . $row['phonenum'] . "</td>";
                        echo "<td>" . $row['email'] . "</td>";
                        echo "<td>" . $row['weddingdate'] . "</td>";
                        echo "<td>" . $row['plan'] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='7'>No records found</td></tr>";
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
