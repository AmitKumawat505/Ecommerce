<!DOCTYPE html>
<html>
<head>
    <title>Checkout</title>
</head>
<body>
    <h1>Checkout</h1>
    <form id="checkoutForm">
        <div>
            <label for="address">Address:</label>
            <input type="text" id="address" name="address" required>
        </div>
        <div>
            <label for="phone">Phone:</label>
            <input type="text" id="phone" name="phone" required>
        </div>
        <div>
            <label for="note">Description:</label>
            <textarea id="note" name="description"></textarea>
        </div>
        <div>
            <input type="hidden" name="total" value="<?php echo $_SESSION['cart_total']; ?>">
            <button type="button" onclick="placeOrder()">Make Order</button>
            <button type="button" onclick="testJsonEndpoint()">Test JSON Endpoint</button>
        </div>
    </form>

    <script>
        function testJsonEndpoint() {
            fetch('<?php echo PATH_URL; ?>/order/testJson', {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.text())
            .then(text => {
                console.log('Raw response:', text); // Log the raw response for debugging
                try {
                    const data = JSON.parse(text);
                    if (data.status === 'success') {
                        alert('Test JSON response successful');
                    } else {
                        alert('Error: ' + data.message);
                    }
                } catch (error) {
                    console.error('Error parsing JSON:', error);
                    alert('An unexpected error occurred');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An unexpected error occurred');
            });
        }

        function placeOrder() {
            const form = document.getElementById('checkoutForm');
            const formData = new FormData(form);

            fetch('<?php echo PATH_URL; ?>/cart/placeOrder', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Your order is successfully placed');
                    // Optionally, redirect to another page or clear the form
                } else {
                    alert('Error: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An unexpected error occurred');
            });
        }
    </script>
</body>
</html>
