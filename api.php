<?php

require_once 'php/init.php';
require_once 'php/Session.php';

$cart = new Cart();
$_POST = json_decode(file_get_contents('php://input'), true);

if (!empty($_POST)) {
    $item = $_POST['items'];        
    $ordQty = $_POST['ordQty'];
    // echo $item['consID'];
    // echo $ordQty;
    $cart->addToCart($item, $ordQty);
    var_dump($_SESSION['cart']);
}

?>