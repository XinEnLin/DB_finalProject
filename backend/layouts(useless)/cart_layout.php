<?php
session_start();
require_once(__DIR__ . '/../config/db.php');
require_once(__DIR__ . '/../controllers/CartController.php');
$cart = new CartController($conn);

// 結帳成功提示訊息
$checkout_message = '';
if (isset($_SESSION['checkout_message'])) {
    $checkout_message = $_SESSION['checkout_message'];
    unset($_SESSION['checkout_message']);
}
?>

<!DOCTYPE html>
<html lang="zh-Hant">
<head>
    <meta charset="UTF-8">
    <title>購物車內容</title>
    <style>
        table { border-collapse: collapse; width: 80%; margin: auto; }
        th, td { border: 1px solid #ccc; padding: 10px; text-align: center; }
        h1 { text-align: center; }
        .total { font-weight: bold; color: darkred; }
        .btn-back, .btn-cart {
            margin: 10px auto;
            display: inline-block;
            background: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
        }
        .center { text-align: center; }
    </style>
</head>
<body>

<h1>🛒 我的購物車</h1>

<?php if (!empty($checkout_message)): ?>
    <p class="center" style="color:green;"><?php echo $checkout_message; ?></p>
<?php endif; ?>

<?php include("../partials/cart_table.php"); ?>

<div class="center">
    <form action="../public/list_cart.php" method="post" style="display:inline;">
        <input type="hidden" name="action" value="clear">
        <button type="submit" class="btn-cart">🧹 清空購物車</button>
    </form>

    <form action="../public/list_cart.php" method="post" style="display:inline;">
        <input type="hidden" name="action" value="checkout">
        <button type="submit" class="btn-cart">🧾 結帳</button>
    </form>
</div>

<form action="index_layout.php" method="get" class="center">
    <button class="btn-back" type="submit">⬅️ 返回首頁</button>
</form>

</body>
</html>
