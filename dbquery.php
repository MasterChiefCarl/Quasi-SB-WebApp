<?php
require_once 'IDBFuncs.php';
require_once 'DBLibrary.php';

try {
    $dbSource = new PDO('mysql:host=localhost;dbname=usjr','root','');
} catch(PDOException $e) {
    echo $e->getMessage();
}

$db = new DBLibrary($dbSource);


?>

