<?php
include 'db_connect.php';  // Database connection

// Delete manager if 'delete' parameter is set
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $deleteSql = "DELETE FROM manager WHERE Manager_ID = '$id'";
    $conn->query($deleteSql);
    header("Location: managers.php"); // Redirect after deletion
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manager List</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<div class="container">
    <h1>Manager List</h1>

    <?php
    // Query all managers
    $sql = "SELECT * FROM manager";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table>";
        echo "<tr><th>Manager ID</th><th>Name</th><th>Contact Number</th><th>Actions</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['Manager_ID'] . "</td>";
            echo "<td>" . $row['Name'] . "</td>";
            echo "<td>" . $row['Contact_No'] . "</td>";
            echo "<td>
                <a href='edit_manager.php?id=" . $row['Manager_ID'] . "'>Edit</a> |
                <a href='managers.php?delete=" . $row['Manager_ID'] . "' onclick='return confirm(\"Are you sure?\")'>Delete</a>
                </td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<p>No managers found!</p>";
    }

    $conn->close();
    ?>

    <button class="button" onclick="location.href='add_manager.php'">Add New Manager</button>
</div>

</body>
</html>
