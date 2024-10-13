<?php
require 'db_connect.php';

$id = $_GET['Cashier_ID'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = trim($_POST['Name']);
    $contact_no = trim($_POST['Contact_No']);
    $address = trim($_POST['Address']);

    if (empty($name) || empty($contact_no) || empty($address)) {
        echo "Error: All fields are required.";
        exit();
    }

    $stmt = $conn->prepare("UPDATE cashiers SET Name = ?, Contact_No = ? , Address = ? WHERE Cashier_ID = ?");
    $stmt->bind_param("ssi", $name, $contact_no, $address, $id);

    if ($stmt->execute()) {
        echo "Cashier updated successfully!";
        header('Location: cashier.php');
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    // Fetch the cashier details for the given id
    $stmt = $conn->prepare("SELECT * FROM cashier WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $cashier = $result->fetch_assoc();
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Cashier</title>
</head>
<body>

    <h1>Edit Cashier</h1>
    <form action="edit_cashier.php?id=<?php echo $id; ?>" method="POST">
        <label for="name">Name:</label>
        <input type="text" name="name" value="<?php echo $cashier['Name']; ?>" required><br>

        <label for="contact_no">Contact No:</label>
        <input type="text" name="contact_no" value="<?php echo $cashier['Contact_No']; ?>" required><br>
        <label for="address">Address:</label>
        <input type="text" name="address" value="<?php echo $cashier['Address']; ?>" required><br>

        <button type="submit">Update Cashier</button>
    </form>

    <a href="cashiers.php">Back to Cashier List</a>

</body>
</html>
