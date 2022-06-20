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

if(isset($_GET['transaction'])) {
    $result = $db->select(['max(transactionID)'])->from('transactions')->get();
    $jsonResult = json_encode($result);
    echo $jsonResult;
}

if(isset($_GET['itemID'])) {
    $result = $db->select(['max(itemNo)'])->from('transactions')->get();
    $jsonResult = json_encode($result);
    echo $jsonResult;
}

$data = json_decode(file_get_contents('php://input'), true);
$datas = array();
$i = 0; 
if (isset($data['itemData'])) {       

    $data['itemNo'][0] == null ? $itemNo = 1 : $itemNo = (int)$data['itemNo'][0] + 1;
    $data['transID'][0] == null ? $transID = 500 : $transID = (int)$data['transID'][0] + 1;
    $tmpItemNo = $itemNo;
    !Session::has('transID') ? Session::add('transID', $transID) : false;
    $custName = $_SESSION['custName'];

    while($i < count($data['itemData'])) {     
            
            $datas = $data['itemData'][$i];            
            $itemName = (string)$datas['consName'];
            $itemPrice = (int)$datas['consPrice'] + (int)$datas['consSizeAdd'];
            $itemQty = (int)$datas['consQty'];
            $itemTotal = (int)$itemPrice * (int)$itemQty;

            $db->table('transactions')->insert([$tmpItemNo, $transID, $itemName, $itemPrice, $itemQty, $itemTotal, $custName, null]);
        $tmpItemNo++;
        $i++;
    }

    if($i == count($data['itemData']))
        $data = array();
}

if(isset($_GET['beverageSizes'])) {
    $result = $db->select()->from('beverageSizes')->getAll();
    $jsonResult = json_encode($result);
    echo $jsonResult;
}

if(isset($_GET['transID'])) {
    $result = Session::get('transID');
    $jsonResult = json_encode($result);
    echo $jsonResult;
}

if(isset($_GET['trans'])) {
    $transID = $_GET['trans'];
    $result = $db->select(['sum(itemTotal)'])->from('transactions')->where('transactionID', $transID)->get();
    $jsonResult = json_encode($result);
    echo $jsonResult;
}

if(isset($_GET['transData'])) {
    $transID = $_GET['transData'];
    $result = $db->select()->from('transactions')->where('transactionID', $transID)->getAll();
    $jsonResult = json_encode($result);
    echo $jsonResult;
}