<!DOCTYPE html>
<html>
<head>
    <title>Order Summary</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2>Your Order Summary</h2>
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Food Item</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Subtotal</th>
                
            </tr>
        </thead>
        <tbody>
            <?php
            session_start();
            $total = 0;
            if (isset($_SESSION['myCart']) && !empty($_SESSION['myCart'])) {
                foreach ($_SESSION['myCart'] as $key => $value) {
                    $subtotal = $value['price'] * $value['itemqty'];
                    $total += $subtotal;
            ?>
                    <tr>
                        <td><?php echo $key + 1; ?></td>
                        <td><?php echo $value['fname']; ?></td>
                        <td><?php echo $value['price']; ?></td>
                        <td><?php echo $value['itemqty']; ?></td>
                        <td><?php echo $subtotal; ?></td>
                        <td>
                            <form action="cart.php" method="post">
                                <input type="hidden" name="fname" value="<?php echo $value['fname']; ?>">
                                <button type="submit" class="btn btn-link text-danger" name="remove" style="border: none; background: none;">
                                    <i class="fa-regular fa-trash-alt"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
            <?php
                }
            } else {
                echo '<tr><td colspan="6">Your cart is empty.</td></tr>';
            }
            ?>
        </tbody>
    </table>

    <div class="text-right">
        <p><b>Grand Total: <?php echo $total; ?></b></p>
        <?php
        if ($total > 0) {
            echo '<a href="checkout.php" class="btn btn-primary"><i class="fa-solid fa-credit-card"></i>&nbsp;&nbsp;Checkout</a>';
        } else {
            echo '<button class="btn btn-primary" disabled><i class="fa-solid fa-credit-card"></i>&nbsp;&nbsp;Checkout</button>';
        }
        ?>
        <!-- <a href="category.php" class="btn btn-success"><i class="fa-sharp fa-solid fa-cart-plus"></i>&nbsp;&nbsp;Continue Shopping</a> -->
    </div>
</div>
</body>
</html>
