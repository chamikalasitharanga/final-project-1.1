<!DOCTYPE html>
<html>
<head>
    <title>Checkout</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2>Checkout</h2>
    <form method="post" action="order_confirmation.php">
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="phone">Phone:</label>
            <input type="tel" class="form-control" id="phone" name="phone" required>
        </div>
        <div class="form-group">
            <label for="pickupTime">Pickup Time:</label>
            <input type="datetime-local" class="form-control" id="pickupTime" name="pickupTime" required>
        </div>
        <h3>Items in Your Cart:</h3>
        <ul>
            <?php
            $total = 0;
            session_start();
            if (isset($_SESSION['myCart']) && !empty($_SESSION['myCart'])) {
                foreach ($_SESSION['myCart'] as $key => $value) {
                    
                    echo '<li>' . $value['itemqty'] . ' x ' . $value['fname'] . ' - ' . $value['price'] . '</li>';
                    $total = $total+$value['price'];
                }

                echo"<h3>Total Bill: </h3><li>$total</li>";
            } else {
                echo '<li>Your cart is empty.</li>';
            }
            ?>
        </ul>
        <button type="submit" class="btn btn-primary">Place Order</button>
    </form>
    <a href="order.php" class="btn btn-secondary mt-3">Back to Order Summary</a>
</div>
</body>
</html>

