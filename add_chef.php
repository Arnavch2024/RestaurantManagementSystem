<?php
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $specialty = $_POST['specialty'];
    $contact_no = $_POST['contact_no'];
    $chef_id = $_POST['chef_id'];

    // Insert new chef into Chefs table
    $sql = "INSERT INTO chef (Name, Specialty, Contact_No, Chef_ID)
            VALUES ('$name', '$specialty', '$contact_no', '$chef_id')";

    if ($conn->query($sql) === TRUE) {
        header("Location: chefs.php");
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
    <title>Add New Chef</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<div class="container">
    <h1>Add New Chef</h1>
    <form method="post" action="add_chef.php">
        <label for="name">Name:</label>
        <input type="text" name="name" required>

        <label for="specialty">Specialty:</label>
        <input type="text" name="specialty" required>

        <label for="contact_no">Contact Number:</label>
        <input type="text" name="contact_no" required>

        <label for="chef_id">Chef ID:</label>
        <input type="text" name="chef_id" required>

        <button class="button" type="submit">Add Chef</button>
    </form>
</div>

</body>
</html>
