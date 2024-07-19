<head>
    <link rel="stylesheet" href="<?php echo PATH_URL_STYLE . 'product.css' ?>">
</head>
<?php
json_encode($product);

$highlight_img = isset($_GET['highlight']) ? (int)$_GET['highlight'] : 1;
if ($highlight_img < 1 || $highlight_img > 4) {
    $highlight_img = 1;
}

if ($product) {
    $product["color"] = explode(',', $product['Color']);
    $product["size"] = explode(',', $product['Size']);
    $quantity = isset($product["Quantity"]) ? (int)$product["Quantity"] : 0;
}
?>

<script>
    var quantity = <?php echo $quantity; ?>;

    function closePopup() {
        document.getElementById("popup").style.display = "none";
    }

    window.onclick = function(event) {
        if (event.target == document.getElementById("popup")) {
            closePopup();
        }
    }

    function chooseImg(id) {
        var url = new URL(window.location.href);
        url.searchParams.set('highlight', id);
        window.location.href = url;
    }

    function popUpError(msg) {
        document.getElementById("response").innerHTML = msg;
        var header = document.getElementById("inner-header");
        header.innerHTML = "Add failed";
        header.style.color = "red";
        document.getElementById("popup").style.display = "block";
    }

    function popUpSuccess(msg) {
        document.getElementById("response").innerHTML = msg;
        var header = document.getElementById("inner-header");
        header.innerHTML = "Success";
        header.style.color = "green";
        document.getElementById("popup").style.display = "block";
    }

    function addToCart(event) {
        event.preventDefault();
        var entered_qty = parseInt(document.getElementById('quantity').value);

        if (entered_qty > quantity) {
            popUpError("Your quantity must be less than number of items in stock");
            return;
        }

        var xmlhttp = new XMLHttpRequest();
        xmlhttp.responseType = 'json';
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4) {
                var response = xmlhttp.response;
                if (response.success) {
                    popUpSuccess("Product added to your cart!");
                } else {
                    popUpError(response.message);
                }
            }
        };
        var url = "?url=cart/add/" + <?php echo json_encode($product["Id"]); ?> + "/" + document.getElementById('quantity').value + "&api=1";
        xmlhttp.open("GET", url, true);
        xmlhttp.send();
    }
</script>

<?php if ($product) : ?>
    <div class="product-model">
        <div class="product-info">
            <div class="left-panel">
                <img src="<?php echo PATH_URL_IMG_PRODUCT . $product['Image' . $highlight_img] ?>" id="highlight-img">

                <div class="img-slide">
                    <?php for ($i = 1; $i < 5; $i++) : 
                        if ($i != $highlight_img) {
                            echo '<img src="' . PATH_URL_IMG_PRODUCT . $product['Image' . $i] . '" class="img-responsive" onclick="chooseImg(' . $i . ')">';
                        }
                    endfor; ?>
                </div>
            </div>

            <div class="right-panel">
                <h2 class="item-name"><?php echo $product['Name'] ?></h2>

                <div class="cart-b">
                    <h4>PRODUCT DETAILS</h4>

                    <div class="rating">
                        <?php for ($i = 0; $i < 5; $i++) {
                            echo '<span style="color: #ff8f00;">&#2024;</span>';
                        } ?>
                        <div class="clearfix"></div>
                    </div>

                    <?php if ($product["isSaleOff"]) : ?>
                        <del>
                            <h4 class="del-price">Price: 
                                <?php echo number_format($product['Price'], 2, ',', '.'); ?> €
                            </h4>
                        </del>
                        <span class="custom_price">Sale: 
                            <?php echo number_format(($product['Price'] - ($product['Price'] * $product['Percent_off'] / 100)), 2, ',', '.'); ?> €
                        </span>
                        <br>
                    <?php else : ?>
                        <span class="item_price"><?php echo number_format($product['Price'], 2, ',', '.'); ?> €</span>
                        <span class="custom_price">Price: <?php echo number_format($product['Price'], 2, ',', '.'); ?> €</span>
                        <br>
                    <?php endif ?>

                    <div class="item-detail">
                        <h4>Material Composition:</h4> <?php echo $product['Material'] ?>
                        <form onsubmit="addToCart(event)" name="form">
                            <h4>Color, Size, Items in stock:</h4>
                            <select name="prod" id="prod">
                                <?php foreach ($product['color'] as $index => $color) {
                                    foreach ($product['size'] as $size) {
                                        echo '<option value="' . $index . '">' . $color . ', ' . $size . ': ' . $quantity . ' items</option>';
                                    }
                                } ?>
                            </select>
                            <h4>Quantity:</h4>
                            <input type="number" id="quantity" name="quantity" min="1" max="200" value="1">
                    </div>
                    <button class="btn btn-green" type="submit">ADD TO CART</button>
                    </form>
                </div>
                <h4>Description:</h4>
                <p style="line-height: 1.75;"><?php echo $product['Description']; ?></p>

                <div class="share">
                    <?php
                    $title = urlencode('Title of Your iFrame Tab');
                    $url = urlencode('http://www.facebook.com/yourfanpage');
                    $summary = urlencode('Custom message that summarizes what your tab is about, or just a simple message to tell people to check out your tab.');
                    $image = urlencode('http://www.yourdomain.com/facebookshare/images/customthumbnail.jpg');
                    ?>
                    <h4>Share Product :</h4>
                    <ul class="share_nav">
                        <li>
                            <a onClick="window.open('http://www.facebook.com/sharer.php?s=100&amp;p[title]=<?php echo $title; ?>&amp;p[summary]=<?php echo $summary; ?>&amp;p[url]=<?php echo $url; ?>&amp;&p[images][0]=<?php echo $image; ?>', 'sharer', 'toolbar=0,status=0,width=548,height=325');" target="_parent" href="javascript: void(0)"><img src="<?php echo PATH_URL_IMG . 'logo/facebook.png' ?>" title="Facebook"></a>
                        </li>
                        <li><a href="#"><img src="<?php echo PATH_URL_IMG . 'logo/twitter.png' ?>" title="Twitter"></a></li>
                        <li><a href="#"><img src="<?php echo PATH_URL_IMG . 'logo/google.png' ?>" title="Google"></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
<?php else : echo "Product not found"; ?>
<?php endif ?>
