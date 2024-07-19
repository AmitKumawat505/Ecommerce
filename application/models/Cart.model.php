<?php
class Cart extends Model
{
    function __construct()
    {
        if (!isset($_SESSION['cart'])) $_SESSION['cart'] = array();
    }
    function cart_add($pid, $color, $size, $quantity)
    {
        $jstr = $pid . '-' . $color . '-' . $size;
        if (
            isset($_SESSION['cart'][$jstr])
        ) {
            
            $_SESSION['cart'][$jstr]['number'] += $quantity;
        } else {
            $productModel = new Product();
            $product  = $productModel->select($jstr);
            if ($product)
                $_SESSION['cart'][$jstr] = array(
                    'id' => $pid,
                    'name' => $product['Product']['Name'],
                    'image' => $product['Product']['Image1'],
                    'number' => $quantity,
                    'size' => $size,
                    'color' => $color,
                    'percent_off' => $product['Product']['Percent_off'],
                    'price' => $product['Product']['Price'],
                    'alias' => $product['Product']['Alias']
                );
            else
                return false;
        }
        return true;
    }
    function cart_update($pid, $number)
    {
        try {
            if ($number == 0) {
                unset($_SESSION['cart'][$pid]);
            } else {
                $_SESSION['cart'][$pid]['number'] = $number;
            }
            return true;
        } catch (Exception $e) {
            return false;
        }
    }
    function cart_delete($pid)
    {
        if ($pid && isset($_SESSION['cart'][$pid])) {
            unset($_SESSION['cart'][$pid]);
            return true;
        }
        return false;
    }

    function cart_total()
    {
        $total = 0;
        foreach ($_SESSION['cart'] as $product) {
            if ($product["percent_off"]) {
                $total += (($product['price']) - ($product['price']) * ($product['percent_off']) / 100) * $product['number'];
            } else
                $total += $product['price'] * $product['number'];
        }
        return $total;
    }
    function cart_number()
    {
        $number = 0;
        foreach ($_SESSION['cart'] as $product) {
            $number += $product['number'];
        }
        return $number;
    }
    function cart_destroy()
    {
        $_SESSION['cart'] = array();
    }

}
