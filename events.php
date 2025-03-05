<?php
include 'db.php';


$sql = "SELECT * FROM events ORDER BY date_created DESC";
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
        }

        .container {
            flex: 1;
            padding: 20px;
            overflow-y: auto;
            background: white;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            margin: 20px;
        }

        h2 {
            margin-bottom: 20px;
            color: #333;
        }

        .styled-table {
            border-collapse: collapse;
            margin: 25px 0;
            font-size: 0.9em;
            width: 100%;
            border: 1px solid #ddd;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .styled-table th,
        .styled-table td {
            padding: 12px 15px;
            text-align: left;
        }

        .styled-table th {
            background-color: #ff80ab;
            color: white;
        }

        .styled-table tr {
            border-bottom: 1px solid #ddd;
        }

        .styled-table tr:nth-of-type(even) {
            background: #f9f9f9;
        }

        .styled-table tr:hover {
            background: #f1f1f1;
        }

        .btn.edit {
            background: #28a745;
            color: #fff;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 0.8rem;
        }
        .btn.delete {
            background: #dc3545;
            color: #fff;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 0.8rem;
        }

        

        .btn.add-event {
            background: #007bff;
            color: white;
            display: inline-block;
            margin-bottom: 20px;
            padding: 10px 15px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 0.9rem;
            transition: background 0.3s;
        }

        .btn.add-event:hover {
            background: #0056b3;
        }

        

        @media (max-width: 768px) {
            .main-content {
                flex-direction: column;
            }

            .sidebar {
                width: 100%;
                text-align: center;
            }

            .styled-table {
                font-size: 0.8em;
                overflow-x: auto;
            }
        }
    </style>
</head>
<body>
    <header>
        <div class="user-info">
            <img src="https://via.placeholder.com/40" alt="User Avatar">
            <span><b>John </b></span>
        </div>
    </header>
    <div class="main-content">
        <div class="sidebar">
            <h2>Vendor</h2>
            <a href="dashboardads.html"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
            <a href="events.php"><i class="fas fa-calendar me-2"></i> My Events</a>
            <a href="ads.php"><i class="fas fa-user-cog"></i> My Ads</a>
            
            
        </div>

        <div class="container">
            <h2>Events and Weddings</h2>
            <a href="add_event.php" class="btn add-event"> + Add New Event </a>
            <table class="styled-table">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Location</th>
                        <th>Status</th>
                        <th>Wedding Date</th>
                        <th>Date Created</th>
                        <th>Date Published</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['title'] . "</td>";
                    echo "<td>" . $row['description'] . "</td>";
                    echo "<td>" . $row['location'] . "</td>";
                    echo "<td>" . $row['status'] . "</td>";
                    echo "<td>" . $row['wedding_date'] . "</td>";
                    echo "<td>" . $row['date_created'] . "</td>";
                    echo "<td>" . $row['date_published'] . "</td>";
                    echo "<td>
                        <a href='edit_event.php?id=" . $row['id'] . "' class='btn edit'>Edit</a>
                        <a href='delete_event.php?id=" . $row['id'] . "' class='btn delete'>Delete</a>
                    </td>";
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
