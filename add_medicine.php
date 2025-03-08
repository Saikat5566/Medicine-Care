<?php
include 'db_connect.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $price = $_POST['price'];

    $image = $_FILES['image']['name'];
    $image_tmp = $_FILES['image']['tmp_name'];
    $image_folder = "uploads/" . $image;

    if (move_uploaded_file($image_tmp, $image_folder)) {

        $stmt = $conn->prepare("INSERT INTO medicines (name, price, image) VALUES (?, ?, ?)");
        $stmt->bind_param("sds", $name, $price, $image_folder);

        if ($stmt->execute()) {
            echo "<p class='success'>Medicine added successfully!</p>";
        } else {
            echo "<p class='error'>Error: " . $conn->error . "</p>";
        }
        $stmt->close();
    } else {
        echo "<p class='error'>Error uploading image.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Medicine</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header class="animated-text">
        <h1>Only Data Administrator Can Use This Site To Insert Product</h1>
    </header>
    <a href="index.php">Home</a>
    <div class="container">
        <h2>Add New Medicine</h2>
        <form method="POST" enctype="multipart/form-data">
            <input type="text" name="name" placeholder="Medicine Name" required>
            <input type="number" step="0.01" name="price" placeholder="Price" required>
            <input type="file" name="image" required>           
            <input type="submit" value="Add Medicine">
        </form>
    </div>
</body>
</html>
