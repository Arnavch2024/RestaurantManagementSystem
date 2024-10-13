<?php
require 'db_connect.php';  // Ensure connection is established

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Check if the necessary POST values are set and not empty
    $Manager_ID = isset($_POST['Manager_ID']) ? $_POST['Manager_ID'] : null;
    $Name = isset($_POST['Name']) ? $_POST['Name'] : null;
    $Contact_No = isset($_POST['Contact_No']) ? $_POST['Contact_No'] : null;

    // Basic validation to ensure none of the fields are empty
    if (empty($Manager_ID) || empty($Name) || empty($Contact_No)) {
        echo "Error: All fields are required.";
        exit();
    }

    // Prepare the SQL statement
    $stmt = $conn->prepare("INSERT INTO manager (Manager_ID, Name, Contact_No) VALUES (?, ?, ?)");
    $stmt->bind_param("iss", $Manager_ID, $Name, $Contact_No);  // 'i' for integer, 's' for string

    // Execute the statement and check for success
    if ($stmt->execute()) {
        echo "Manager added successfully!";
        header('Location: managers.php');  // Redirect to managers list page after success
    } else {
        // Display the SQL error if any
        echo "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Manager</title>
</head>
<body>

    <h1>Add New Manager</h1>
    <form action="add_manager.php" method="POST">
        <label for="Manager_ID">Manager ID:</label>
        <input type="number" name="Manager_ID" required><br>

        <label for="Name">Name:</label>
        <input type="text" name="Name" required><br>

        <label for="Contact_No">Contact Number:</label>
        <input type="text" name="Contact_No" required><br>

        <button type="submit">Add Manager</button>
    </form>

    <a href="managers.php">Back to Manager List</a>

</body>
</html>
