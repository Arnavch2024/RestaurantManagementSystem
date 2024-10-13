<?php
require 'db_connect.php';

// Fetch all cashiers from the database
$query = "SELECT * FROM cashier";
$result = $conn->query($query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cashier Management</title>
</head>
<body>

    <h1>Cashier Management</h1>

    <a href="add_cashier.php">Add New Cashier</a>

    <table border="1" cellspacing="0" cellpadding="10">
        <tr>
            <th>Cashier_ID</th>
            <th>Name</th>
            <th>Contact No</th>
            <th>Actions</th>
        </tr>

        <?php while ($row = $result->fetch_assoc()) { ?>
        <tr>
            <td><?php echo $row['Cashier_ID']; ?></td>
            <td><?php echo $row['Name']; ?></td>
            <td><?php echo $row['Contact_No']; ?></td>
            <td><?php echo $row['Address']; ?></td>
        <td>
                <a href="edit_cashier.php?id=<?php echo $row['Cashier_ID']; ?>">Edit</a> |
                <a href="delete_cashier.php?id=<?php echo $row['Cashier_ID']; ?>" onclick="return confirm('Are you sure?')">Delete</a>
            </td>
        </tr>
        <?php } ?>
    </table>

</body>
</html>
