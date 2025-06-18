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

$userID = $_SESSION['user_id'];

try {
    // 這裡可替換為「寫入 orders 表」
    $stmt = $conn->prepare("DELETE FROM [cart] WHERE userID = ?");
    $stmt->execute([$userID]);

    echo json_encode(['success' => true, 'message' => '✅ 結帳完成，感謝購買！']);
} catch (PDOException $e) {
    echo json_encode([
        'success' => false,
        'message' => '結帳失敗',
        'error' => $e->getMessage()
    ]);
}
