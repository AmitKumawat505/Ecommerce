<head>
    <link rel="stylesheet" href="<?php echo PATH_URL_STYLE . 'cart.css' ?>">
</head>
<?php
$cart_no = 0;
$idx = 0;

if (!empty($cart)) {
    $oID = $cart[0]['Order_detail']['OrderId'];
    $history = array();

    foreach ($cart as $pid => $item) {
        $order = $item['Order_detail'];
        if ($order['OrderId'] != $oID) {
            $idx = 0;
            $oID = $order['OrderId'];
            $cart_no++;
        }
        $history[$cart_no][$idx] = $item;
        $idx++;
    }
}
?>

<form id="cart_form" method="post" action="?url=cart/update/" role="form">

    <div class="col-xs-12">
        <h1>Purchase history</h1>
        <?php if (empty($cart)) : echo ("You don't have any purchase yet!");
        else : ?>

            <br>
            <table class="table ">
                <thead>
                    <tr>
                        <th class="hidden-xs">No</th>
                        <th class="hidden-xs">Image</th>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Color</th>
                        <th>Size</th>
                        <th>Quantity</th>
                        <!-- <th>Subtotal</th> -->
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($history as $oid => $cart) {
                        // print_r($cart);
                        $stt = 0;
                    ?>
                        <th colspan="8">
                            <h3 style="margin: 0;color:red">Order #<?php echo ($oid + 1); ?>: <?php echo number_format($cart[0]['Order']['Cart_total'], 0, ',', '.'); ?> EUR</h3> at <?php echo $cart[0]['Order']['Created_at']; ?>
                            
                        </th>
                        <?php foreach ($cart as $pid => $item) :
                            $stt++;
                            $product = $item['Order_detail'];
                            $order = $item['Order'];
                        ?>
                            <tr id="row-<?php echo $stt; ?>">
                                <td style="width: 5%" class="test" id="id"><?php echo $stt; ?></td>
                                <td style="width: 10%">
                                    <?php
                                    $image = PATH_URL_IMG  . 'product/' . $item['Product']['Image1'];
                                    echo '<image src="' . $image . '" style="max-width:100px; max-height:50px;" />';
                                    ?>
                                </td>
                                <td style="width: 20%">
                                    <a id="product-name" href="?url=product/view/<?php echo $item['Product']['Alias']; ?>"><?php echo $item['Product']['Name']; ?></a>
                                </td>
                                <td style="width: 10%">
                                    <?php echo number_format($product['Price'], 0, ',', '.'); ?>
                                </td>

                                <td style="width: 10%">
                                    <div class="btn-group">
                                        <?php echo $product['Color']; ?>
                                    </div>
                                </td>

                                <td style="width: 10%">
                                    <div class="btn-group">
                                        <?php echo $product['Size']; ?>
                                    </div>
                                </td>

                                <td style="width: 10%">
                                    <div class="btn-group">
                                        <?php echo $product['Quantity']; ?>
                                    </div>
                                </td>

                                <!-- <td style="width: 10%">
                                    <div id="subtotal-<?php echo $stt; ?>" style="color: red">
                                        <?php echo number_format($product['Subtotal'], 0, ',', '.'); ?>
                                    </div>
                                </td> -->

                            </tr>
                    <?php endforeach;
                    } ?>
                </tbody>
            </table>
        <?php endif ?>

        <br>
    </div>
</form>
