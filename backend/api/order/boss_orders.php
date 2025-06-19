<?php
require_once(__DIR__ . '/../../config/db.php');
require_once(__DIR__ . '/../../models/Order.php');
require_once(__DIR__ . '/../../models/OrderItem.php');

header('Content-Type: application/json');
session_start();

// 權限檢查：只有 boss 可以看全部訂單
if (!isset($_SESSION['user_id']) || ($_SESSION['role'] ?? '') !== 'boss') {
    echo json_encode(['success' => false, 'message' => '無權限']);
    exit;
}

$orderModel = new Order($conn);
$itemModel = new OrderItem($conn);

// 🔍 查詢所有訂單
$orders = $orderModel->getAllOrders();  // ⬅ 我們等一下會幫你補這個方法

// 🔁 附加訂單明細
foreach ($orders as &$order) {
    $orderID = $order['orderID'];
    $order['items'] = $itemModel->getItemsByOrder($orderID);
}

echo json_encode(['success' => true, 'orders' => $orders]);
