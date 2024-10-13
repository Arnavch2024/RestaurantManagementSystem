<?php
require 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = trim($_POST['name']);
    $contact_no = trim($_POST['contact_no']);
    $address = trim($_POST['address']);

    if (empty($name) || empty($contact_no ) || empty($address) ) {
        echo "Error: All fields are required.";
        exit();
    }

    $stmt = $conn->prepare("INSERT INTO cashier (Name, Contact_No, Address) VALUES (?, ?, ?)");
    $stmt->bind_param("ss", $name, $contact_no , $address);

    if ($stmt->execute()) {
        echo "Cashier added successfully!";
        header('Location: cashiers.php');
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Cashier</title>
</head>
<body>

    <h1>Add Cashier</h1>
    <form action="add_cashier.php" method="POST">
        <label for="name">Name:</label>
        <input type="text" name="name" required><br>

        <label for="contact_no">Contact No:</label>
        <input type="text" name="contact_no" required><br>

        <label for="address">Address:</label>
        <input type="text" name="address" required><br>

        <button type="submit">Add Cashier</button>
    </form>

    <a href="cashiers.php">Back to Cashier List</a>

</body>
</html>
