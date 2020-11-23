
function SignUpForm(event) {

  var email = document.getElementById("emailInput").value;
  var uname = document.getElementById("usern").value;
  var fname = document.getElementById("fname").value;
  var pass = document.getElementById("pword").value;
  var cpass = document.getElementById("cpword").value;
  var birth = document.getElementById("dob").value;
  var avatar = document.getElementById("fileToUpload").value;

  var regex_email = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  var regex_pswd = /^(\S*)?\d+(\S*)?$/;
  var regex_dob = /^([12]\d{3}(0[1-9]|1[0-2])(0[1-9]|[12]\d|3[01]))/;

  var msg_email = document.getElementById("msg_email");
  var msg_uname = document.getElementById("msg_uname");
  var msg_fname = document.getElementById("msg_fname");
  var msg_pass = document.getElementById("msg_pswd");
  var msg_cpass = document.getElementById("msg_pswdr");
  var msg_dob = document.getElementById("msg_dob");
  var msg_avatar = document.getElementById("msg_avatarpicture");
  msg_email.innerHTML = "";
  msg_uname.innerHTML = "";
  msg_fname.innerHTML = "";
  msg_pass.innerHTML = "";
  msg_cpass.innerHTML = "";
  msg_dob.innerHTML = "";
  msg_avatar.innerHTML = "";

  var result = true;

  var textNode;

  if (email == null || email == "") {
    textNode = document.createTextNode("Email address empty.");
    msg_email.appendChild(textNode);
    result = false;
  }
  else if (regex_email.test(email) == false) {
    textNode = document.createTextNode("Email address wrong format. example: username@somewhere.com");
    msg_email.appendChild(textNode);
    result = false;
  }
  else if (email.length > 60) {
    textNode = document.createTextNode("Email address too long. Maximum is 60 characters.");
    msg_email.appendChild(textNode);
    result = false;
  }



  if (uname == null || uname == "") {
    textNode = document.createTextNode("Username is empty.");
    msg_uname.appendChild(textNode);
    result = false;

  }

  if (fname == null || fname == "") {
    textNode = document.createTextNode("First name is empty.");
    msg_fname.appendChild(textNode);
    result = false;

  }


  if (pass == null || pass == "") {
    textNode = document.createTextNode("Password is empty.");
    msg_pass.appendChild(textNode);
    result = false;

  }
  else if (regex_pswd.test(pass) == false) {
    textNode = document.createTextNode("Password wrong format. Must have at least one number");
    msg_pass.appendChild(textNode);
    result = false;
  }
  else if (pass.length != 8) {
    textNode = document.createTextNode("Password must be 8 characters long.");
    msg_pass.appendChild(textNode);
    result = false;
  }


  if (cpass == null || cpass == "") {
    textNode = document.createTextNode("Confirm Password is empty.");
    msg_cpass.appendChild(textNode);
    result = false;

  }
  else if (cpass != pass) {
    textNode = document.createTextNode("Passwords don't match");
    msg_cpass.appendChild(textNode);
    result = false;
  }

  if (birth == null || birth == "") {
    textNode = document.createTextNode("Birthday is empty");
    msg_dob.appendChild(textNode);
    result = false;
  }
  else if (regex_dob.test(birth) == false) {
    textNode = document.createTextNode("Please use format of yyyymmdd with no spaces or other chars in between");
    msg_dob.appendChild(textNode);
    result = false;
  }

  if (avatar == null || avatar == "") {
    textNode = document.createTextNode("Please select an image");
    msg_avatar.appendChild(textNode);
    result = false;
  }

  if (result != true) {
    event.preventDefault();
    msg_email.style.color = "red";
    msg_uname.style.color = "red";
    msg_pass.style.color = "red";
    msg_cpass.style.color = "red";
    msg_fname.style.color = "red";
    msg_dob.style.color = "red";
    msg_avatar.style.color = "red";
  } 
}

function LoginForm(event) {

  var email = document.getElementById("emailInput1").value;
  var pass = document.getElementById("pword1").value;

  var regex_email = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  var regex_pswd = /^(\S*)?\d+(\S*)?$/;

  var msg_email = document.getElementById("msg_email1");
  var msg_pass = document.getElementById("msg_pswd1");
  msg_email.innerHTML = "";
  msg_pass.innerHTML = "";

  var result = true;

  var textNode;

  if (email == null || email == "") {
    textNode = document.createTextNode("Email address empty.");
    msg_email.appendChild(textNode);
    result = false;
  }
  else if (regex_email.test(email) == false) {
    textNode = document.createTextNode("Email address wrong format. example: username@somewhere.com");
    msg_email.appendChild(textNode);
    result = false;
  }
  else if (email.length > 60) {
    textNode = document.createTextNode("Email address too long. Maximum is 60 characters.");
    msg_email.appendChild(textNode);
    result = false;
  }


  if (pass == null || pass == "") {
    textNode = document.createTextNode("Password is empty.");
    msg_pass.appendChild(textNode);
    result = false;

  }
  else if (regex_pswd.test(pass) == false) {
    textNode = document.createTextNode("Password wrong format. Must have at least one number");
    msg_pass.appendChild(textNode);
    result = false;
  }
  else if (pass.length != 8) {
    textNode = document.createTextNode("Password must be 8 characters long.");
    msg_pass.appendChild(textNode);
    result = false;
  }

  if (result != true) {
    event.preventDefault();
    msg_email.style.color = "red";
    msg_pass.style.color = "red";
  }
}

function Search(event) {

  var searchBar = document.getElementById("search").value;

  var msg_searchBar = document.getElementById("msg_searchBar");
  msg_searchBar.innerHTML = "";

  var result = true;

  var textNode;

  if (searchBar == null || searchBar == "") {
    textNode = document.createTextNode("Search is empty");
    msg_searchBar.appendChild(textNode);
    result = false;
  }

  if (result == true) {

  } else {
    event.preventDefault();
    msg_searchBar.style.color = "red";
  }
}

function Watch(event) {

  var watch = document.getElementById("name").value;

  var msg_watch = document.getElementById("msg_watch");
  msg_watch.innerHTML = "";

  var result = true;

  var textNode;

  if (watch == null || watch == "") {
    textNode = document.createTextNode("Watchlist name is empty");
    msg_watch.appendChild(textNode);
    result = false;
  } else if (watch.length > 14) {
    textNode = document.createTextNode("Watchlist name is too long");
    msg_watch.appendChild(textNode);
    result = false;
  }

  if (result == true) {

  } else {
    event.preventDefault();
    msg_watch.style.color = "red";
  }
}

function Count(event) {

  var watch = document.getElementById("name").value.length;

  var msg_watch = document.getElementById("msg_watch");
  msg_watch.innerHTML = "";
  msg_watch.style.color = "black";

  msg_watch.append(watch);

  if (watch > 15) {
    msg_watch.innerHTML = "";
    textNode = document.createTextNode("Watchlist name is too long");
    msg_watch.appendChild(textNode);
    msg_watch.style.color = "red";
  }
}

