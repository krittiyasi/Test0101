<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
/* CSS สำหรับสไตล์ของ side bar */
#sidebar {
    width: 200px;
    height: 100%;
    background-color: #f0f0f0;
    position: fixed;
    top: 0;
    left: 0;
    overflow-x: hidden;
    padding-top: 20px;
}

#sidebar h2 {
    padding: 10px;
    background-color: #ddd;
    border-bottom: 1px solid #bbb;
    margin: 0;
}

#sidebar ul {
    list-style-type: none;
    padding: 0;
}

#sidebar ul li {
    padding: 8px 16px;
    border-bottom: 1px solid #ccc;
}

#sidebar ul li:last-child {
    border-bottom: none;
}

#sidebar ul li a {
    text-decoration: none;
    color: #333;
    display: block;
}

#sidebar ul li a:hover {
    background-color: #ddd;
}
</style>
<title>Side Bar with CSS</title>
</head>
<body>

<div id="sidebar">
    <h2>พนักงาน</h2>
    <ul>
        <li><a href="show_employee.php">ดูรายการพนักงาน</a></li>
        <li><a href="add_employee.php">เพิ่มพนักงาน</a></li>
    </ul>

    <h2>ลูกค้า</h2>
    <ul>
        <li><a href="show_customer.php">ดูรายการลูกค้า</a></li>
        <li><a href="add_customer.php">เพิ่มลูกค้า</a></li>
    </ul>

    <h2>แผนก</h2>
    <ul>
        <li><a href="show_department.php">ดูรายการแผนก</a></li>
        <li><a href="add_department.php">เพิ่มแผนก</a></li>
    </ul>
</div>



</body>
</html>
