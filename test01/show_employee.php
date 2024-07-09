<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
/* CSS for table style */
#table-container {
    margin-left: 300px; /* Adjust table position */
    width: 65%;
    padding: 20px;
}

table {
    width: 100%;
    border-collapse: collapse;
}

table, th, td {
    border: 1px solid black;
    padding: 8px;
    text-align: left;
}

th {
    background-color: #f2f2f2;
}

.edit-button a {
    background-color: #4CAF50;
    color: white;
    padding: 5px 10px;
    text-decoration: none;
    border-radius: 3px;
    margin-right: 5px;
}

.delete-button a {
    background-color: #f44336;
    color: white;
    padding: 5px 10px;
    text-decoration: none;
    border-radius: 3px;
}

</style>
<title>Employee Table</title>
</head>
<body>
<?php
include 'connected.php'; // Connect to MySQL
include 'header.php'; // Include website header

// SQL query to fetch data from employee table
$sql = "SELECT * FROM employee";
$result = $conn->query($sql);

// Check if there are any results
if ($result->num_rows > 0) {
    // Start creating HTML table
    echo "<div id='table-container'>";
    echo "<table border='1'>";
    echo "<tr><th>Employee ID</th><th>Employee Name</th><th>Department ID</th><th>edit</th><th>delete</th></tr>";
    
    // Loop through each row to display data
    while($row = $result->fetch_assoc()) {
        // Display each employee's details and edit/delete links
        echo "<tr>";
        echo "<td>".$row["employee_id"]."</td>";
        echo "<td>".$row["employee_name"]."</td>";
        echo "<td>".$row["department_id"]."</td>";
        echo "<td>";
        echo "<div class='edit-button'><a href='edit_employee.php?id=".$row["employee_id"]."'>Edit</a></div>"; // Edit link
        echo "</td>";
        echo "<td>";
        echo "<div class='delete-button'><a href='delete_employee.php?id=".$row["employee_id"]."'>Delete</a></div>"; // Delete link
        echo "</td>";
        echo "</tr>";
    }
    
    echo "</table>"; // Close HTML table
    echo "</div>"; // Close table-container div
} else {
    echo "0 results"; // If no data found
}

$conn->close(); // Close database connection
?>

</body>
</html>
