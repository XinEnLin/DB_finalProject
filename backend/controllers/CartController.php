<?php
require_once(__DIR__ . '/../models/Cart.php');
require_once(__DIR__ . '/../models/Order.php');
require_once(__DIR__ . '/../models/OrderItem.php');

class CartController {
    private $cart;

    public function __construct($conn) {
        $this->cart = new Cart($conn);
    }

    public function add($userID, $data) {
        $productID = $data['productID'];
        $quantity = (int) $data['quantity'];
        $this->cart->AddCart($userID, $productID, $quantity);
        echo json_encode(['success' => true, 'message' => '商品已加入購物車']);
    }

    public function remove($userID, $productID) {
        $this->cart->RemoveCart($userID, $productID);
        echo json_encode(['success' => true, 'message' => '商品已移除']);
    }

    public function updateQuantities($userID, $quantities) {
        foreach ($quantities as $pid => $qty) {
            $this->cart->updateQuantity($userID, $pid, $qty);
        }
        echo json_encode(['success' => true, 'message' => '數量已更新']);
    }

    public function clear($userID) {
        $this->cart->clear($userID);
        echo json_encode(['success' => true, 'message' => '購物車已清空']);
    }

    public function checkout($userID) {
        $orderID = $this->cart->checkout($userID);
        if ($orderID) {
            echo json_encode([
                'success' => true,
                'message' => '✅ 結帳成功，訂單已建立',
                'orderID' => $orderID
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => '❌ 結帳失敗，購物車為空'
            ]);
        }
    }

    public function getItems($userID) {
        $items = $this->cart->getAll($userID);
        echo json_encode($items);
    }

    public function getTotal($userID) {
        $total = $this->cart->getTotal($userID);
        echo json_encode(['total' => $total]);
    }
}
