<?php

declare(strict_types=1);
require_once 'init.php';
require_once 'Session.php';

use Sessions\Session;

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
  <title>QSASI-STARBUCKS POS</title>
  <link rel="stylesheet" href="styles.css" />
  <link rel="stylesheet" href="animations.css" />
  <link rel="shortcut icon" type="image/x-icon" href="assets/logo/starbucks.png" />
  <script src="axios.js" type="text/javascript"></script>
</head>

<body>
  <div class="default-layout-body">
    <div class="nav">
      <div class="nav-body">
        <h3>Welcome To Starbucks <?php echo $_SESSION['custName']; ?></h3>
      </div>
    </div>
    <div class="content">
      <div class="content-body">
        <div class="dialogue-box" id="fadeInDowwn">
          <center>
            <h2>Select Your Menu Options:</h2>
            <select name="colleges" id="colleges">
              <option value="starter" selected>-- Select Type of Consumable --</option>
            </select>
            <br>
            <select name="programs" id="programs" disabled>
              <option value="starter" selected>-- Select Type of Product--</option>
            </select>
          </center>
        </div>
        <!-- <div class="dialogue-box" id="fadeInDowwn">
          <center>
            <h2>Results</h2>
          </center>
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


</html>