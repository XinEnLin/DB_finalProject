<?php
session_start();
require_once(__DIR__ . '/../config/db.php');

// 登入錯誤訊息處理
$error = '';
if (isset($_SESSION['login_error'])) {
    $error = $_SESSION['login_error'];
    unset($_SESSION['login_error']);
}
?>

<!DOCTYPE html>
<html lang="zh-Hant">
<head>
    <meta charset="UTF-8">
    <title>使用者登入</title>
</head>
<body>
<h1>使用者登入</h1>

<?php if (!empty($error)): ?>
    <p style="color:red;"><?php echo $error; ?></p>
<?php endif; ?>

<form method="post" action="../public/login.php">
    <label>帳號：<input type="text" name="username" required></label><br>
    <label>密碼：<input type="password" name="password" required></label><br><br>
    <button type="submit">登入</button>
</form>

<p>還沒有帳號？<a href="register_layout.php">點我註冊</a></p>
</body>
</html>
