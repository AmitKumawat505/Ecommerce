<head>
    <link rel="stylesheet" href="<?php echo PATH_URL_STYLE . 'cart.css' ?>">
</head>
<form id="cart_form" method="post" action="?url=cart/update/" role="form" onsubmit="return false;">
    <div class="col-xs-12">
        <h1>Your cart</h1>
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
                    <th>Subtotal</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $stt = 0;
                foreach ($cart as $pid => $product) :
                    $stt++;
                ?>
                    <tr id="row-<?php echo $stt; ?>">
                        <td style="width: 5%" class="test" id="id"><?php echo $stt; ?></td>
                        <td style="width: 10%">
                            <?php
                            $image = 'public/images/product/' . $product['image'];
                            if (is_file($image)) {
                                echo '<img src="' . $image . '" style="max-width:100px; max-height:50px;" />';
                            }
                            ?>
                        </td>
                        <td style="width: 20%">
                            <a id="product-name" href="?url=product/view/<?php echo $product['alias']; ?>"><?php echo $product['name']; ?></a>
                        </td>
                        <td style="width: 10%" id="price-<?php echo $stt; ?>">
                            <?php if ($product["percent_off"]) : ?>
                                <?php echo number_format((float)$product['price'] - (float)$product['price'] * (float)$product['percent_off'] / 100, 2, ',', '.'); ?> €
                            <?php else : ?>
                                <?php echo number_format((float)$product['price'], 2, ',', '.'); ?> €
                            <?php endif ?>
                        </td>

                        <td style="width: 10%">
                            <div class="btn-group">
                                <?php echo $product['color']; ?>
                            </div>
                        </td>

                        <td style="width: 10%">
                            <div class="btn-group">
                                <?php echo $product['size']; ?>
                            </div>
                        </td>

                        <td style="width: 10%">
                            <div class="btn-group">
                                <input name="number[<?php echo $pid; ?>]" type="number" min="1" max="<?php echo ($product['max']) ?>" onchange="calculate(this,<?php echo $stt; ?>)" value="<?php echo $product['number']; ?>" size="3" class="form-control text-center" />
                            </div>
                        </td>

                        <td style="width: 10%">
                            <div id="subtotal-<?php echo $stt; ?>" style="color: red">
                                <?php if ($product["percent_off"]) : ?>
                                    <?php echo number_format(((float)$product['price'] - ((float)$product['price'] * (float)$product['percent_off']) / 100) * (float)$product['number'], 2, ',', '.'); ?> €
                                <?php else : ?>
                                    <?php echo number_format((float)$product['price'] * (float)$product['number'], 2, ',', '.'); ?> €
                                <?php endif ?>
                            </div>
                        </td>

                        <td>
                            <a class="delete" onclick="deleteP(this)">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="8" id="total">Total: <span id="total-number"><?php echo number_format((float)$total, 2, ',', '.'); ?></span> €</td>
                </tr>
            </tfoot>
        </table>
        <br>
        <div class="form-group">
            <div class="btn-group">
                <button type="button" class="update-btn disable" disabled onclick="updateCart()">Update cart</button>
            </div>
        </div>
    </div>
</form>
<div>
    <form method="post" action="?url=cart/checkout" role="form" id="checkout-form">
        <h3>Delivery Information:</h3>
        <div>
            <label for="address">Address <b style="color: red;">*</b></label>
            <input type="text" name="address" maxlength="200" required>
        </div>
        <div>
            <label for="pn">Phone number <b style="color: red;">*</b></label>
            <input type="text" name="pn" maxlength="10" required>
        </div>
        <div>
            <label for="des">Note</label>
            <input type="text" name="des" maxlength="200">
        </div>
        <div class="message"><?php if (!empty($message)) echo $message; ?></div>
        <div>
            <input type="submit" class="form-control" style="background-color: #04AA6D;color: white;" value="Make Order" />
        </div>
    </form>
