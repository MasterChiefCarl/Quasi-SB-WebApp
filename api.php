<?php

require_once 'php/init.php';
require_once 'php/Session.php';

$cart = new Cart();
$data = json_decode(file_get_contents('php://input'), true);

if (isset($data ['items'])) {
    $item = $data ['items'];        
    $ordQty = $data ['ordQty'];
    $itemSizeAdd = $data ['itemSizeAdd'];

    $cart->addToCart($item, $ordQty, $itemSizeAdd);
    // var_dump($cart->getCart());
}

if (isset($data['itemCartID'])) {
    $id = $data['itemCartID'];

    $cart->removeFromCart($id);
}

if(isset($_GET['itemsInCart'])) {
    $result = array();
    $result = $cart->getCart();

    $jsonResult = json_encode($result);
    echo $jsonResult;
}

if(isset($_GET['cartTotalBill'])) {
    $result = $cart->calculateBill();

    $jsonResult = json_encode($result);
    echo $jsonResult;
}

?>