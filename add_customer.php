<?php
include 'db_connect.php';  // Assuming this connects to the database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['Name'];
    $customer_id = $_POST['Customer_ID'];
    $phone_number = $_POST['Contact_No'];
    $address = $_POST['Address'];

    // Insert customer into database
    $sql = "INSERT INTO customer (Name, Customer_ID,Contact_No, Address)
            VALUES ('$name', '$customer_id', '$phone_number', '$address')";

    if ($conn->query($sql) === TRUE) {
        header("Location: customers.php");
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
    <title>Add New Customer</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 500px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #333;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        input[type="text"], input[type="Customer_ID"], textarea {
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .button {
            padding: 10px;
            background-color: #5cb85c;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .button:hover {
            background-color: #4cae4c;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Add New Customer</h1>
    <form method="post" action="add_customer.php">
        <input type="text" name="Name" placeholder="Customer Name" required>
        <input type="text" name="Customer_ID" placeholder="Customer_ID" required>
        <input type="text" name="Contact_No" placeholder="Contact_No" required>
        <textarea name="Address" placeholder="Address" rows="4"></textarea>
        <button class="button" type="submit">Add Customer</button>
    </form>
</div>

</body>
</html>
