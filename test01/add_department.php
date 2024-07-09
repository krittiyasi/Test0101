<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Add Department</title>
<style>
/* CSS สำหรับการจัดรูปแบบฟอร์ม */
form {
    margin: 20px;
    padding: 20px;
    border: 1px solid #ccc;
    width: 300px;
}

label, input {
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

<h2>Add Department</h2>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <label for="department_name">Department Name:</label>
    <input type="text" id="department_name" name="department_name" required>
    <input type="submit" value="Add Department">
</form>

<?php
include 'connected.php'; // เชื่อมต่อกับฐานข้อมูล MySQL

// ตรวจสอบการส่งข้อมูลแผนก
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $department_name = $_POST['department_name'];

    // เตรียมคำสั่ง SQL สำหรับเพิ่มข้อมูล
    $sql = "INSERT INTO department (department_name) VALUES ('$department_name')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>window.location.href = 'show_department.php';</script>"; // Redirect to show_customer.php on success
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close(); // ปิดการเชื่อมต่อฐานข้อมูล
?>

</body>
</html>
