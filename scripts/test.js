var loc = window.location.pathname;
console.log(loc);
console.log(window.location.href);

const test123 = (form) => {

  var quantity = form.quantity.value;
  var user_id = form.user_id.value;
  var product_id = form.product_id.value;
  var add_cart = form.add_cart.value;

//   alert([quantity, user_id, product_id,add_cart]);

  var ajax = new XMLHttpRequest();
  ajax.open("POST", "../config/edit_cart.php", true);
//   ajax.open("POST", "homepage.php", true);
  ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

  ajax.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
		// alert(this.responseText);
		var response = JSON.parse(ajax.responseText);
		console.log('response from php: ', response);

		form.add_cart.value = 'added';
		form.add_cart.disabled = true;

		console.log('ajax success');
	 } else console.log('failed ajax')
  };

  let sendData = `quantity=${quantity}&user_id=${user_id}&product_id=${product_id}&add_cart=${add_cart}`;
  ajax.send(sendData);
  return false;
}
