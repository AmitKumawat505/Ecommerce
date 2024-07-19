<?php

class ProductController extends BaseController
{
    private $product_model;

    public function __construct($model = 'Product', $controller = 'product', $action = 'view', $api = false)
    {
        parent::__construct($model, $controller, $action, $api);
        $this->product_model = $this->Product;
    }

    public function viewall()
    {
        if (isset($_GET['id'])) {
            $pid = intval($_GET['id']);
            $product = $this->product_model->select($pid);
        } else {
            $product = $this->product_model->selectAll();
        }
        if (!$product) {
            show_404();
        } else {
            $this->set('productList', $product);
        }
    }

    function view($alias)
    {
        if (!empty($alias)) {
            $product = $this->product_model->get_one($alias);
            $product ? $this->set("product", $product['Product']) : $this->set("product", null);
        } else {
            $this->set("product", null);
        }

        
        $this->set("product_model", $this->product_model);
    }
}
?>
