<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'BaseController.php'; 
require_once 'application/models/Orders.php';
require_once 'application/models/Product.php'; 

class OrderController extends BaseController {
    public function __construct($action, $api = false) {
        parent::__construct('Orders', 'Order', $action, $api);
    }

    public function placeOrder() {
        header('Content-Type: application/json');

        try {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $address = $_POST['address'] ?? '';
            $phone = $_POST['phone'] ?? '';
            $description = $_POST['description'] ?? '';
            $total = $_POST['total'] ?? '';
            $cart = $_SESSION['cart']; 

            if (empty($address) || empty($phone) || empty($total) || empty($cart)) {
                throw new Exception('Missing required fields or empty cart');
            }

          
            $orderId = $this->Orders->insertOrder($address, $phone, $description, $total);

            
            foreach ($cart as $item) {
                $productId = $item['product_id'];
                $quantity = $item['quantity'];
                $this->Product->decrementStock($productId, $quantity);
            }

            
            unset($_SESSION['cart']);

            echo json_encode(['success' => true, 'message' => 'Your order is successfully placed']);
        } else {
            throw new Exception('Invalid request method');
        }
    } catch (Exception $e) {
        echo json_encode(['error' => $e->getMessage()]);
    }
    }

    public function testJson() {
        header('Content-Type: application/json'); 
        echo json_encode(["status" => "success", "message" => "Test JSON response"]);
    }
}
?>
