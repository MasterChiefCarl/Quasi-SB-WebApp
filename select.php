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
            <h2>Select Your Current Option</h2>
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
<script>
  //value layout is different due to the fact that this is JAVASCRIPT and not PHP
  window.addEventListener("load", getColleges);
  document.getElementById("colleges").addEventListener("change", getPrograms);

  function getProducts() {
    axios
      .get("dbquery.php", {
        params: {
          colleges: true,
        },
      })
      .then((response) => showColleges(response))
      .catch((error) => {
        console.error(error);
      });
  }

  function showProducts(response) {
    var result = response;
    for (i in result.data) {
      var option = document.createElement("option");
      option.value = result.data[i].coll_id;
      option.text = result.data[i].coll_fname;
      var select = document.getElementById("colleges");
      select.appendChild(option);
    }
  }

  function getSubProduct() {
    var id = document.getElementById("colleges").value;

    document.getElementById("programs").disabled = id > 0 ? false : true;

    axios
      .get("dbQuery.php", {
        params: {
          programs: id,
        },
      })
      .then((response) => showPrograms(response))
      .catch((error) => {
        console.error(error);
      });
  }

  function showPrograms(response) {
    var result = response;
    layout = `
      <option value="starter" selected>-- Select a program --</option>
      `;
    for (i in result.data) {
      layout +=
        "<option value=" +
        result.data[i].prog_id +
        ">" +
        result.data[i].prog_fname +
        "</option>";
    }

    document.getElementById("programs").innerHTML = layout;
  }
</script>

</html>