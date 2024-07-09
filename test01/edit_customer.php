<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Edit Customer</title>
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
</head>
<body>

<h2>Edit Customer</h2>

<?php
include 'connected.php'; // Connect to MySQL

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to sanitize input for security (optional)
function sanitize_input($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

// Check if customer ID is provided via URL parameter
if (isset($_GET['id'])) {
    $customer_id = $_GET['id'];

    // Fetch customer data from database based on ID
    $sql_select = "SELECT customer_id, customer_name, employee_id FROM customer WHERE customer_id='$customer_id'";
    $result = $conn->query($sql_select);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $customer_name = $row['customer_name'];
        $employee_id = $row['employee_id'];
    } else {
        echo "Customer not found";
        exit(); // Exit if customer ID not found
    }
} else {
    echo "Invalid request";
    exit(); // Exit if customer ID is not provided
}

// Check if form is submitted for editing
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $customer_name = sanitize_input($_POST['customer_name']);
    $employee_id = $_POST['employee_id'];

    // Prepare SQL statement to update data
    $sql_update = "UPDATE customer SET customer_name='$customer_name', employee_id='$employee_id' WHERE customer_id='$customer_id'";

    // Execute update query
    if ($conn->query($sql_update) === TRUE) {
        echo "Customer data updated successfully";
        echo "<script>window.location.href = 'show_customer.php';</script>"; // Redirect to show_customer.php on success
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

// Fetch employee data from database for dropdown
$sql_employee = "SELECT employee_id, employee_name FROM employee";
$result_employee = $conn->query($sql_employee);

?>

<form action="<?php echo $_SERVER['PHP_SELF'] . '?id=' . $customer_id; ?>" method="post">
    <label for="customer_name">Customer Name:</label>
    <input type="text" id="customer_name" name="customer_name" value="<?php echo $customer_name; ?>" required>
    
    <label for="employee_id">Employee:</label>
    <select id="employee_id" name="employee_id" required>
        <?php
        // Display options in dropdown
        if ($result_employee->num_rows > 0) {
            while($row_employee = $result_employee->fetch_assoc()) {
                $selected = ($row_employee['employee_id'] == $employee_id) ? 'selected' : '';
                echo "<option value='" . $row_employee['employee_id'] . "' $selected>" . $row_employee['employee_id'] . "</option>";
            }
        } else {
            echo "<option value=''>No employees found</option>";
        }
        ?>
    </select>
    
    <input type="submit" value="Update Customer">
</form>

</body>
</html>

<?php
$conn->close(); // Close database connection
?>
