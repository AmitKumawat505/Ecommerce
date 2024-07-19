<?php
class CartController extends BaseController
{
    function add($id, $color, $size, $quantity)
    {
        $data = new Message();
        if ($id != null) {
            $data->success = $this->Cart->cart_add($id, $color, $size, $quantity);
            $data->message = $data->success ? "Successfully added" : "Invalid Product Id";
        }
        $this->set("message", $data->getMesage());
    }

    function view()
    {
        $productModel = new Product();
        $cart = $_SESSION['cart'];
        foreach ($cart as $id => $product) {
            $cart[$id]['max'] = $productModel->get_quantity($product['id'], $product['color'], $product['size']);
           
            $cart[$id]['formatted_price'] = $this->formatCurrency($product['price']);
        }
       
        $total = $this->Cart->cart_total();
        $formattedTotal = $this->formatCurrency($total);

        $this->set("cart", $cart);
        $this->set("total", $formattedTotal);
    }

    function update()
    {
        $data = new Message(true);
        if (!empty($_POST)) {
            foreach ($_POST['number'] as $pid => $number) {
                if (intval($number) > 0)
                    $data->success &= $this->Cart->cart_update($pid, $number);
                else {
                    $data->success &= $this->Cart->cart_delete($pid);
                }
            }
        } else {
            $this->Cart->cart_destroy();
        }
        $this->set("message", $data->getMesage());
    }

    function clear()
    {
        $this->Cart->cart_destroy();
    }

    function delete($id = NULL)
    {
        $data = new Message();
        if ($id != null) {
            $data->success = $this->Cart->cart_delete($id);
        }
    }

    function checkout()
{
    if (isset($_SESSION['username']) && !empty($_SESSION['username'])) {
        $pattern = "/((09|03|07|08|05)+([0-9]{8})\b)/";
        $address = $_POST['address'];
        $phone = $_POST['pn'];
        $des = $_POST['des'] or "";
        if (strlen($address) > 200) {
            $this->set("message", "Invalid length Address");
            return;
        }
        if (strlen($des) > 500) {
            $this->set("message", "Invalid length Description");
            return;
        }
        // add to DB
        if ($_SESSION['cart'] != array()) {
            $orderModel = new Orders();
            $productModel = new Product();
            $isValid = $productModel->checkCart();
            // add to order and order detail.
            if ($isValid == "") {
                $orderModel->insert_one($address, $phone, $des, $this->Cart->cart_total());
                $result = intval($orderModel->getInserted()['id']);
                if ($result > 0) {
                    foreach ($_SESSION['cart'] as $item) {
                        $orderModel->insert_detail($item, $result);
                        $productModel->update_quantity($item);
                    }
                    // Update to db 
                    $this->clear();
                    // Ensure the redirection URL is correct
                    header("Location: ?url=cart/history");
                    exit();
                } else {
                    $this->set("message", $orderModel->getError());
                }
            } else {
                $this->set("message", $isValid);
            }
        } else {
            $this->set("message", "Empty Cart");
            redirect("cart", "view");
        }
    } else {
        $this->set("message", "You must login first");
        redirect("user", "login");
    }
}

    function history()
    {
        // get username in session
        $username = '';
        if (isset($_SESSION['username']) && !empty($_SESSION['username']))
            $username = $_SESSION['username'];
        $order = new Orders();
        $cart_history = $order->get_history($username);

        $this->set("cart", $cart_history);
    }

    function placeOrder() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $address = $_POST['address'];
            $phone = $_POST['phone'];
            $note = $_POST['description'];

           
            $this->checkout();
        }
    }

    private function formatCurrency($amount)
    {
        return '€' . number_format($amount, 2);
    }
}
