<?php
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $customer_id = $_POST['Customer_ID'];
    $order_date = $_POST['Order_Date'];
    $order_no = $_POST['Order_No'];

    // Insert new order into Orders table
    $sql = "INSERT INTO orders (Customer_ID, Order_Date, Order_No)
            VALUES ('$customer_id', '$order_date', '$order_no')";

    if ($conn->query($sql) === TRUE) {
        header("Location: orders.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Order</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<div class="container">
    <h1>Add New Order</h1>
    <form method="post" action="add_order.php">
        <label for="customer_id">Customer ID:</label>
        <input type="text" name="customer_id" required>

        <label for="order_date">Order Date:</label>
        <input type="date" name="order_date" required>

        <label for="total_amount">Total Amount:</label>
        <input type="text" name="total_amount" required>

        <button class="button" type="submit">Add Order</button>
    </form>
</div>

</body>
</html>
