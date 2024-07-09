<?php
include 'connected.php'; // Connect to MySQL

// Check if department ID is provided
if (!isset($_GET['id'])) {
    die('customer ID is not provided.');
}

$customer_id = $_GET['id'];

// SQL query to delete department by ID
$delete_sql = "DELETE FROM customer WHERE customer_id = $customer_id";

if ($conn->query($delete_sql) === TRUE) {
    header("Location: show_customer.php");
    exit();
} else {
    echo "Error deleting customer: " . $conn->error;
}

$conn->close(); // Close database connection
?>
