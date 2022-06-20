<?php

declare(strict_types=1);
require_once 'php/init.php';
require_once 'php/Session.php';

use Sessions\Session;

$customer = new Customer();
$cart = new Cart();

if (session_status() === PHP_SESSION_NONE) {
  Session::start();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <title>Welcome To Starbucks <?php echo $customer->getCustName() . ' '; ?>:QSASI-STARBUCKS POS</title>

  <!-- Stylesheets, Logo ref and, jsScripts -->
  <link rel="stylesheet" href="css/styles.css" />
  <link rel="stylesheet" href="css/animations.css" />
  <link rel="shortcut icon" type="image/x-icon" href="assets/logo/starbucks.png" />
  <script src="js/axios.js" type="text/javascript"></script>
</head>

<body>
  <div class="default-layout-body">
    <div class="nav">
      <div class="nav-body">
        <a href="index.php?return=true"><img src="assets/logo/starbucks.png" style="margin:0;width:25px;height:25px;"></a>
        <h3>Welcome To Starbucks <?php echo $customer->getCustName(); ?></h3>
        <a href="index.php?return=true"><img src="assets/images/back.png" style="margin:0;width:25px;height:25px;"></a>
      </div>
    </div>
    <div class="content">
      <div class="content-body">
        <div class="dialogue-box-alt" id="fadeInDowwn">
          <center>
            <h2>Select Your Menu Options:</h2>
            <select name="consumables" id="consumables">
              <option value="starter" selected>-- Select Type of Consumable --</option>
            </select><select name="subconsumables" id="subconsumables" disabled>
              <option value="starter" selected>-- Select --</option>
            </select>
          </center>
        </div>
        <br><br>
        <div class="dialogue-box-plus" id="fadeInDowwn">
          <center>
            <h2>Results</h2>
            <div id="result-field"></div>
          </center>
        </div>
        <br><br>
        <div id="cartContainer"></div>
        <!-- <div id="myModal" class="modal">
          <div class="modal-content" id="modalContent">
            <span class="close">&times;</span>
          </div>
        </div> -->
      </div>
    </div>

    <div class="footer">
      <div class="footer-body">
        <h3>Made with 💖 by Group 1 Jungco, Lapiz, Garces</h3>
      </div>
    </div>
  </div>
</body>
<script src="js/select.js" type="text/javascript">
  //value layout is different due to the fact that this is JAVASCRIPT and not PHP
</script>

</html>