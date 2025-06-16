<?php
require_once(__DIR__ . '/../config/db.php');
require_once(__DIR__ . '/../controllers/CartController.php');

$cartController = new CartController($conn);

// ✅ 從 session 拿 userID
$userID = $_SESSION['user_id'] ?? null;

// ✅ 確保是加入購物車的請求，並且登入了
if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'add' && $userID !== null) {
    $cartController->add($userID, $_POST);
}
?>
