<?php

require_once 'php/init.php';
require_once 'php/Session.php';

$cart = new Cart();
$_POST = json_decode(file_get_contents('php://input'), true);

if (!empty($_POST)) {
    $item = $_POST['items'];        
    $ordQty = $_POST['ordQty'];
    $itemSizeAdd = $_POST['itemSizeAdd'];

    $cart->addToCart($item, $ordQty, $itemSizeAdd);
    var_dump($cart->getCart());
}

?>