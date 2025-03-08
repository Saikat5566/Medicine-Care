<?php
include 'db_connect.php'; 
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medicine Care</title>
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
        <a  class="nav-btn" href="home.php">Home</a>
    </nav>
    <h1 class="hey">Available Medicines</h1>
    <section class="product">
        <?php
        $result = $conn->query("SELECT * FROM `medicines` ORDER BY name ASC");  

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div class='product-card'>";
                echo "<h3>" . htmlspecialchars($row['name']) . "</h3>";
                echo "<p><strong>Price:</strong> " . htmlspecialchars($row['price']) . " BDT</p>";

                if (file_exists($row['image'])) {
                    echo "<img src='" . htmlspecialchars($row['image']) . "' alt='" . htmlspecialchars($row['name']) . "' class='product-image'>";
                }

                echo "<a href='order.php?id=" . $row['id'] . "' class='order-btn'>Order Now</a>";
                echo "</div>";
            }
        } else {
            echo "<p>No medicines available.</p>";
        }
        ?>
    </section>
    <footer class="bar">
       
            <a href="logout.php">Logout</a>
     
        <h3 class="contact">Contact 
        <h5>Phone: 01734556637</>
        <h5>E-mail: medicinecare@gmail.<i class="fa fa-comment" aria-hidden="true"></i></>

        <p class="copy">&copy; Medicine Care. All Rights Reserved.</p>
    </footer>
</body>
</html>
