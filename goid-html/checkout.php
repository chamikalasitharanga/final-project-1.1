<!DOCTYPE html>
<html>
<head>
    <title>Checkout</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .checkout-container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f7f7f7;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .cart-list {
            list-style-type: none;
            padding: 0;
        }
        .cart-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 8px 0;
            border-bottom: 1px solid #ddd;
        }
        .total-bill {
            font-size: 18px;
            font-weight: bold;
            margin-top: 10px;
        }
        .empty-cart {
            color: red;
        }
    </style>
</head>
<body>
<div class="container mt-5 checkout-container">
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
        <!-- <div class="form-group">
            <label for="pickupTime">Pickup Time:</label>
            <input type="datetime-local" class="form-control" id="pickupTime" name="pickupTime" required>
        </div> -->
        <h3>Items in Your Cart:</h3>
        <ul class="cart-list">
            <?php
            $total = 0;
            session_start();
            if (isset($_SESSION['myCart']) && !empty($_SESSION['myCart'])) {
                foreach ($_SESSION['myCart'] as $key => $value) {
                    
                    echo '<li class="cart-item">' . $value['itemqty'] . ' x ' . $value['fname'] . ' - ' . $value['price'] . '</li>';
                    $total = $total+$value['price'];
                }

                echo "<li class='total-bill'>Total Bill: $total</li>";
            } else {
                echo '<li class="empty-cart">Your cart is empty.</li>';
            }
            ?>
        </ul>
        <button type="submit" class="btn btn-primary">Place Order</button>
    </form>
    <a href="order.php" class="btn btn-secondary mt-3">Back to Order Summary</a>
</div>
</body>
</html>

