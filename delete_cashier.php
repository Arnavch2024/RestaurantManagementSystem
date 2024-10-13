<?php
require 'db_connect.php';

$id = $_GET['Cashier_ID'];

$stmt = $conn->prepare("DELETE FROM cashier WHERE Cashier_ID = ?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    echo "Cashier deleted successfully!";
    header('Location: cashier.php');
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
