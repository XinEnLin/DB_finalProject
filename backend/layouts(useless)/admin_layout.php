<?php
session_start();
require_once(__DIR__ . '/../config/db.php');

if (!isset($_SESSION['username']) || $_SESSION['username'] !== 'boss') {
    header("Location: ../layouts/login_layout.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="zh-Hant">
<head>
    <meta charset="UTF-8">
    <title>Boss 管理頁面</title>
    <style>
        body { font-family: "Segoe UI", sans-serif; padding: 30px; }
        .container { max-width: 1000px; margin: auto; }
        .back-btn {
            position: fixed; top: 20px; left: 20px;
            background-color: #4CAF50; color: white;
            padding: 8px 14px; border: none; border-radius: 6px; cursor: pointer;
        }
    </style>
</head>
<body>

<form action="../layouts/index_layout.php" method="get">
    <button type="submit" class="back-btn">回到首頁</button>
</form>

<div class="container">
    <?php include("../public/boss_dashboard.php"); ?>
</div>

</body>
</html>
