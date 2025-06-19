<?php
require_once(__DIR__ . '/../models/Order.php');
require_once(__DIR__ . '/../models/OrderItem.php');

class OrderController {
    private $conn;

    public function __construct($dbConn) {
        $this->conn = $dbConn;
    }

    public function getUserOrdersWithItems($userID) {
        $orderModel = new Order($this->conn);
        $itemModel = new OrderItem($this->conn);

        $orders = $orderModel->getOrdersByUser($userID);

        foreach ($orders as &$order) {
            $orderID = $order['orderID'];
            $order['items'] = $itemModel->getItemsByOrder($orderID);
        }

        return $orders;
    }
}
