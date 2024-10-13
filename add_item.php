<?php
require 'db_connect.php';  // Ensure connection is established

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Check if the necessary POST values are set and not empty
    $Item_No = isset($_POST['Item_No']) ? $_POST['Item_No'] : null;
    $Description = isset($_POST['Description']) ? $_POST['Description'] : null;
    $Price = isset($_POST['Price']) ? $_POST['Price'] : null;

    // Basic validation to ensure none of the fields are empty
    if (empty($Item_No) || empty($Description) || empty($Price)) {
        echo "Error: All fields are required.";
        exit();
    }

    // Prepare the SQL statement
    $stmt = $conn->prepare("INSERT INTO item (Item_No, Description, Price) VALUES (?, ?, ?)");
    $stmt->bind_param("isd", $Item_No, $Description, $Price); // 'i' for integer, 's' for string, 'd' for double/decimal

    // Execute the statement and check for success
    if ($stmt->execute()) {
        echo "Item added successfully!";
        header('Location: items.php');  // Redirect to items list page after success
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
    <title>Add New Item</title>
</head>
<body>

    <h1>Add New Item</h1>
    <form action="add_item.php" method="POST">
        <label for="Item_No">Item No:</label>
        <input type="number" name="Item_No" required><br>

        <label for="Description">Description:</label>
        <input type="text" name="Description" required><br>

        <label for="Price">Price:</label>
        <input type="text" name="Price" required><br>

        <button type="submit">Add Item</button>
    </form>

    <a href="items.php">Back to Item List</a>

</body>
</html>
