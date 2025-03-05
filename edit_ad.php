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
        echo "<script>alert('advertisement updated successfully'); window.location='ads.php';</script>";
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
    <title>edit ad</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh; 
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

        
        .sidebar {
            width: 250px;
            min-width: 250px;
            background: #343a40;
            color: white;
            display: flex;
            flex-direction: column;
            padding: 20px;
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

        
        footer {
            text-align: center;
            padding: 15px;
            background-color: #343a40;
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

       
        @media (max-width: 768px) {
            .main-content {
                flex-direction: column;
            }

            .sidebar {
                width: 100%;
                text-align: center;
            }
        }

        
       

      
    </style>
</head>
<body>
    <header>
        <div class="user-info">
            <img src="https://via.placeholder.com/40" alt="User Avatar">
            <span><b>John</b></span>
        </div>
    </header>

    <div class="main-content">
        <div class="sidebar">
            <h2>Vendor</h2>
            <a href="dashboardads.html"><i class="fas fa-tachometer-alt me-2"></i>Dashboard</a>
            <a href="events.php"><i class="fas fa-calendar me-2"></i> Events</a>
            <a href="ads.php"><i class="fas fa-user-cog"></i> My Ads</a>
            <a href="client.html"><i class="fas fa-users me-2"></i> Clients</a>
        </div>

        
        <div class="container">
            <h2 class="mb-4">Edit Advertisement</h2>
            <form method="POST" action="">
                <label for="title" class="form-label">Title</label>
                <input type="text" name="title" id="title" class="form-control" value="<?php echo htmlspecialchars($row['title']); ?>" required>

                <label for="description" class="form-label">Description</label>
                <textarea name="description" id="description" class="form-control" rows="5" required><?php echo htmlspecialchars($row['description']); ?></textarea>

                <button type="submit" class="btn btn-submit mt-3">Update</button>
            </form>
        </div>
    </div>
        </div>
    </div>

    <footer>
        &copy; 2024 Dream Wedding. All rights reserved
    </footer>
</body>
</html>
