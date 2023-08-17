<?php

include_once('../goid-html/config/connection.php');

session_start();

if (isset($_SESSION['myCart']) && !empty($_SESSION['myCart'])) {
    
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    
    $total = 0;
    foreach ($_SESSION['myCart'] as $key => $value) {
        $total += $value['price'] * $value['itemqty'];
    }

    
    $insertOrderQuery = "INSERT INTO orders (customer_name, customer_phone, order_total) VALUES ('$name', '$phone', '$total')";
    mysqli_query($con, $insertOrderQuery);

    
    $orderId = mysqli_insert_id($con);

   
    foreach ($_SESSION['myCart'] as $key => $value) {
        $itemName = $value['fname'];
        $itemQty = $value['itemqty'];
        $itemPrice = $value['price'];
        $subtotal = $itemQty * $itemPrice;

        $insertItemQuery = "INSERT INTO order_items (order_id, item_name, item_quantity, item_price, subtotal) VALUES ('$orderId', '$itemName', '$itemQty', '$itemPrice', '$subtotal')";
        mysqli_query($con, $insertItemQuery);
    }

    
    $_SESSION['myCart'] = array();

    echo "Order placed successfully!";
} else {
    echo "Your cart is empty. Please go back and order.";
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Order</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2>Your Order</h2>
    <?php
        $getOrderQuery = "SELECT * FROM orders WHERE order_id = '$orderId'";
        $result = mysqli_query($con, $getOrderQuery);
        $order = mysqli_fetch_assoc($result);

        echo '<h4>Order Details:</h4>';
        echo '<p>Order ID: ' . $order['order_id'] . '</p>';
        echo '<p>Customer Name: ' . $order['customer_name'] . '</p>';
        echo '<p>Customer Phone: ' . $order['customer_phone'] . '</p>';
        echo '<p>Order ID: ' . $order['order_total'] . '</p>';
    ?>
    <a href="category.php" class="btn btn-primary mt-3">Back to Menu</a>
</div>
</body>
</html>
