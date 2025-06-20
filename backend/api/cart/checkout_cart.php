<?php
header("Access-Control-Allow-Origin: http://localhost:5173");
header("Access-Control-Allow-Credentials: true");
header("Content-Type: application/json");

session_start();

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => '尚未登入']);
    exit;
}

require_once(__DIR__ . '/../../config/db.php');
require_once(__DIR__ . '/../../controllers/CartController.php');

// 呼叫 CartController 的 checkout()
$userID = $_SESSION['user_id'];
$controller = new CartController($conn);
$controller->checkout($userID);  // ✅ 自動回傳 JSON 結果
