<?php
require_once 'IDBFuncs.php';
require_once 'DBLibrary.php';
require_once 'init.php';

use Sessions\Session;
Session::start();

try {
    $dbSourceP = new PDO('mysql:host=localhost;dbname=products','root','');
    $dbSourceO = new PDO('mysql:host=localhost;dbname=orders', 'root','');
} catch(PDOException $e) {
    echo $e->getMessage();
}

$dbProducts = new DBLibrary($dbSourceP);
$dbOrders = new DBLibrary($dbSourceO);


?>

