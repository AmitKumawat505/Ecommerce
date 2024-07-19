<script>
    var isFilter = false;

    function getHTTPObject() {
        if (window.ActiveXObject) {
            return new ActiveXObject("Microsoft.XMLHTTP");
        } else if (window.XMLHttpRequest) {
            return new XMLHttpRequest();
        } else {
            alert("Your browser does not support AJAX.");
            return null;
        }
    }
    direct = (id) => {
        window.location = " ?url=product/view/" + id;
    }
    filter = (event) => {
        event.preventDefault();
        var priceFrom = document.getElementById("priceFrom").value;
        var priceTo = document.getElementById("priceTo").value;
        var orderby = document.getElementById("order").value;
        var categoryId = <?php echo $categoryId ?>;

        if (categoryId != 3) console.log(categoryId);
        var subCategoryId = "";
        if (categoryId != 3) subCategoryId = <?php echo $subCategoryId ?>;
        var url = "http://localhost/web-programming-e-commerce/?url=filter/filter/" + categoryId + "/" + subCategoryId + "/";

        if (priceFrom) url = url + "/" + priceFrom;
        else url = url + "/"
        if (priceTo) url = url + "/" + priceTo;
        else url = url + "/";
        if (orderby) url = url + "/" + orderby;
        url = url + "&api=1";
        var http = new XMLHttpRequest();
        httpObject = getHTTPObject();
        if (httpObject != null) {
            //httpObject.open('POST', url, true);
            httpObject.open("GET", url, true);
            //httpObject.send(data);
            httpObject.send(null);
            httpObject.onreadystatechange = function() { //Call a function when the state changes.
                if (httpObject.readyState == 4 && httpObject.status == 200) {

                    document.getElementById("listProduct").innerHTML = this.responseText;

                }
            }


        }
    }
</script>

<head>
    <link rel="stylesheet" href="<?php echo PATH_URL_STYLE . 'category.css' ?>">
</head>
<div>
    <?php if (sizeof($products) > 0) : ?>
        <div class="filter ">
            Price:
            <input placeholder="From--" type='text' id="priceFrom"></input>
            <input placeholder="To--" id="priceTo"></input>
            <select name="order" id="order">
                <option value="0"> High to Low</option>
                <option value="1"> Low to High</option>
            </select>
            <button onclick="filter(event)" class="submit">Submit</button>

        </div>
        <div class="content-product">
            <div class="inline-row" id="listProduct">

                <?php

                foreach ($products as $item) {
                    // Ensure price is numeric
                    $price = isset($item['Product']['Price']) ? floatval($item['Product']['Price']) : 0;
                    $percentOff = isset($item['Product']['Percent_off']) ? floatval($item['Product']['Percent_off']) : 0;
                    $isSaleOff = isset($item['Product']['isSaleOff']) ? boolval($item['Product']['isSaleOff']) : false;
                ?>
                    <div class="product">
                        <div class="item" onclick='direct("<?php echo $item["Product"]["Alias"]; ?>")'>
                            <img src="<?php echo PATH_URL_IMG_PRODUCT . (isset($item['Product']['Image1']) ? $item['Product']['Image1'] : 'default.jpg') ?>" alt="product" height=250 width=250 />
                            <p class="item-name"><?php echo isset($item['Product']['Name']) ? $item['Product']['Name'] : 'No Name'; ?> </p>
                            <?php if ($isSaleOff) : ?>
                                <div class="inline-price">
                                    <del class="price">
                                        <span class="del-price">
                                            <?php echo number_format($price, 2, ',', '.'); ?> €
                                        </span>
                                    </del>
                                    <div> <span class="custom_price color-red">
                                            <?php echo number_format($price - ($price * $percentOff / 100), 2, ',', '.'); ?> €
                                        </span></div>
                                </div>
                            <?php else : ?>
                                <div style="text-align:center;"> <span class="custom_price color-red"> 
                                    <?php echo number_format($price, 2, ',', '.'); ?> €
                                </span></div>

                            <?php endif ?>
                        </div>
                    </div>
                <?php

                }

                ?>


            </div>
        <?php else : ?>
            <div style="text-align:center;height:30vh;font-size:20px;"> No product found</div>
        <?php endif ?>
        </div>
</div>
