<?php
include 'db_connect.php';

$id = $_GET['id'];  // Get the Waiter ID from URL

// Fetch existing data
$sql = "SELECT * FROM waiter WHERE Waiter_ID = '$id'";
$result = $conn->query($sql);
$waiter = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $contact_no = $_POST['contact_no'];
    $waiter_id = $_POST['waiter_id'];

    // Updating waiter data
    $sql = "UPDATE waiter SET Name='$name', Contact_No='$contact_no', Waiter_ID= '$waiter_id' WHERE Waiter_ID='$id'";

    if ($conn->query($sql) === TRUE) {
        header("Location: waiters.php");  // Redirect to the waiter list after update
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
    <title>Edit Waiter</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<div class="container">
    <h1>Edit Waiter</h1>
    <form method="post" action="edit_waiter.php?id=<?php echo $id; ?>">
        <label for="name">Name:</label>
        <input type="text" name="name" value="<?php echo $waiter['Name']; ?>" required>

        <label for="contact_no">Contact Number:</label>
        <input type="text" name="contact_no" value="<?php echo $waiter['Contact_No']; ?>" required>

        <label for="waiter_id">Waiter ID:</label>
        <input type="text" name="waiter_id" value="<?php echo $waiter['Waiter_ID']; ?>" required>

        <button class="button" type="submit">Update Waiter</button>
    </form>
</div>

</body>
</html>
