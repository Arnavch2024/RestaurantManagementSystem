<?php
include 'db_connect.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bill List</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<div class="container">
    <h1>Bill List</h1>

    <?php
    $sql = "SELECT bill.Bill_No, customer.Name AS CustomerName, bill.Amount, bill.Bill_Date 
            FROM bill 
            INNER JOIN customer ON bill.Customer_ID = customer.Customer_ID";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table>";
        echo "<tr><th>Bill No</th><th>Customer Name</th><th>Total Amount</th><th>Bill Date</th></tr>";
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['Bill_No'] . "</td>";
            echo "<td>" . $row['CustomerName'] . "</td>";
            echo "<td>" . $row['Amount'] . "</td>";
            echo "<td>" . $row['Bill_Date'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<p>No bill found!</p>";
    }

    $conn->close();
    ?>

    <button class="button" onclick="location.href='add_bill.php'">Add New Bill</button>
</div>

</body>
</html>
