<?php
session_start();
if (!isset($_SESSION['matric'])) {
    header("Location: login.php");
    exit;
}

$conn = new mysqli("localhost", "root", "", "Lab_5b");
$result = $conn->query("SELECT matric, name, accessLevel FROM users");

echo "<table border='1'>
<tr><th>Matric</th><th>Name</th><th>Access Level</th><th>Action</th></tr>";

while ($row = $result->fetch_assoc()) {
    echo "<tr>
        <td>{$row['matric']}</td>
        <td>{$row['name']}</td>
        <td>{$row['accessLevel']}</td>
        <td>
            <a href='update.php?matric={$row['matric']}'>Update</a> |
            <a href='delete.php?matric={$row['matric']}'>Delete</a>
        </td>
    </tr>";
}
echo "</table>";
?>
