<?php
include 'db_connect.php';  // Database connection file

// Deleting a waiter if 'delete' is triggered
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $deleteSql = "DELETE FROM waiter WHERE Waiter_ID = '$id'";
    $conn->query($deleteSql);
    header("Location: waiters.php"); // Redirect to the same page after deletion
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Waiter List</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<div class="container">
    <h1>Waiter List</h1>

    <?php
    $sql = "SELECT * FROM waiter";  // Fetching all waiter
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table>";
        echo "<tr><th>Waiter ID</th><th>Name</th><th>Contact Number</th><th>Actions</th></tr>";
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['Waiter_ID'] . "</td>";
            echo "<td>" . $row['Name'] . "</td>";
            echo "<td>" . $row['Contact_No'] . "</td>";
            echo "<td>
                <a href='edit_waiter.php?id=" . $row['Waiter_ID'] . "'>Edit</a> |
                <a href='waiters.php?delete=" . $row['Waiter_ID'] . "' onclick='return confirm(\"Are you sure?\")'>Delete</a>
                </td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<p>No waiters found!</p>";
    }

    $conn->close();
    ?>

    <button class="button" onclick="location.href='add_waiter.php'">Add New Waiter</button>
</div>

</body>
</html>