</div>
<script>
    let length = <?php echo $stt; ?>;
    let is_change = false;
    let total = 0;
    let totalElement = document.querySelector("#total-number");

    document.querySelector("#checkout-form").addEventListener("submit", function(e) {
        let mobile = document.querySelector('input[name=pn]').value;
        let messagedov = document.querySelector('.message');
        if (mobile !== '') {
            if (!vnf_regex.test(mobile)) {
                e.preventDefault();
                messagedov.textContent = "Invalid Phone Number";
            }
        } else {
            e.preventDefault();
            messagedov.textContent = "Invalid Phone Number";
        }
    });

    function stringMoney(value) {
        return value.toFixed(2).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".").replace('.', ',');
    }

    function getMoney(value) {
        return parseFloat(value.replace(/\./g, '').replace(',', '.').replace(' €', ''));
    }

    let calculate = (ele, stt) => {
        let value = Number(ele.value);
        let max = Number(ele.max);
        if (value < 1) {
            popUpError("Product quantity must be greater than 0");
        } else if (value > max) {
            popUpError(`Product only has ${max} in stock`);
            ele.value = max;
        } else {
            let price = getMoney(document.querySelector(`#price-${stt}`).textContent);
            let subtotal = value * price;
            document.querySelector(`#subtotal-${stt}`).textContent = stringMoney(subtotal) + " €";
            updateTotal();
            activeEle();
        }
    }

    let updateTotal = () => {
        let total = 0;
        document.querySelectorAll('[id^="subtotal-"]').forEach(element => {
            total += getMoney(element.innerText);
        });
        totalElement.innerText = stringMoney(total) + " €";
    }

    let activeEle = () => {
        let updateButton = document.querySelector(".update-btn");
        updateButton.disabled = false;
        is_change = true;
        updateButton.className = "update-btn";
    }

    let deactiveEle = () => {
        let updateButton = document.querySelector(".update-btn");
        updateButton.disabled = true;
        is_change = false;
        updateButton.className = "update-btn disable";
    }

    function updateCart(e) {
        var url = "?url=cart/update&api=1";
        let form = document.forms[0].elements;
        let body = "";
        for (let i = 0; i < form.length - 1; i++) {
            body += form[i]['name'] + "=" + encodeURIComponent(form[i]['value']);
            if (i < form.length - 2) {
                body += "&";
            }
        }
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.responseType = 'json';
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4) {
                response = xmlhttp.response;
                if (response.success) {
                    document.getElementById("response").innerHTML = "Cart Updated!";
                    var header = document.getElementById("inner-header");
                    header.innerHTML = "Success";
                    header.style.color = "green";
                } else {
                    document.getElementById("response").innerHTML = response.message;
                    var header = document.getElementById("inner-header");
                    header.innerHTML = "Update failed";
                    header.style.color = "red";
                }
                var popup = document.getElementById("popup");
                popup.style.display = "block";
            }
        };
        xmlhttp.open('POST', url, true);
        xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xmlhttp.send(body);
        deactiveEle();
    }

    let deleteP = (ele) => {
        activeEle();
        is_change = true;
        let targetEle = ele.parentElement.parentElement;
        targetEle.style.display = "none";
        targetEle.children[targetEle.children.length - 3].firstElementChild.firstElementChild.value = "-1";
        let stt = Number(targetEle.id.replace("row-", ""));
        targetEle.id = "";
        for (let i = stt + 1; i <= length; i++) {
            let ele = document.querySelector(`#row-${i}`);
            ele.children[0].textContent = (i - 1).toString();
            ele.id = "row-" + (i - 1).toString();
        }
        let newprice = targetEle.children[targetEle.children.length - 2].textContent;
        total -= getMoney(newprice);
        length -= 1;
        totalElement.textContent = stringMoney(total) + " €";
    }

    function popUpError(msg) {
        document.getElementById("response").innerHTML = msg;
        var header = document.getElementById("inner-header");
        header.innerHTML = "Error";
        header.style.color = "red";
        var popup = document.getElementById("popup");
        popup.style.display = "block";
    }

    document.addEventListener("DOMContentLoaded", () => {
        updateTotal();
    });
</script>
