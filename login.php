<?php
include 'db_connect.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT id, name, password FROM users WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['user_name'] = $row['name'];
            header("Location: index.php");
            exit();
        } else {
            echo "<p class='error'>Invalid password!</p>";
        }
    } else {
        echo "<p class='error'>No account found with this email!</p>";
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
<div class="logo-container">
      <img src="uploads/kisspng-adobe-illustrator-blue-palm-medical-coin-oh-love-money-5aa8a319b9d749.1404631915210012417612.png" alt="Website Logo" class="logo">
    </div>
        <h1 class="animated-text">You Have To Login Here</h1>
    </header>
    <div class="container">
        <form method="POST">
            <h2>Login</h2>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="submit" value="Login">
            <p>Don't have an account? <a href="register.php">Register here</a></p>
        </form>
    </div>
    <footer class="bar">
        <h3 class="contact">Contact 
        <h5>Phone: 01734556637</>
        <h5>E-mail: medicinecare@gmail.<i class="fa fa-comment" aria-hidden="true"></i></>

        <p class="copy">&copy; Medicine Care. All Rights Reserved.</p>
    </footer>
</body>
</html>
