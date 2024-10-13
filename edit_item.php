<?php
include 'db_connect.php';

$id = $_GET['Item_No'];  // Get the Item ID from the URL

// Fetch existing data for the selected item
$sql = "SELECT * FROM item WHERE Item_No= '$id'";
$result = $conn->query($sql);
$item = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $number = $_POST['Item_No'];
    $description = $_POST['Description'];
    $price = $_POST['Price'];

    // Update item details
    $sql = "UPDATE Items SET  Price='$price',Description='$description' WHERE Item_ID='$id'";

    if ($conn->query($sql) === TRUE) {
        header("Location: items.php");  // Redirect after update
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
    <title>Edit Item</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<div class="container">
    <h1>Edit Item</h1>
    <form method="post" action="edit_item.php?id=<?php echo $id; ?>">
        <label for="name">Item Name:</label>
        <input type="text" name="name" value="<?php echo $item['Name']; ?>" required>

        <label for="price">Price:</label>
        <input type="number" name="price" value="<?php echo $item['Price']; ?>" step="0.01" required>

        <button class="button" type="submit">Update Item</button>
    </form>
</div>

</body>
</html>
