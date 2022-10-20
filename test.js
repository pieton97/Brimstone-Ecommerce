var loc = window.location.pathname;
console.log(loc);
console.log(window.location.href);

function loadXMLDoc() {
  var xmlhttp = new XMLHttpRequest();

  xmlhttp.onreadystatechange = function () {
    if (xmlhttp.readyState == XMLHttpRequest.DONE) {
      // XMLHttpRequest.DONE == 4
      if (xmlhttp.status == 200) {
        document.getElementById("myDiv").innerHTML = xmlhttp.responseText;
      } else if (xmlhttp.status == 400) {
        alert("There was an error 400");
      } else {
        alert("something else other than 200 was returned");
      }
    }
  };

  xmlhttp.open("GET", "ajax_info.txt", true);
  xmlhttp.send();
};

const postReqTest = () => {
  const request = new XMLHttpRequest();

  request.onload = () => {
    let responseObject = null;

    try {
      responseObject = JSON.parse(request.responseText);
    } catch (e) {
      console.error("Could not parse JSON!");
    }

    if (responseObject) {
      handleResponse(responseObject);
    }
  };

  const requestData = `username=${form.username.value}&password=${form.password.value}`;

  request.open("post", "check-login.php");
  request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  request.send(requestData);
};

function handleResponse(responseObject) {
  if (responseObject.ok) {
    location.href = "dashboard.html";
  } else {
    while (form.messages.firstChild) {
      form.messages.removeChild(form.messages.firstChild);
    }

    responseObject.messages.forEach((message) => {
      const li = document.createElement("li");
      li.textContent = message;
      form.messages.appendChild(li);
    });

    form.messages.style.display = "block";
  }
}
