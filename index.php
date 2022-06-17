<?php

declare(strict_types=1);
require_once 'php/init.php';
require_once 'php/Session.php';

use Sessions\Session;
$customer = new Customer();

if (!$_REQUEST && session_id() != '') {
  Session::stop();
  //last session destroyer!
}


if (session_status() === PHP_SESSION_NONE) {
  Session::start();
}

if ($_REQUEST && $_REQUEST["custName"] != null) {
  $customer->setCustName($_POST['custName']);

  // Session::add('custName', $_REQUEST["custName"]);
  if (Session::has('custName')) {
    header("location:select.php");
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <title>QSASI-STARBUCKS POS</title>

  <!-- Stylesheets, Logo ref -->
  <link rel="stylesheet" href="css/styles.css" />
  <link rel="stylesheet" href="css/animations.css" />
  <link rel="shortcut icon" type="image/x-icon" href="assets/logo/starbucks.png" />
  
</head>

<body>
  <div class="default-layout-body">
    <div class="nav">
      <div class="nav-body"><h3>Welcome To Starbucks</h3></div>
    </div>
    <div class="content">
      <div class="content-body">
        <div class="dialogue-box" id="fadeInDowwn">

          <form action="index.php" method="Post">
            <center>
              <img src="assets/logo/starbucks.png" id="fadeInDown">

              <h2>Welcome to</h2>
              <h1> STARBUCKS COFFEE</h1>
              <!-- <img src="assets/logo/starbucks.png" > -->
              <h4> Please Add Your Name to Get Started</h4>
              <h5><label for="custName">Please Input Your Name:</h5></label>
              <input class="text" type="text" name="custName" id="custName" /><br>
              <button type="submit" class="button"> Start Selecting </button>
              <br>
            </center>
          </form>

        </div>
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