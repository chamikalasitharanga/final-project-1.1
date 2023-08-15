<!DOCTYPE html>
<html>
<head>
    <title>Order Confirmation</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2>Your order is in process</h2>
    <?php
    session_start();
    if (isset($_SESSION['myCart']) && !empty($_SESSION['myCart'])) {
        echo '<h4>Your order details:</h4>';
        echo '<ul>';
        foreach ($_SESSION['myCart'] as $key => $value) {
            echo '<li>' . $value['itemqty'] . ' x ' . $value['fname'] . ' -price: ' . $value['price'] . '</li>';
        }
        echo '</ul>';
        echo '<h4>Customer Information:</h4>';
        echo '<p>Name: ' . $_POST['name'] . '</p>';
        echo '<p>Phone: ' . $_POST['phone'] . '</p>';
        echo '<p>Pickup Time: ' . $_POST['pickupTime'] . '</p>';
    } else {
        echo '<p>Your cart is empty. Please go back and order.</p>';
    }
    ?>
    <a href="category.php" class="btn btn-primary mt-3">Back to Menu</a>
</div>
</body>
</html>
