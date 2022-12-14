const username = document.getElementById("login-name");
const password = document.getElementById("login-password");

const adminLogin = [{ name: "dac", password: "dac123" }];
const userLogin = [{ name: "jenny", password: "jenny123" }];

const loginAdmin = () => {
  username.value = adminLogin[0].name;
  password.value = adminLogin[0].password;
};

const loginUser = () => {
  username.value = userLogin[0].name;
  password.value = userLogin[0].password;
};
