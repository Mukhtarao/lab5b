<form method="POST" action="login.php">
    Matric: <input type="text" name="matric"><br>
    Password: <input type="password" name="password"><br>
    <input type="submit" name="login" value="Login"><br>
    <a href="register.php">Register Here</a>
</form>

<?php
if (isset($_POST['login'])) {
    session_start();
    $conn = new mysqli("localhost", "root", "", "Lab_5b");
    $matric = $_POST['matric'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE matric = ?");
    $stmt->bind_param("s", $matric);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['matric'] = $user['matric'];
        $_SESSION['accessLevel'] = $user['accessLevel'];
        header("Location: view_users.php");
    } else {
        echo "Invalid matric or password.";
    }
}
?>
