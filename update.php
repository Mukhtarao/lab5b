<?php
$conn = new mysqli("localhost", "root", "", "Lab_5b");
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $matric = $_POST['matric'];
    $name = $_POST['name'];
    $accessLevel = $_POST['accessLevel'];

    $stmt = $conn->prepare("UPDATE users SET name=?, accessLevel=? WHERE matric=?");
    $stmt->bind_param("sss", $name, $accessLevel, $matric);
    $stmt->execute();
    header("Location: view_users.php");
} else {
    $matric = $_GET['matric'];
    $result = $conn->query("SELECT * FROM users WHERE matric='$matric'");
    $row = $result->fetch_assoc();
?>
<form method="POST" action="update.php">
    <input type="hidden" name="matric" value="<?php echo $row['matric']; ?>">
    Name: <input type="text" name="name" value="<?php echo $row['name']; ?>"><br>
    Access Level:
    <select name="accessLevel">
        <option value="user" <?php if ($row['accessLevel'] == 'user') echo 'selected'; ?>>User</option>
        <option value="admin" <?php if ($row['accessLevel'] == 'admin') echo 'selected'; ?>>Admin</option>
    </select><br>
    <input type="submit" value="Update">
</form>
<?php } ?>
