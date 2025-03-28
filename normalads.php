<?php
session_start();
include 'db_connect.php';

$sql = "SELECT * FROM normalads ORDER BY name DESC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Normal Ads</title>
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
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2>Normal Advertisements</h2>
        <a href="create-normalad.php" class="btn btn-primary mb-4">+ Add New Advertisement</a>
        <div class="packages-container">
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='package-box'>";
                    echo "<img src='" . htmlspecialchars($row['image']) . "' alt='Ad Image'>";
                    echo "<h4>" . htmlspecialchars($row['name']) . "</h4>";
                    echo "<p><strong>Category:</strong> " . htmlspecialchars($row['category']) . "</p>";
                    echo "<p><strong>Price:</strong> Rs. " . htmlspecialchars($row['price']) . "</p>";
                    echo "<div class='btn-container'>";
                    echo "<a href='create-normalad.php?id=" . $row['id'] . "' class='btn edit'>Edit</a>";
                    echo "<a href='delete_normaladd.php?id=" . $row['id'] . "' class='btn delete' onclick=\"return confirm('Are you sure you want to delete this ad?');\">Delete</a>";
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
</body>
</html>
