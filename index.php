<?php

declare(strict_types=1);
require_once 'init.php';
require_once 'Session.php';

use Sessions\Session;

if (!$_REQUEST && session_id() != '') {
  Session::stop();
  //last session destroyer!
}


if (session_status() === PHP_SESSION_NONE) {
  Session::start();
}

if ($_REQUEST && $_REQUEST["custName"] != null) {
  Session::add('custName', $_REQUEST["custName"]);
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
  <link rel="stylesheet" href="styles.css" />
  <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> -->

  <link rel="shortcut icon" type="image/x-icon" href="assets/logo/starbucks.png" />
</head>

<body>
  <div class="default-layout-body">
    <div class="nav">
      <div class="nav-body">navbar</div>
    </div>
    <div class="content">
      <div class="content-body">
        <div class="dialogue-box">
          
            <form action="index.php" method="Post">
            <center>
              <h1> Welcome to STARBUCKS </h1>
              <h3> Please Add Your Name to Get Started</h3>
              
              <br><br>
              <h4><label for="custName">Please Input Your Name:</h4>
              <input type="text" name="custName" id="custName" /></label>
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