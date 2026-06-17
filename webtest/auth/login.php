<?php

$conn = new mysqli("mysql", "root", "root123", "testdb");

if ($conn->connect_error) {
    die("数据库连接失败: " . $conn->connect_error);
}

$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $user = $_POST['username'] ?? '';
    $pass = $_POST['password'] ?? '';

    $sql = "SELECT id, username FROM users WHERE username='$user' AND password='$pass'";
    
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $message = "[+] Login Success";
    } else {
        $message = "[-] Login Failed";
    }

}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Login Test</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<h1>ROOT@WebTest:~/auth#</h1>

<div class="panel">

    <h2>Login Test</h2>

    <form method="POST">

        <p>Username</p>

        <input type="text" name="username">

        <br><br>

        <p>Password</p>

        <input type="password" name="password">

        <br><br>

        <button type="submit">LOGIN</button>

    </form>

</div>

<?php if ($message != ""): ?>

<div class="panel">
    <h2><?php echo htmlspecialchars($message); ?></h2>
</div>

<?php endif; ?>

<div class="panel">

    <a href="index.php">返回 Authentication</a>

    <br><br>

    <a href="../index.php">返回首页</a>

</div>

</body>
</html>