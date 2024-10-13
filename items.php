<?php
include 'db_connect.php';  // Database connection

// Handle item deletion if 'delete' parameter is set
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $deleteSql = "DELETE FROM item WHERE Item_No = '$id'";
    $conn->query($deleteSql);
    header("Location: items.php"); // Redirect after deletion
}

// Initialize search query as empty
$search = "";

// Check if search form is submitted
if (isset($_GET['search'])) {
    $search = $_GET['search'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Items List</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<div class="container">
    <h1>Items List</h1>

    <!-- Search form -->
    <form method="GET" action="items.php">
        <input type="text" name="search" placeholder="Search items by name" value="<?php echo htmlspecialchars($search); ?>">
        <button class="button" type="submit">Search</button>
    </form>

    <?php
    // Query to fetch items, with search functionality
    $sql = "SELECT * FROM item";

    // If search term is entered, add WHERE clause to SQL query
    if (!empty($search)) {
        $sql .= " WHERE Description LIKE '%$search%'";
    }

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table>";
        echo "<tr><th>Item ID</th><th>Name</th><th>Price</th><th>Actions</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['Item_No'] . "</td>";
            echo "<td>" . $row['Description'] . "</td>";
            echo "<td>" . $row['Price'] . "</td>";
            echo "<td>
                <a href='edit_item.php?id=" . $row['Item_No'] . "'>Edit</a> |
                <a href='items.php?delete=" . $row['Item_No'] . "' onclick='return confirm(\"Are you sure?\")'>Delete</a>
                </td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<p>No items found!</p>";
    }

    $conn->close();
    ?>

    <button class="button" onclick="location.href='add_item.php'">Add New Item</button>
</div>

</body>
</html>
