<?php
include 'db_connect.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chef List</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<div class="container">
    <h1>Chef List</h1>

    <?php
    $sql = "SELECT * FROM chef";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table>";
        echo "<tr><th>Chef ID</th><th>Name</th><th>Specialty</th><th>Contact Number</th></tr>";
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['Chef_ID'] . "</td>";
            echo "<td>" . $row['Name'] . "</td>";
            echo "<td>" . $row['Specialty'] . "</td>";
            echo "<td>" . $row['Contact_No'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<p>No chefs found!</p>";
    }

    $conn->close();
    ?>

    <button class="button" onclick="location.href='add_chef.php'">Add New Chef</button>
</div>

</body>
</html>
