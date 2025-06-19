<?php
require_once(__DIR__ . '/../../config/db.php');
require_once(__DIR__ . '/../../models/Order.php');
require_once(__DIR__ . '/../../models/OrderItem.php');

header('Content-Type: application/json');
session_start();

if (!isset($_SESSION['user_id']) || ($_SESSION['role'] ?? '') !== 'boss') {
    echo json_encode(['success' => false, 'message' => '無權限']);
    exit;
}

$input = json_decode(file_get_contents('php://input'), true);
$orderID = $input['orderID'] ?? null;
$status = $input['status'] ?? null;

if (!$orderID || !$status) {
    echo json_encode(['success' => false, 'message' => '缺少參數']);
    exit;
}

$order = new Order($conn);
$orderItem = new OrderItem($conn);

if ($status === '已出貨') {
    // ❌ 刪除訂單明細 → 再刪除訂單
    $orderItem->deleteByOrder($orderID);
    $order->deleteOrder($orderID);
    echo json_encode(['success' => true, 'message' => '訂單已出貨並刪除']);
} else {
    $order->updateStatus($orderID, $status);
    echo json_encode(['success' => true, 'message' => '狀態已更新']);
}
