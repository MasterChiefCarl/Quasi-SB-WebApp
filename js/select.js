var nocoffee = '<h3>No Results Found</h3><br><img src="assets/logo/nocoffee.png" class="smol">';

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

  var formContainer = document.createElement("form");
  formContainer.method = "post";
  formContainer.action = "select.php";

  for (i in result.data) {
    var scrollContainer = document.createElement("div");
    scrollContainer.className = "scroll";

    rawdata.appendChild(scrollContainer);

    var prodContainer = document.createElement("div");
    prodContainer.className = "product";
    prodContainer.id = "product";

    scrollContainer.appendChild(prodContainer);

    var nameContainer = document.createElement('div');
    nameContainer.id = "nameContainer";

    var paragraph = document.createElement("h4");
    paragraph.id = "prodName";
    paragraph.innerHTML = result.data[i].prodName;

    nameContainer.appendChild(paragraph);
    prodContainer.appendChild(nameContainer);

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
    qtyField.min = '1';
    qtyField.type = 'number';
    qtyField.id = 'qtyField';
    qtyField.min = 1;
    qtyField.innerHTML = qtyField.value;

    sizeField.className = 'sizeField';
    createSizeField(result.data[i].consID, sizeField);

    if (result.data[i].consID == '1') {
      prodContainer.appendChild(sizeField);
    }

    prodContainer.appendChild(qtyField);
    prodContainer.appendChild(linebreak);

    addBtn.onclick = (function (data, qtyField, sizeField) {
      return function () {
        if (qtyField.value >= 1) {
          getProdData(data, qtyField.value, sizeField.value);
          window.alert(data.prodName + ' has been added to your Cart.' + '\n' + 'Please check below to see items added in your Cart.');
        }
        else {
          window.alert('Failed to add ' + data.prodName + ' to your cart. \nQuantity entered is lesser than 1');
        }
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

  axios.post('api.php',
    {
      items: data,
      ordQty: ordQty,
      itemSizeAdd: itemSizeAdd
    })
    .then((response) => {
      const { data } = response;
      console.log(response.data);
      getItemsInCart();
    })
    .catch(error => {
      console.error(error);
    })

  console.log(data.prodName + " " + ordQty + " " + itemSizeAdd);
}

function getItemsInCart() {
  axios
    .get("api.php", {
      params: {
        itemsInCart: true,
      },
    })
    .then((itemsInCart) => {
      axios
        .get("api.php", {
          params: {
            cartTotalBill: true,
          },
        })
        .then((cartTotalBill) => {
          showItemsInCart(itemsInCart, cartTotalBill);
        }).catch((error) => {
          console.error(error);
        });
    })
    .catch((error) => {
      console.error(error);
    });
}

function showItemsInCart(itemsInCart, cartTotalBill) {
  var res = itemsInCart;
  var bill = cartTotalBill;
  var subConsName;

  if (bill.data != '₱ 0.00') {
    var cartTable = `
              <div class="dialogue-box-alt-wide" id="cart">
              <table id="cartTable">
              <tr>
                  <td class="tableLabel">Item Type</td>
                  <td class="tableLabel">Item Name</td>
                  <td class="tableLabel">Qty</td>
                  <td class="tableLabel">Price</td>
                  <td class="tableLabel">Size Additional</td>
                  <td class="tableLabel">Total</td>
              </tr>            
          `;

    for (i in res.data) {

      switch (res.data[i].consType) {
        case "1": subConsName = "Tea";
          break;
        case "2": subConsName = "Frappe";
          break;
        case "3": subConsName = "Coffee";
          break;
        case "4": subConsName = "Sandwich";
          break;
        case "5": subConsName = "Wrap";
          break;
        case "6": subConsName = "Cake";
          break;
      }

      cartTable += `
              <tr>
                  <td class="tableValue">${subConsName}</td>
                  <td class="tableValue">${res.data[i].consName}</td>
                  <td class="tableValue">${res.data[i].consQty}</td>
                  <td class="tableValue">₱ ${res.data[i].consPrice}</td>
                  <td class="tableValue">+ ₱ ${res.data[i].consSizeAdd}.00 each</td>
                  <td class="tableValue">₱ ${(res.data[i].consPrice + res.data[i].consSizeAdd) * res.data[i].consQty}.00</td>
                  <td class="tableValue">
                      <button id="removeBtn" onclick="removeFromCart('${i}', '${res.data[i].consName}')">Remove</button>
                  </td>
              </tr>            
              `;
    }
    cartTable += `
              <tr>
                  <td colspan="6" align="right" style="border-top: 2px solid white;">Total Bill</td>
                  <td class="tableValue">${bill.data}</td>
              </tr>
              <tr>
                  <td colspan="7" align="center">
                      <button id="checkoutBtn">Check Out</button>
                  </td>
              </tr>
              </table>
              </div>
              `;

  }
  else {
    var cartTable = '';
  }

  document.getElementById('cartContainer').innerHTML = cartTable;
  document.getElementById('checkoutBtn').onclick = (function (data) {
    return function () {
      addOrder(data);
    }
  })(res.data);
}

function addOrder(data) {

  axios.get("dbquery.php", {
    params: {
      transaction: true
    }
  }).then((transaction) => {
    console.log('-----------------');
    axios.get("dbquery.php", {
      params: {
        itemID: true
      }
    })
      .then((item) => {
        console.log(item.data);
        axios
          .post("dbquery.php", {
            itemNo: item.data,
            transID: transaction.data,
            itemData: data
          })
          .then((response) => {
            console.log(response.data);
            getTransID();
          })
          .catch((error) => {
            console.error(error);
          });

      })
      .catch((error) => {
        console.error(error);
      });
  }
  )
}

function removeFromCart(itemCartID, consName) {
  console.log(itemCartID);

  axios.post('api.php',
    {
      itemCartID: itemCartID
    })
    .then((response) => {
      const { data } = response;
      window.alert(consName + ' has been successfully removed from your cart.');
      getItemsInCart();
    })
    .catch(error => {
      console.error(error);
    })
}

function getTransID() {
  axios
    .get("dbquery.php", {
      params: {
        transID: true,
      },
    })
    .then((response) => {
      getOrders(response.data);
    })
    .catch((error) => {
      console.error(error);
    });
}

function getOrders(transID) {
  axios.get("dbquery.php", {
    params: {
      transData: transID,
    }
  })
    .then((response) => {
      console.log(response.data);
      showReceipt(response.data);
    })
    .catch((error) => {
      console.error(error);
    });
}

function showReceipt(data) {
  var modal = document.createElement('div');
  modal.id = 'myModal';
  modal.className = 'myModal';

  var modalContent = document.createElement('div');
  modalContent.id = 'modalContent';
  modalContent.className = 'modalContent';

  modal.appendChild(modalContent);
  var close = document.createElement('button');
  close.className = 'button';
  close.id = "close";
  close.innerHTML = 'EXIT';

  var count = 1;
  var totalBill = 0;
  // var modal = document.getElementById("myModal");
  var btn = document.getElementById("checkoutBtn");
  // var close = document.getElementById("close");
  // console.log(data);
  var html = `
  <center>  
      <img class="smoller" src="assets/logo/starbucks.png">
      <h2 style="color:black; margin-bottom:0;  filter: none;">Starbucks Inc.</h2>
      <h3 style="color:black;  filter: none;">Customer's Name: ${data[0].custName}</h3>
      </center>
      <table class="receipt" align="center">
      <tr>
        <td>Item #</td>
        <td>Name</td>
        <td>Price</td>
        <td>Quantity</td>
        <td>Subtotal</td>
      </tr>
    `;

  for (i in data) {
    html += `
      <tr>
        <td class="">
          ${count}
        </td>
        <td>
          ${data[i].itemName}
        </td>
        <td>
          ${data[i].itemPrice}
        </td>
        <td>
          ${data[i].itemQty}
        </td>
        <td>
          ${data[i].itemTotal}
        </td>
      </tr>
      `;
    count++;
    totalBill += parseInt(data[i].itemTotal);
  }

  html += `
    
      </table>
      <hr>
      <hr>
      <h3 style="color:black; filter:none;">Total Bill: ${totalBill}</h3>
  `;


  modalContent.innerHTML = html;
  modalContent.append(close);
  console.log(modal);



  close.onclick = function () {
    axios.get("index.php", {
      params: {
        return: true
      }
    });
    window.location = 'index.php';
  }



  document.body.append(modal);

  // $('#myModal').modal('show');
}

function getRndInteger(min, max) {
  return Math.floor(Math.random() * (max - min + 1)) + min;
}