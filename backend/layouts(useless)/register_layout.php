<?php
session_start();
require_once(__DIR__ . '/../config/db.php');

$message = '';
if (isset($_SESSION['register_message'])) {
    $message = $_SESSION['register_message'];
    unset($_SESSION['register_message']);
}
?>

<!DOCTYPE html>
<html lang="zh-Hant">
<head>
    <meta charset="UTF-8">
    <title>註冊</title>
</head>
<body>
<h1>使用者註冊</h1>

<?php if (!empty($message)): ?>
    <p><?php echo $message; ?></p>
<?php endif; ?>

<form method="post" action="../public/register.php">
    <label>帳號：<input type="text" name="username" required></label><br>
    <label>Email：<input type="email" name="email" required></label><br>
    <label>密碼：<input type="password" name="password" required></label><br>
    <label>地址：<input type="text" name="address" required></label><br>
    <label>電話：<input type="text" name="phone" required></label><br><br>
    <button type="submit">註冊</button>
</form>
<p>已經有帳號？<a href="login_layout.php">點我登入</a></p>
</body>
</html>
