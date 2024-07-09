<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Add Employee</title>
<style>
/* CSS for form styling */
form {
    margin: 20px;
    padding: 20px;
    border: 1px solid #ccc;
    width: 300px;
}

label, select, input {
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
</head>
<body>

<h2>Add Employee</h2>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <label for="employee_name">Employee Name:</label>
    <input type="text" id="employee_name" name="employee_name" required>
    
    <label for="department_id">Department:</label>
    <select id="department_id" name="department_id" required>
        <?php
        include 'connected.php'; // Connect to MySQL
        
        // Fetch department data from database
        $sql = "SELECT department_id, department_name FROM department";
        $result = $conn->query($sql);
        
        // Display options in dropdown
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<option value='" . $row['department_id'] . "'>" . $row['department_name'] . "</option>";
            }
        } else {
            echo "<option value=''>No departments found</option>";
        }
        $conn->close(); // Close database connection
        ?>
    </select>
    
    <input type="submit" value="Add Employee">
</form>

<?php
include 'connected.php'; // Connect to MySQL

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $employee_name = $_POST['employee_name'];
    $department_id = $_POST['department_id'];

    // Prepare SQL statement to insert data
    $sql = "INSERT INTO employee (employee_name, department_id) VALUES ('$employee_name', '$department_id')";

    // Execute SQL statement
    if ($conn->query($sql) === TRUE) {
        echo "<script>window.location.href = 'show_employee.php';</script>"; // Redirect to show_employee.php on success
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close(); // Close database connection
?>

</body>
</html>
