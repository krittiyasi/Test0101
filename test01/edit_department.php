<?php
include 'connected.php'; // Connect to MySQL


// Check if department ID is provided via URL parameter
if (isset($_GET['id'])) {
    $department_id = $_GET['id'];

    // Fetch department data from database based on ID
    $sql_select = "SELECT department_id, department_name FROM department WHERE department_id='$department_id'";
    $result = $conn->query($sql_select);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $department_name = $row['department_name'];
    } else {
        echo "Department not found";
        exit(); // Exit if department ID not found
    }
} else {
    echo "Invalid request";
    exit(); // Exit if department ID is not provided
}

// Check if form is submitted for editing
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $department_name = sanitize_input($_POST['department_name']);

    // Prepare SQL statement to update data
    $sql_update = "UPDATE department SET department_name='$department_name' WHERE department_id='$department_id'";

    // Execute update query
    if ($conn->query($sql_update) === TRUE) {
        echo "Department data updated successfully";
        echo "<script>window.location.href = 'show_department.php';</script>"; // Redirect to department_table.php on success
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

$conn->close(); // Close database connection

// Function to sanitize input for security (optional)
function sanitize_input($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
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
</style>
<title>Edit Department</title>
</head>
<body>

<h2>Edit Department</h2>

<form action="<?php echo $_SERVER['PHP_SELF'] . '?id=' . $department_id; ?>" method="post">
    <label for="department_name">Department Name:</label>
    <input type="text" id="department_name" name="department_name" value="<?php echo $department_name; ?>" required>
    
    <input type="submit" value="Update Department">
</form>

</body>
</html>
