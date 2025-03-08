<?php
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $phone = $_POST['phone_number'];
    $location = $_POST['location'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $check_sql = "SELECT id FROM users WHERE email = '$email'";
    $check_result = $conn->query($check_sql);
    
    if ($check_result->num_rows > 0) {
        echo "<p class='error'>Email already registered!</p>";
    } else {
        
        $sql = "INSERT INTO users (name, phone_number, location, email, password) VALUES ('$name', '$phone', '$location', '$email', '$password')";
        if ($conn->query($sql) === TRUE) {
            header("Location: login.php"); 
            exit();
        } else {
            echo "<p class='error'>Error: " . $conn->error . "</p>";
        }
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
<div class="logo-container">
      <img src="uploads/kisspng-adobe-illustrator-blue-palm-medical-coin-oh-love-money-5aa8a319b9d749.1404631915210012417612.png" alt="Website Logo" class="logo">
    </div>
        <h1 class="animated-text">Please Register Your Account</h1>
    </header>
    <div class="containerR">
        <form method="POST">
            <h2>Register</h2>
            <input type="text" name="name" placeholder="Full Name" required>
            <input type="number" name="phone_number" placeholder="number" required>
            <input type="text" name="location" placeholder="location" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="submit" value="Register">
            <p>Already have an account? <a href="login.php">Login here</a></p>
        </form>
    </div>
    <footer class="bar">
    
        <h3 class="contact">Contact  
        <h5>Phone: 01734556637</>
        <h5>E-mail: medicinecare@gmail.<i class="fa fa-comment" aria-hidden="true"></i></>
        </h3>

        <p class="copy">&copy; Medicine Care. All Rights Reserved.</p>
    </footer>
</body>
</html>
