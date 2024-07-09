<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Add Customer</title>
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

<h2>Add Customer</h2>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <label for="customer_name">Customer Name:</label>
    <input type="text" id="customer_name" name="customer_name" required>
    
    <label for="employee_id">Employee Name:</label>
    <select id="employee_id" name="employee_id" required>
        <?php
        include 'connected.php'; // Connect to MySQL
        
        // Fetch employee data from database
        $sql = "SELECT employee_id, employee_name FROM employee";
        $result = $conn->query($sql);
        
        // Display options in dropdown
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<option value='" . $row['employee_id'] . "'>" . $row['employee_name'] . "</option>";
            }
        } else {
            echo "<option value=''>No employees found</option>";
        }
        $conn->close(); // Close database connection
        ?>
    </select>
    
    <input type="submit" value="Add Customer">
</form>

<?php
include 'connected.php'; // Connect to MySQL

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $customer_name = $_POST['customer_name'];
    $employee_id = $_POST['employee_id'];

    // Prepare SQL statement to insert data
    $sql = "INSERT INTO customer (customer_name, employee_id) VALUES ('$customer_name', '$employee_id')";

    // Execute SQL statement
    if ($conn->query($sql) === TRUE) {
        echo "<script>window.location.href = 'show_customer.php';</script>"; // Redirect to show_customer.php on success
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close(); // Close database connection
?>

</body>
</html>
