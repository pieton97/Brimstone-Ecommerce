let loc = window.location.pathname;
console.log(loc);
console.log(window.location.href);

const test123 = (form) => {
  let quantity = form.quantity.value;
  let user_id = form.user_id.value;
  let product_id = form.product_id.value;
  let add_cart = form.add_cart.value;

  let ajax = new XMLHttpRequest();
  ajax.open("POST", "../config/edit_cart.php", true);
  // ajax.open("POST", "../pages/homepage.php", true);
  ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

  ajax.onreadystatechange = function () {
    if (this.readyState == 4) {
      if (this.status == 200) {
        // var return_data = xml.responseText;
        // document.getElementById("status").innerHTML = return_data;

        console.log("ajax almost success");

        // let response = JSON.parse(ajax.responseText);
        // console.log("response from php: ", response);

        form.add_cart.value = "added";
        form.add_cart.disabled = true;

        console.log("ajax success");
      } else {
        alert("GNAH!");
      }
      console.log("state of 4");
    } else {
      console.log("failed ajaxs");
    }
  };

  let sendData = `quantity=${quantity}&user_id=${user_id}&product_id=${product_id}&add_cart=${add_cart}`;
  ajax.send(sendData);
  return false;
};
