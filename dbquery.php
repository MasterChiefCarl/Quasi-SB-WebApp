<?php
require_once 'IDBFuncs.php';
require_once 'DBLibrary.php';

try {
    $dbSource = new PDO('mysql:host=localhost;dbname=sb','root','');
} catch(PDOException $e) {
    echo $e->getMessage();
}

$db = new DBLibrary($dbSource);

if(isset($_GET['consumables'])) {
    $result = $db->select()->from('consumables')->getAll();
    $jsonResult = json_encode($result);
    echo $jsonResult;
}

else if(isset($_GET['subconsumables'])) {
    $id = $_GET['subconsumables'];
    $result = $db->select()->from('subconsumables')->where('consID', $id)->getAll();
    $jsonResult = json_encode($result);
    echo $jsonResult;
}

else if(isset($_GET['products'])) {
    $id = $_GET['products'];
    $result = $db->select()->from('products')->where('subconsID', $id)->getAll();
    $jsonResult = json_encode($result);
    echo $jsonResult;
}