<?php
$conn = new mysqli("localhost", "root", "", "Lab_5b");
$matric = $_GET['matric'];
$conn->query("DELETE FROM users WHERE matric='$matric'");
header("Location: view_users.php");
?>
