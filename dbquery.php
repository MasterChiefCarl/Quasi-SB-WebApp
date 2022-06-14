<?php
require_once 'IDBFuncs.php';
require_once 'DBLibrary.php';
require_once 'init.php';

use Sessions\Session;
Session::start();

try {
    $dbSource = new PDO('mysql:host=localhost;dbname=usjr','root','');
} catch(PDOException $e) {
    echo $e->getMessage();
}

$db = new DBLibrary($dbSource);


?>

