<?php
include 'connected.php'; // Connect to MySQL

// Check if employee ID is provided
if (!isset($_GET['id'])) {
    die('Employee ID is not provided.');
}

$employee_id = $_GET['id'];

// SQL query to delete employee by ID
$delete_sql = "DELETE FROM employee WHERE employee_id = $employee_id";

if ($conn->query($delete_sql) === TRUE) {
    header("Location: show_employee.php");
    exit();
} else {
    echo "Error deleting employee: " . $conn->error;
}

$conn->close(); // Close database connection
?>
