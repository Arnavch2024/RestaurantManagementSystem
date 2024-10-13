<?php
include 'db_connect.php';

$id = $_GET['Manager_ID'];  // Get the Manager ID from URL

// Fetch existing data for the selected manager
$sql = "SELECT * FROM manager WHERE Manager_ID = '$id'";
$result = $conn->query($sql);
$manager = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['Name'];
    $contact_no = $_POST['Contact_No'];

    // Update manager details
    $sql = "UPDATE manager SET Name='$name', Contact_No='$contact_no' WHERE Manager_ID='$id'";

    if ($conn->query($sql) === TRUE) {
        header("Location: managers.php");  // Redirect after update
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
    <title>Edit Manager</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<div class="container">
    <h1>Edit Manager</h1>
    <form method="post" action="edit_manager.php?id=<?php echo $id; ?>">
        <label for="name">Name:</label>
        <input type="text" name="name" value="<?php echo $manager['Name']; ?>" required>

        <label for="contact_no">Contact Number:</label>
        <input type="text" name="contact_no" value="<?php echo $manager['Contact_No']; ?>" required>

        <button class="button" type="submit">Update Manager</button>
    </form>
</div>

</body>
</html>
