<?php
include 'connected.php'; // Connect to MySQL
include 'header.php'; // Include website header

// Check if employee ID is provided
if (!isset($_GET['id'])) {
    die('Employee ID is not provided.');
}

$employee_id = $_GET['id'];

// SQL query to fetch employee data by ID
$sql_employee = "SELECT * FROM employee WHERE employee_id = $employee_id";
$result_employee = $conn->query($sql_employee);

// Check if employee exists
if ($result_employee->num_rows > 0) {
    $employee = $result_employee->fetch_assoc();
} else {
    die('Employee not found.');
}

// Handle form submission for updating employee data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize input data
    $employee_name = mysqli_real_escape_string($conn, $_POST['employee_name']);
    $department_id = mysqli_real_escape_string($conn, $_POST['department_id']);

    // Update SQL query
    $update_sql = "UPDATE employee SET employee_name = '$employee_name', department_id = '$department_id' WHERE employee_id = $employee_id";

    if ($conn->query($update_sql) === TRUE) {
        echo "Employee updated successfully";
        // Redirect to employee list page or any other desired page
        header("Location: show_employee.php");
        exit();
    } else {
        echo "Error updating employee: " . $conn->error;
    }
}

// SQL query to fetch all departments for dropdown list
$sql_departments = "SELECT * FROM department";
$result_departments = $conn->query($sql_departments);

$conn->close(); // Close database connection
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
/* CSS for form style */
.form-container {
    margin-left: 300px; /* Adjust form position */
    width: 65%;
    padding: 20px;
}

.input-group {
    margin-bottom: 10px;
}

.input-group label {
    display: block;
    margin-bottom: 5px;
}

.input-group select, .input-group input {
    padding: 5px;
    width: 100%;
    box-sizing: border-box;
}

.submit-button {
    margin-top: 10px;
}

.submit-button button {
    background-color: #4CAF50;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}
</style>
<title>Edit Employee</title>
</head>
<body>
<div class="form-container">
    <h2>Edit Employee</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?id=' . $employee_id; ?>">
        <div class="input-group">
            <label for="employee_name">Employee Name:</label>
            <input type="text" id="employee_name" name="employee_name" value="<?php echo $employee['employee_name']; ?>" required>
        </div>
        <div class="input-group">
            <label for="department_id">Department:</label>
            <select id="department_id" name="department_id" required>
                <?php
                // Loop through each department to create options
                while($row_department = $result_departments->fetch_assoc()) {
                    $selected = ($row_department['department_id'] == $employee['department_id']) ? 'selected' : '';
                    echo "<option value='".$row_department['department_id']."' $selected>".$row_department['department_name']."</option>";
                }
                ?>
            </select>
        </div>
        <div class="submit-button">
            <button type="submit">Update Employee</button>
        </div>
    </form>
</div>

</body>
</html>
