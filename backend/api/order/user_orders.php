<?php
require_once(__DIR__ . '/../../config/db.php');
require_once(__DIR__ . '/../../controllers/OrderController.php');

header('Content-Type: application/json');
session_start();

$userID = $_SESSION['user_id'] ?? null;

if (!$userID) {
    echo json_encode(['success' => false, 'message' => '請先登入']);
    exit;
}

$controller = new OrderController($conn);
$orders = $controller->getUserOrdersWithItems($userID);

echo json_encode(['success' => true, 'orders' => $orders]);
