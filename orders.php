<?php
include 'db_connect.php';  // Assuming this connects to the database
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order List</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<div class="container">
    <h1>Order List</h1>

    <?php
    $sql = "SELECT orders.Order_No, customer.Name AS CustomerName, orders.Order_Date
            FROM orders 
            INNER JOIN customer ON orders.Customer_ID = customer.Customer_ID";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table>";
        echo "<tr><th>Order ID</th><th>Customer Name</th><th>Order Date</th></tr>";
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['Order_No'] . "</td>";
            echo "<td>" . $row['CustomerName'] . "</td>";
            echo "<td>" . $row['Order_Date'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<p>No orders found!</p>";
    }

    $conn->close();
    ?>

    <button class="button" onclick="location.href='add_order.php'">Add New Order</button>
</div>

</body>
</html>
