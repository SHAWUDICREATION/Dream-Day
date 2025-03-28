<?php
include 'db_connect.php';

session_start();
$vendor_id = $_SESSION['vendor_id'] ?? 1; // Default vendor_id for testing if session is not set

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$ad = null;

if ($id > 0) {
    $sql = "SELECT * FROM normalads WHERE id = ?";
    $stmt = $conn->prepare($sql);
if ($stmt) {
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $ad = $result->fetch_assoc();
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $website = $_POST['website'];
    $price = $_POST['price'];
    $category = $_POST['category'];
    $image = $_POST['image'];

    if ($id > 0) {
        // Update existing ad
        $sql = "UPDATE normalads SET name = ?, email = ?, phone = ?, website = ?, price = ?, category = ?, image = ? WHERE id = ? AND vendor_id = ?";
        $stmt = $conn->prepare($sql);
if ($stmt) {
        $stmt->bind_param("sssssssii", $name, $email, $phone, $website, $price, $category, $image, $id, $vendor_id);
            }
    } else {
        // Insert new ad
        $sql = "INSERT INTO normalads (vendor_id, name, email, phone, website, price, category, image) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
        if ($stmt) {
        $stmt->bind_param("isssssss", $vendor_id, $name, $email, $phone, $website, $price, $category, $image);
        }
    }

    if ($stmt->execute()) {
        header("Location: normalads.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $id > 0 ? "Edit Ad" : "Create Ad"; ?></title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }

        .form-container {
            max-width: 600px;
            margin: 50px auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .form-container h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #555;
        }

        input[type="text"],
        input[type="email"],
        input[type="url"],
        input[type="number"],
        select,
        input[type="file"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2><?php echo $id > 0 ? "Edit Ad" : "Create Ad"; ?></h2>
<form action="" method="post">
    <div class="mb-3">
                <label class="form-label">Name</label>
    <input type="text" name="name" class="form-control" value="<?php echo htmlspecialchars($ad['name'] ?? ''); ?>" required>
</div>
            <div class="mb-3">
    <label class="form-label">Email</label>
    <input type="email" name="email" class="form-control" value="<?php echo htmlspecialchars($ad['email'] ?? ''); ?>" required>
</div>
            <div class="mb-3">
    <label class="form-label">Phone</label>
    <input type="text" name="phone" class="form-control" value="<?php echo htmlspecialchars($ad['phone'] ?? ''); ?>" required>
</div>
            <div class="mb-3">
    <label class="form-label">Website</label>
    <input type="url" name="website" class="form-control" value="<?php echo htmlspecialchars($ad['website'] ?? ''); ?>">
</div>
            <div class="mb-3">
    <label class="form-label">Price</label>
    <input type="number" name="price" class="form-control" value="<?php echo htmlspecialchars($ad['price'] ?? ''); ?>" required>
</div>
            <div class="mb-3">
    <label class="form-label">Category</label>
    <select name="category" class="form-control" required>
<option value="">Select Category</option>
    <option value="ashtaka" <?php echo isset($ad['category']) && $ad['category'] == 'ashtaka' ? 'selected' : ''; ?>>Ashtaka</option>
    <option value="astrology" <?php echo isset($ad['category']) && $ad['category'] == 'astrology' ? 'selected' : ''; ?>>Astrology</option>
    <option value="carrenters" <?php echo isset($ad['category']) && $ad['category'] == 'carrenters' ? 'selected' : ''; ?>>Car Rentals</option>
    <option value="caterers" <?php echo isset($ad['category']) && $ad['category'] == 'caterers' ? 'selected' : ''; ?>>Caterers</option>
    <option value="cinematography" <?php echo isset($ad['category']) && $ad['category'] == 'cinematography' ? 'selected' : ''; ?>>Cinematography</option>
    <option value="photography" <?php echo isset($ad['category']) && $ad['category'] == 'photography' ? 'selected' : ''; ?>>Photography</option>
    <option value="weddingcakes" <?php echo isset($ad['category']) && $ad['category'] == 'weddingcakes' ? 'selected' : ''; ?>>Wedding Cakes</option>
    <option value="dancinggroups" <?php echo isset($ad['category']) && $ad['category'] == 'dancinggroups' ? 'selected' : ''; ?>>Dancing Groups</option>
    <option value="bands" <?php echo isset($ad['category']) && $ad['category'] == 'bands' ? 'selected' : ''; ?>>Bands/DJ</option>
    <option value="salon" <?php echo isset($ad['category']) && $ad['category'] == 'salon' ? 'selected' : ''; ?>>Hair Beauty Salons & Spa</option>
    <option value="flowers" <?php echo isset($ad['category']) && $ad['category'] == 'flowers' ? 'selected' : ''; ?>>Flowers</option>
    <option value="album" <?php echo isset($ad['category']) && $ad['category'] == 'album' ? 'selected' : ''; ?>>Wedding Album</option>
    </select>                
</div>
        <div class="mb-3">
                <label class="form-label">Image URL</label>
    <input type="text" name="image" class="form-control" value="<?php echo htmlspecialchars($ad['image'] ?? ''); ?>" required>
</div>
    <button type="submit" class="btn btn-primary"><?php echo $id > 0 ? "Update Ad" : "Create Ad"; ?></button>
</form>
    </div>
</body>
</html>