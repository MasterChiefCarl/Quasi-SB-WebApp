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
  <script type="text/javascript" src="js/pw.js"></script>

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
            <select name="consumables" id="consumables">
              <option value="starter" selected>-- Select Type of Consumable --</option>
            </select>
            <br>
            <select name="subconsumables" id="subconsumables" disabled>
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
  var nocoffee = '<h3>No Results Found</h3><br><img src="assets/logo/nocoffee.png" class="smol">';

  document.getElementById("result-field").innerHTML = this.nocoffee;
  window.addEventListener("load", getConsumables);
  document.getElementById("consumables").addEventListener("change", getSubConsumables);
  document.getElementById("subconsumables").addEventListener("change", getProducts);

  function getConsumables() {
    axios
      .get("dbquery.php", {
        params: {
          consumables: true,
        },
      })
      .then((response) => showConsumables(response))
      .catch((error) => {
        console.error(error);
      });
  }

  function showConsumables(response) {
    var result = response;
    for (i in result.data) {
      var option = document.createElement("option");
      option.value = result.data[i].consID;
      option.text = result.data[i].consName;
      var select = document.getElementById("consumables");
      select.appendChild(option);
    }
  }

  function getSubConsumables() {
    var id = document.getElementById("consumables").value;

    document.getElementById("subconsumables").disabled = id > 0 ? false : true;
    document.getElementById("result-field").innerHTML = id > 0 ? nocoffee : true;

    axios
      .get("dbquery.php", {
        params: {
          subconsumables: id,
        },
      })
      .then((response) => showSubConsumables(response))
      .catch((error) => {
        console.error(error);
      });
  }

  function showSubConsumables(response) {
    var result = response;
    layout = `
      <option value="starter" selected>-- Select --</option>
      `;
    for (i in result.data) {
      layout +=
        "<option value=" +
        result.data[i].subconsID +
        ">" +
        result.data[i].subconsName +
        "</option>";
    }

    document.getElementById("subconsumables").innerHTML = layout;
  }

  function getProducts() {
    var id = document.getElementById("subconsumables").value;

    document.getElementById("result-field").innerHTML = id != 'starter' ? nocoffee : true;

    if (id != "starter") {
      axios
        .get("dbquery.php", {
          params: {
            products: id,
          },
        })
        .then((response) => showProducts(response))
        .catch((error) => {
          console.error(error);
        });
    } else {
      document.getElementById("result-field").innerHTML = nocoffee;
    }

  }

  function showProducts(response) {
    var result = response;
    rawdata = '<div class="scrollmenu"><form action="select.php" method="post">';

    for (i in result.data) {
      rawdata += '<div class="scroll"><center><div class="product"><h2>' + result.data[i].prodID + '</h2><h4><p>'+
      result.data[i].prodName + '</p></h4><img class="prod" src="assets/images/products/'+result.data[i].imagePath+'"><br><h5>₱' + result.data[i].prodPrice + '.00</h5><br>';

      rawdata += '<div class="button" align="center">Add to order</div></label></div></center></div>';
    }
    rawdata += '</div>';

    document.getElementById("result-field").innerHTML = rawdata;
  }
</script>

</html>
