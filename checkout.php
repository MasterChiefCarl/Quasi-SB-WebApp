<?php

declare(strict_types=1);
require_once 'php/init.php';
require_once 'php/Session.php';

use Sessions\Session;

$ordercode = rand(100, 1000);
$customer = new Customer();
$cart = new Cart();

if (session_status() === PHP_SESSION_NONE) {
    Session::start();
}

if ($_GET) {
    if (isset($_GET['checkout'])) {
        echo ("<script LANGUAGE='JavaScript'>
        window.alert('Order has been sent. Please proceed to cashier with Order#" . $_GET['checkout'] . ". Returning To Home.');
        window.location.href='index.php?return=true';
        </script>");
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Review Order</title>
    <link rel="stylesheet" href="css/styles.css" />
    <link rel="stylesheet" href="css/animations.css" />
    <link rel="shortcut icon" type="image/x-icon" href="assets/logo/starbucks.png" />
</head>

<body>
    <div class="default-layout-body">
        <div class="nav">
            <div class="nav-body">
                <a href="index.php?return=true"><img class="supersmol" src="assets/logo/starbucks.png"></a>
                <h3 style="margin:0px;">Checking Out <?php echo $customer->getCustName(); ?>'s Order</h3>
                <a href="select.php?"><img class="supersmol" src="assets/images/back.png" "></a>
            </div>
        </div>
        <div class=" content">
                    <div class="content-body">

                        <center>
                            <?php
                            if (Session::has('cart') && !empty(Session::get('cart'))) {
                            ?>
                                <div class="dialogue-box-alt-wide" id="cart">
                                    <table id="cartTable" style="background-color:white; color: black; border-radius: 10px;">
                                        <tr>
                                            <td colspan="6" style="margin:20px;">
                                                <center>
                                                    <br><br>
                                                    <img class="smoller" src="assets/logo/starbucks.png">
                                                    <h2 style="color:black;  filter: none;">Starbucks Inc.</h2>
                                                    <h5 style="color:black;  filter: none;">Customer Name: <?php echo $customer->getCustName() . '<br>Order No.' . $ordercode; ?> </h5>
                                                </center>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td class="tableLabel">Item Name</td>
                                            <td class="tableLabel">Qty</td>
                                            <td class="tableLabel">Size Additional</td>
                                            <td class="tableLabel">Total</td>
                                            <td></td>

                                        </tr>
                                        <?php

                                        $cartItems = $cart->getCart();

                                        foreach ($cartItems as $cartRow => $cartCol) {
                                            echo '<tr>';
                                            echo '<td></td>';
                                            echo '<td class="tableValue">' . $cartCol['consName'] . '</td>';
                                            echo '<td class="tableValue">' . $cartCol['consQty'] . '</td>';
                                            echo '<td class="tableValue">' . $cartCol['consSizeAdd'] . '</td>';
                                            echo '<td class="tableValue">' . '₱ ' . ($cartCol['consPrice'] + $cartCol['consSizeAdd']) * $cartCol['consQty'] . '.00' . '</td>';
                                            echo '<td></td>';
                                            echo '</tr>';
                                        }
                                        echo '<tr>';
                                        echo '<td colspan="4" align="right" style="border-top: 2px solid black;">' . 'Total Bill' . '</td>';
                                        echo '<td class="tableValue" style="border-top: 2px solid black;">' . $cart->calculateBill() . '</td>';
                                        echo '</tr>';

                                        echo '<tr>';


                                        ?>
                                    </table>
                                    <br><br>
                                    <a href="select.php?" id="checkoutBtn">Add Additional Orders</a>
                                    <br><br>
                                    <a href="checkout.php?checkout=<?php echo $ordercode; ?>" id="checkoutBtn">Checkout</a>
                                </div>

                            <?php
                            }
                            ?>
                        </center>

                    </div>
            </div>

            <div class="footer">
                <div class="footer-body">
                    <h3>Made with 💖 by Group 1 Jungco, Lapiz, Garces</h3>
                </div>
            </div>
        </div>
</body>

</html>