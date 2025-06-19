<?php
require_once(__DIR__ . '/../config/db.php');


class Order {
    private $conn;

    public function __construct($dbConn) {
        $this->conn = $dbConn;
    }

    public function createOrder($userID, $totalAmount, $status = 'pending') {
        $stmt = $this->conn->prepare(
            "INSERT INTO [order] (userID, orderDate, totalAmount, status)
             VALUES (?, GETDATE(), ?, ?)"
        );
        $stmt->execute([$userID, $totalAmount, $status]);
        return $this->conn->lastInsertId();
    }

    public function getOrdersByUser($userID) {
        $stmt = $this->conn->prepare("SELECT * FROM [order] WHERE userID = ?");
        $stmt->execute([$userID]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllOrders() {
        $stmt = $this->conn->prepare("SELECT * FROM [order] ORDER BY orderDate DESC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateStatus($orderID, $status) {
        $stmt = $this->conn->prepare("UPDATE [order] SET status = ? WHERE orderID = ?");
        return $stmt->execute([$status, $orderID]);
    }

    public function deleteOrder($orderID) {
        $stmt = $this->conn->prepare("DELETE FROM [order] WHERE orderID = ?");
        return $stmt->execute([$orderID]);
    }
}
