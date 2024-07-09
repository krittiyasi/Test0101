<?php
include 'connected.php'; // Connect to MySQL

// Check if department ID is provided
if (!isset($_GET['id'])) {
    die('Department ID is not provided.');
}

$department_id = $_GET['id'];

// SQL query to delete department by ID
$delete_sql = "DELETE FROM department WHERE department_id = $department_id";

if ($conn->query($delete_sql) === TRUE) {
    header("Location: show_department.php");
    exit();
} else {
    echo "Error deleting department: " . $conn->error;
}

$conn->close(); // Close database connection
?>
