var nocoffee =
  '<h3>No Results Found</h3><br><img src="assets/logo/nocoffee.png" class="smol">';

document.getElementById("result-field").innerHTML = this.nocoffee;
window.addEventListener("load", getConsumables);
document
  .getElementById("consumables")
  .addEventListener("change", getSubConsumables);
document
  .getElementById("subconsumables")
  .addEventListener("change", getProducts);

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
  document.getElementById("result-field").innerHTML =
    id > 0 ? nocoffee : nocoffee;

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

  document.getElementById("result-field").innerHTML =
    id != "starter" ? "" : nocoffee;

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
  var rawdata = document.createElement("div");
  rawdata.className = "scrollmenu";

  // rawdata = '<div class="scrollmenu">';
  // <form action="select.php" method="post">'
  var formContainer = document.createElement("form");
  formContainer.method = "post";
  formContainer.action = "select.php";

  // rawdata.appendChild(formContainer);
  for (i in result.data) {
    // rawdata += '<div class="scroll"><center><div class="product" id="product"><h2>' + result.data[i].prodID + '</h2><h4><p>' +
    //     result.data[i].prodName + '</p></h4><img class="prod" src="assets/images/products/' + result.data[i].imagePath + '"><br><h5>₱' + result.data[i].prodPrice + '.00</h5><br>';

    var scrollContainer = document.createElement("div");
    scrollContainer.className = "scroll";

    rawdata.appendChild(scrollContainer);

    var prodContainer = document.createElement("div");
    prodContainer.className = "product";
    prodContainer.id = "product";

    scrollContainer.appendChild(prodContainer);

    var prodIDLabel = document.createElement("h2");
    prodIDLabel.innerHTML = result.data[i].prodID;

    prodContainer.appendChild(prodIDLabel);

    var paragraph = document.createElement("h4");
    var prodNameLabel = document.createElement("p");
    prodNameLabel.innerHTML = result.data[i].prodName;

    prodContainer.appendChild(paragraph);
    paragraph.appendChild(prodNameLabel);

    var imgContainer = document.createElement("img");
    imgContainer.className = "prod";
    imgContainer.src = "assets/images/products/" + result.data[i].imagePath;

    prodContainer.appendChild(imgContainer);

        var paragraph2 = document.createElement('h2');
        paragraph2.innerHTML = "₱ " + result.data[i].prodPrice + ".00";

    prodContainer.appendChild(paragraph2);

        var sizeField = document.createElement("select");
        var qtyField = document.createElement("input");
        var addBtn = document.createElement("button");
        var linebreak = document.createElement("br");

        qtyField.value = 1;
        qtyField.min= '1';
        qtyField.type = 'number';
        qtyField.id = 'qtyField';
        qtyField.min = 1;
        qtyField.innerHTML = qtyField.value;

        createSizeField(result.data[i].consID, sizeField);

        if (result.data[i].consID == '1') {
            prodContainer.appendChild(sizeField);
        }

        prodContainer.appendChild(qtyField);
        prodContainer.appendChild(linebreak);
        // rawdata += `<input type='number' value='1' id='qtyField' align='center'><br>`;
        // rawdata += `<button class="button" id='addBtn' align="center">Add to order</button></center></div>`;
        addBtn.onclick = (function (data, qtyField, sizeField) {
            return function () {
                if (qtyField.value >= 1)
                    getProdData(data, qtyField.value, sizeField.value);
            };
        })(result.data[i], qtyField, sizeField);

    addBtn.className = "button";
    addBtn.name = "add";
    addBtn.id = "addBtn";
    addBtn.innerHTML = "Add to cart";

    prodContainer.appendChild(addBtn);
  }
  document.getElementById("result-field").appendChild(rawdata);
}

// function showData(response) {
//     var res = response;

//     for (i in res) {
//         var p = document.createElement('p');
//         p.innerHTML = res.data[i].ordQty;
//         document.getElementById('cart').appendChild(p);
//     }

// }

function addOrder(response, ordQty) {
  var result = response;

  axios
    .post("dbquery.php", {
      items: result.data,
      ordQty: ordQty,
    })
    .then(response)
    .catch((error) => {
      console.error(error);
    });
}

function createSizeField(consID, sizeField) {

    axios.get('dbquery.php', {
        params: {
            beverageSizes: true
        },
    }).then(response => {
        if (consID == '1') {
            for (i in response.data) {
                var sizeOptions = document.createElement("option");
                sizeOptions.value = response.data[i].sizeAddPrice;
                sizeOptions.text = response.data[i].sizeName;
                sizeField.appendChild(sizeOptions);
            }
        }

    }).catch(error => {
        console.error(error);
    })


}

function getProdData(data, ordQty, itemSizeAdd) {
  var id = data.prodID;
  axios
    .get("dbquery.php", {
      params: {
        itemID: id
      },
    })
    .then((response) => addOrder(response, ordQty))
    .catch((error) => {
      console.error(error);
    });
    
    axios.post('api.php',
        {
            items: data,
            ordQty: ordQty,
            itemSizeAdd: itemSizeAdd
        })
        .then((response) => {
            const { data } = response;
            console.log(response.data);
        })
        .catch(error => {
            console.error(error);
        })

    console.log(data.prodName + " " + ordQty + " " + itemSizeAdd);
}
