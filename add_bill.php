<?php
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $customer_id = $_POST['customer_id'];
    $total_amount = $_POST['amount'];
    $bill_date = $_POST['bill_date'];
    $bill_no = $_POST['bill_no'];

    // Insert new bill into Bills table
    $sql = "INSERT INTO bill (Customer_ID, Amount, Bill_Date, Bill_No)
            VALUES ('$customer_id', '$total_amount', '$bill_date', '$bill_no')";

    if ($conn->query($sql) === TRUE) {
        header("Location: bills.php");
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
    <title>Add New Bill</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<div class="container">
    <h1>Add New Bill</h1>
    <form method="post" action="add_bill.php">
        <label for="customer_id">Customer ID:</label>
        <input type="text" name="customer_id" required>

        <label for="total_amount">Total Amount:</label>
        <input type="text" name="total_amount" required>

        <label for="bill_date">Bill Date:</label>
        <input type="date" name="bill_date" required>

        <label for ="bill_no">Bill No:</label>
        <input type="text" name="bill_no" required>

        <button class="button" type="submit">Add Bill</button>
    </form>
</div>

</body>
</html>
