<form method="POST" action="register.php">
    Matric: <input type="text" name="matric"><br>
    Name: <input type="text" name="name"><br>
    Password: <input type="password" name="password"><br>
    Access Level:
    <select name="accessLevel">
        <option value="user">User</option>
        <option value="admin">Admin</option>
    </select><br>
    <input type="submit" name="submit" value="Register">
</form>

<?php
if (isset($_POST['submit'])) {
    $conn = new mysqli("localhost", "root", "", "Lab_5b");
    $matric = $_POST['matric'];
    $name = $_POST['name'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $accessLevel = $_POST['accessLevel'];

    $stmt = $conn->prepare("INSERT INTO users (matric, name, password, accessLevel) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $matric, $name, $password, $accessLevel);
    $stmt->execute();
    echo "User registered successfully!";
}
?>
