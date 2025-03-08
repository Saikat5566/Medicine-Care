<?php
include 'db_connect.php';
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$sql = "SELECT orders.id, medicines.name, orders.quantity, orders.total_price, orders.status, orders.created_at 
        FROM orders 
        JOIN medicines ON orders.medicine_id = medicines.id 
        WHERE orders.user_id = $user_id
        ORDER BY orders.created_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Orders</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>My Orders</h2>
        <table>
            <tr>
                <th>Order ID</th>
                <th>Medicine Name</th>
                <th>Quantity</th>
                <th>Total Price</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['quantity']; ?></td>
                    <td><?php echo $row['total_price']; ?> BDT</td>
                </tr>
            <?php } ?>
        </table>
    </div>
    <footer>
        <p>&copy; Medicine Care. All Rights Reserved.</p>
    </footer>
</body>
</html>
