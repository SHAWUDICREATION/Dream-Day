<?php
include 'db_connect.php';

$sql = "SELECT * FROM premiumads ORDER BY name DESC"; // Updated table name
$result = $conn->query($sql);

if (!$result) {
    die("Error executing query: " . $conn->error);
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Premium Ads</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<style>
     body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            margin: 0;
            font-family: 'Roboto', sans-serif;
            background-color: #f8f9fa;
            color: #333;
        }

        .main-content {
            display: flex;
            flex: 1;
        }

        .content {
            padding: 30px;
            background: #fff;
            flex-grow: 1;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            margin: 20px;
        }

        /* Sidebar */
        .sidebar {
            width: 250px;
            min-width: 250px;
            background: #343a40;
            color: white;
            display: flex;
            flex-direction: column;
            padding: 20px;
            box-sizing: border-box;
        }

        .sidebar h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #f8f9fa;
        }

        .sidebar a {
            color: #f8f9fa;
            text-decoration: none;
            display: flex;
            align-items: center;
            margin: 10px 0;
            padding: 10px;
            border-radius: 5px;
            transition: background 0.3s ease;
        }

        .sidebar a i {
            margin-right: 10px;
        }

        .sidebar a:hover {
            background: #495057;
        }
    .container {
        flex: 1;
        padding: 20px;
        overflow-y: auto;
    }

    .packages-container {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 20px;
    }

    .package-box {
        background: white;
        border: 1px solid #ddd;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        display: flex;
        flex-direction: column;
        text-align: center;
        padding: 15px;
        transition: transform 0.3s;
    }

    .package-box:hover {
        transform: scale(1.02);
    }

    .package-box img {
        width: 100%;
        height: 200px;
        object-fit: cover;
        border-bottom: 1px solid #ddd;
    }

    .package-box h4 {
        margin: 15px 0;
        font-size: 18px;
        color: #333;
    }

    .btn-container {
        display: flex;
        justify-content: center;
        gap: 10px;
        margin-top: 10px;
    }

    .btn {
        padding: 10px 15px;
        text-decoration: none;
        color: white;
        border-radius: 5px;
        font-size: 14px;
    }

    .btn.edit {
        background: #28a745;
    }

    .btn.delete {
        background: #dc3545;
    }

    footer {
            text-align: center;
            padding: 15px;
            background-color: #343a40;
            color: white;
            margin-top: auto;
            
        }
        header {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            padding: 10px 20px;
            background-color: #343a40;
            color: white;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }

        header .user-info {
            display: flex;
            align-items: center;
        }

        header .user-info img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 10px;
        }

    @media (max-width: 768px) {
        .main-content {
            flex-direction: column;
        }

        .sidebar {
            width: 100%;
            text-align: center;
        }

        .packages-container {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 480px) {
        .package-box img {
            height: 150px;
        }

        .btn {
            font-size: 12px;
            padding: 8px 10px;
        }
    }
</style>
</head>
<body>
    <header>
        <div class="user-info">
            <img src="https://via.placeholder.com/40" alt="User Avatar">
        </div>
    </header>
    <div class="main-content">
        <div class="sidebar">
            <h2>Vendor</h2>
            <a href="dashboardads.html"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
            <a href="events.php"><i class="fas fa-calendar me-2"></i> My Events</a>
            <a href="premiumads.php"><i class="fas fa-user-cog"></i> My Ads</a>
            
    
        </div>
<!-- filepath: e:\XAMPP\htdocs\DREAM_DAY\premiumads.php -->
<div class="container">
    <h2>Advertisements</h2>
    <a href="premiumads_add.php" class="btn btn-primary mb-4">+ Add New Advertisement</a>
    <div class="packages-container">

        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div class='package-box'>";
                echo "<img src='" . htmlspecialchars($row['image_url']) . "' alt='Ad Image'>";
                echo "<h4>" . htmlspecialchars($row['name']) . "</h4>";
                echo "<p>" . htmlspecialchars($row['description']) . "</p>";
                echo "<div class='btn-container'>";
                echo "<a href='edit_premiumad.php?id=" . $row['id'] . "' class='btn edit'>Edit</a>";
                echo "<a href='delete_premiumad.php?id=" . $row['id'] . "' class='btn delete' onclick=\"return confirm('Are you sure you want to delete this ad?');\">Delete</a>";
                echo "</div>";
                echo "</div>";
            }
        } else {
            echo "<p>No advertisements found.</p>";
        }
        ?>

    </div>
</div>
<footer>
    &copy; 2024 Dream Wedding. All rights reserved.
</footer>
</body></html>