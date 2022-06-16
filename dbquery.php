<?php


require_once 'php/IDBFuncs.php';
require_once 'php/DBLibrary.php';
require_once 'php/Session.php';
use Sessions\Session;
Session::start();


try {
    $dbSource = new PDO('mysql:host=localhost;dbname=sb', 'root', '');
} catch (PDOException $e) {
    echo $e->getMessage();
}

$db = new DBLibrary($dbSource);

if (isset($_GET['consumables'])) {
    $result = $db->select()->from('consumables')->getAll();
    $jsonResult = json_encode($result);
    echo $jsonResult;
} 

else if (isset($_GET['subconsumables'])) {
    $id = $_GET['subconsumables'];
    $result = $db->select()->from('subconsumables')->where('consID', $id)->getAll();
    $jsonResult = json_encode($result);
    echo $jsonResult;
} 

else if (isset($_GET['products'])) {
    $id = $_GET['products'];
    $result = $db->select()->from('products')->where('subconsID', $id)->getAll();
    $jsonResult = json_encode($result);
    echo $jsonResult;
} 

else if (isset($_GET['itemID'])) {
    $id = $_GET['itemID'];
    $result = $db->select()->from('products')->where('prodID', $id)->get();
    $jsonResult = json_encode($result);
    echo $jsonResult;
}

if(!isset($_SESSION['count']))
$_SESSION['count'] = 0;

$_POST = json_decode(file_get_contents('php://input'), true);
if (!empty($_POST)) {
    $item = $_POST['items'];
    $ordQty = $_POST['ordQty'];

    $db->table('transactions')->insert([$_SESSION['count']+=1 , '500', $item['prodName'], $item['prodPrice'], $ordQty, $item['prodPrice'] * $ordQty, $_SESSION['custName'], null]);
}
