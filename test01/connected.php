<?php
$servername = "localhost";
$username = "root"; // ชื่อผู้ใช้งานของคุณ
$password = "12345678"; // รหัสผ่านของคุณ
$dbname = "test01"; // ชื่อฐานข้อมูลของคุณ

// สร้างการเชื่อมต่อ
$conn = new mysqli($servername, $username, $password, $dbname);

// ตรวจสอบการเชื่อมต่อ
if ($conn->connect_error) {
    die("การเชื่อมต่อล้มเหลว: " . $conn->connect_error);
} 


?>
