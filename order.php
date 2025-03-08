<?php
include 'db_connect.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$medicine_id = $_GET['id'];
$user_id = $_SESSION['user_id'];  
$sql = "SELECT * FROM medicines WHERE id=$medicine_id";
$result = $conn->query($sql);
$medicine = $result->fetch_assoc();

if (!$medicine) {
   
    echo "<p class='error'>Medicine not found!</p>";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $quantity = $_POST['quantity'];
    $total_price = $medicine['price'] * $quantity; 

    $order_sql = "INSERT INTO orders (user_id, medicine_id, quantity, price) 
                  VALUES ($user_id, $medicine_id, $quantity, $total_price)";
    
    if ($conn->query($order_sql) === TRUE) {
        echo "<p class='success'>Order placed successfully!</p>";
    } else {
        echo "<p class='error'>Error: " . $conn->error . "</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Medicine</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
<div class="logo-container">
      <img src="uploads/kisspng-adobe-illustrator-blue-palm-medical-coin-oh-love-money-5aa8a319b9d749.1404631915210012417612.png" alt="Website Logo" class="logo">
    </div>
        <h1 class="animated-text">Welcome to Medicine Care</h1>
    </header>
<nav>
            <a class="nav-btn" href="Home.php">Home</a>
        </nav>
    <div class="order-container">
        <h2>Order: <?php echo htmlspecialchars($medicine['name']); ?></h2>
        <form method="POST">
          <input type="number" name="quantity" placeholder="Quantity" required>
          

            <input type="submit" value="Place Order">
        </form>
        
    </div>
    <footer class="bar">
    
            <a href="logout.php">Logout</a>
    

        <h3 class="contact">Contact  --</h3>
        <h5>Phone: 01734556637</h5>
        <h5>E-mail: medicinecare@gmail.com <i class="fa fa-comment" aria-hidden="true"></i></h5>

        <p class="copy">&copy; Medicine Care. All Rights Reserved.</p>
    </footer>
</body>
</html>
