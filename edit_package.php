<?php
include 'db.php';

$id = $_GET['id'];
$sql = "SELECT * FROM ads WHERE id = $id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
} else {
    die("Package not found.");
}

// Update Package Logic
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];

    $update_sql = "UPDATE ads SET title='$title', description='$description' WHERE id=$id";
    if ($conn->query($update_sql)) {
        echo "<script>alert('Package updated successfully'); window.location='packages.php';</script>";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Package</title>
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
            display: flex;
            flex-direction: column;
            padding: 20px;
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
        }
        footer {
            text-align: center;
            padding: 17px;
            background-color: #fcb69f;
            color: white;
            margin-top: auto;
        }
        .form-control {
            margin-bottom: 15px;
        }
        .btn-submit {
            background-color: #28a745;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
        }
        .btn-submit:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <div class="main-content">
        <!-- Sidebar -->
        <div class="sidebar">
            <h2>Admin Panel</h2>
            <a href="dashboard.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
            <a href="events.php"><i class="fas fa-blog"></i> Events</a>
            <a href="packages.php"><i class="fas fa-user-cog"></i> Packages</a>
            <a href="#"><i class="fas fa-users"></i> Clients</a>
            <a href="#"><i class="fas fa-concierge-bell"></i> Services</a>
            <a href="#"><i class="fas fa-calendar"></i> Task Calendar</a>
        </div>

        <!-- Main Container -->
        <div class="container">
            <h2 class="mb-4">Edit Package</h2>
            <form method="POST" action="">
                <label for="title" class="form-label">Title</label>
                <input type="text" name="title" id="title" class="form-control" value="<?php echo htmlspecialchars($row['title']); ?>" required>

                <label for="description" class="form-label">Description</label>
                <textarea name="description" id="description" class="form-control" rows="5" required><?php echo htmlspecialchars($row['description']); ?></textarea>

                <button type="submit" class="btn btn-submit mt-3">Update Package</button>
            </form>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        &copy; 2024 Dream Wedding. All rights reserved
    </footer>
</body>
</html>
