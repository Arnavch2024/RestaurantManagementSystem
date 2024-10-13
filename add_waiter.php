<?php
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $contact_no = $_POST['contact_no'];
    $waiter_id = $_POST['waiter_id'];

    // Inserting a new waiter
    $sql = "INSERT INTO waiter (Name, Contact_No, Waiter_ID)
            VALUES ('$name', '$contact_no', '$waiter_id')";

    if ($conn->query($sql) === TRUE) {
        header("Location: waiters.php"); // Redirect to waiter list after insertion
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
    <title>Add New Waiter</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<div class="container">
    <h1>Add New Waiter</h1>
    <form method="post" action="add_waiter.php">
        <label for="name">Name:</label>
        <input type="text" name="name" required>

        <label for="contact_no">Contact Number:</label>
        <input type="text" name="contact_no" required>

        <label for="waiter id">Waiter ID:</label>
        <input type="text" name="waiter id" required>


        <button class="button" type="submit">Add Waiter</button>
    </form>
</div>

</body>
</html>
