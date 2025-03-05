<?php
include 'db.php';

$sql = "SELECT * FROM ads ORDER BY title DESC ";
$result = $conn->query($sql);
?>
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
        min-width: 250px;
        background: #ff80ab;
        color: white;
        display: flex;
        flex-direction: column;
        padding: 20px;
        box-sizing: border-box;
    }

    .sidebar h2 {
        text-align: center;
        margin-bottom: 20px;
        white-space: nowrap;
    }

    .sidebar a {
        color: white;
        text-decoration: none;
        margin: 10px 0;
        display: flex;
        align-items: center;
    }

    .sidebar a i {
        margin-right: 10px;
    }

    .sidebar a:hover {
        background: rgba(255, 255, 255, 0.2);
        padding: 10px;
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
        padding: 17px;
        background-color: #fcb69f;
        color: white;
        margin-top: auto;
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

<body>
    <div class="main-content">
        <div class="sidebar">
            <h2>Admin Panel</h2>
            
            
            <a href="packages.php"><i class="fas fa-user-cog"></i> Packages</a>
            <a href="client.php"><i class="fas fa-users"></i> Clients</a>
            <a href="#"><i class="fas fa-concierge-bell"></i> Services</a>
            <a href="#"><i class="fas fa-calendar"></i> Task Calendar</a>
        </div>

        <div class="container">
            <h2>Packages</h2>
            <a href="add_package.php" class="btn btn-primary mb-4">+ Add New Package</a>
            <div class="packages-container">
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<div class='package-box'>";
                        echo "<img src='bride.jpeg' alt='Package Image'>";
                        echo "<h4>" . htmlspecialchars($row['title']) . "</h4>";
                        echo "<p>" . htmlspecialchars($row['description']) . "<p>";
                        echo "<div class='btn-container'>";
                        echo "<a href='edit_package.php?id=" . $row['id'] . "' class='btn edit'>Edit</a>";
                        echo "<a href='delete_package.php?id=" . $row['id'] . "' class='btn delete'>Delete</a>";
                        echo "</div>";
                        echo "</div>";
                    }
                } else {
                    echo "<p>No packages found.</p>";
                }
                ?>
            </div>
        </div>
    </div>

    <footer>
        &copy; 2024 Dream Wedding. All rights reserved
    </footer>
</body>
