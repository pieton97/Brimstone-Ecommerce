let loc = window.location.pathname;
console.log(loc);
console.log(window.location.href);

const addCart = (form) => {
  let quantity = form.quantity.value;
  let user_id = form.user_id.value;
  let product_id = form.product_id.value;
  let add_cart = form.add_cart.value;

  let ajax = new XMLHttpRequest();
  ajax.open("POST", "../config/edit_cart.php", true);
  // ajax.open("POST", "../pages/homepage.php", true);
  ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

  ajax.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      console.log("ajax almost success");

      let response = JSON.parse(ajax.responseText);
      console.log("response from php: ", response);

      form.add_cart.value = "added";
      form.add_cart.disabled = true;

      console.log("ajax success");
    } else {
      console.log("failed ajaxs");
    }
  };

  let sendData = `quantity=${quantity}&user_id=${user_id}&product_id=${product_id}&add_cart=${add_cart}`;
  ajax.send(sendData);
  return false;
};

const addMailingList = (form) => {
  let name = form.name.value;
  let email = form.email.value;
  let mailing_list = form.mailing_list.value;

  let ajax = new XMLHttpRequest();
  ajax.open("POST", "../config/essentials.php", true);
  ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

  ajax.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      let response = JSON.parse(ajax.responseText);
      console.log("response from php: ", response);

      form.name.value = "";
      form.name.disabled = true;
      form.email.value = "";
      form.email.disabled = true;
      form.mailing_list.value = "Signed Up";
      form.mailing_list.disabled = true;
      form.querySelector("p").style.display = "block";

      console.log("ajax success");
    } else {
      console.log("failed ajaxs");
    }
  };

  let sendData = `name=${name}&email=${email}&mailing_list=${mailing_list}`;
  ajax.send(sendData);
  return false;
};
