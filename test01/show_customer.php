<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
/* CSS for table styling */
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

/* CSS for form styling */
form {
    margin: 20px;
    padding: 20px;
    border: 1px solid #ccc;
    width: 300px;
}

label, input, select {
    display: block;
    margin-bottom: 10px;
}

input[type="submit"] {
    background-color: #4CAF50;
    color: white;
    border: none;
    padding: 10px 20px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin-top: 10px;
    cursor: pointer;
}

.delete-button a {
    background-color: #f44336;
    color: white;
    padding: 5px 10px;
    text-decoration: none;
    border-radius: 3px;
}
</style>
<title>Customer Table</title>
</head>
<body>

<?php
include 'connected.php'; // Connect to MySQL
include 'header.php'; // Include header if needed

// Function to sanitize input for security (optional)
function sanitize_input($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

// Check if form is submitted for editing
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $customer_id = $_POST['customer_id'];
    $customer_name = sanitize_input($_POST['customer_name']);
    $employee_id = $_POST['employee_id'];

    // Prepare SQL statement to update data
    $sql_update = "UPDATE customer SET customer_name='$customer_name', employee_id='$employee_id' WHERE customer_id='$customer_id'";

    // Execute update query
    if ($conn->query($sql_update) === TRUE) {
        echo "Customer data updated successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

// Fetch customer data from database
$sql_select = "SELECT customer_id, customer_name, employee_id FROM customer";
$result = $conn->query($sql_select);

// Display table with customer data
if ($result->num_rows > 0) {
    echo "<div id='table-container'>";
    echo "<table>";
    echo "<tr><th>Customer ID</th><th>Customer Name</th><th>Employee ID</th><th>Action</th><th>Action</th></tr>";
    
    while($row = $result->fetch_assoc()) {
        // Display each row with edit and delete options
        echo "<tr>";
        echo "<td>".$row["customer_id"]."</td>";
        echo "<td>".$row["customer_name"]."</td>";
        echo "<td>".$row["employee_id"]."</td>";
        echo "<td>";
        echo "<a href='edit_customer.php?id=".$row["customer_id"]."'>Edit</a>";
        echo "</td>";
        echo "<td>";
        echo "<div class='delete-button'><a href='delete_customer.php?id=".$row["customer_id"]."'>Delete</a></div>"; // Link to delete page
        echo "</td>";
        echo "</tr>";
    }
    
    echo "</table>";
    echo "</div>";
} else {
    echo "0 results";
}

$conn->close(); // Close database connection
?>

</body>
</html>
