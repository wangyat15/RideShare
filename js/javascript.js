function GetSelect1() {
  location.replace("./searchforrs.html");
}
function GetSelect2() {
  location.replace("./viewrs.html");
}
function GetSelect3() {
  location.replace("./updaters.html");
}
function GetSelect4() {
  location.replace("./myridetrip.html");
}
function GetSelect5() {
  location.replace("./myridetrip.html");
}
function GetSelect6() {
  location.replace("./searchforrt.html");
}
function GetSelect7() {
  location.replace("./viewrt.html");
}
function GetSelect8() {
  location.replace("./updatert.html");
}
function GetSelect9() {
  location.replace("./myrideshare.html");
}
function GetSelect10() {
  location.replace("./myrideshare.html");
}

// for signin.html
function validate() {
  var $valid = true;
  var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
  document.getElementById("email_info").innerHTML = "";
  document.getElementById("password_info").innerHTML = "";
  
  var emailName = document.getElementById("email").value;
  var password = document.getElementById("password").value;
  if (emailName == "") {
    document.getElementById("email_info").innerHTML = "required";
    $valid = false;
  }
  if (emailName.match(mailformat)) {
    document.getElementById("email_info").innerHTML = "";
  } else {
    document.getElementById("email_info").innerHTML = "invalid email address";
    $valid = false;
  }
  if (password == "") {
    document.getElementById("password_info").innerHTML = "required";
    $valid = false;
  }
  if ($valid == true) {
    location.href = "DriverPassenger.html";
  }
  return $valid;
}


// for signin1.html
function validate1() {
  var $valid = true;
  var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
  document.getElementById("email_info").innerHTML = "";
  document.getElementById("password_info").innerHTML = "";
  
  var emailName = document.getElementById("email").value;
  var password = document.getElementById("password").value;
  if (emailName == "") {
    document.getElementById("email_info").innerHTML = "required";
    $valid = false;
  }
  if (emailName.match(mailformat)) {
    document.getElementById("email_info").innerHTML = "";
  } else {
    document.getElementById("email_info").innerHTML = "invalid email address";
    $valid = false;
  }
  if (password == "") {
    document.getElementById("password_info").innerHTML = "required";
    $valid = false;
  }
  if ($valid == true) {
    location.href = "addrt1.html";
  }
  return $valid;
}


// for index.html
function ivalidate() {
  var $valid = true;
  document.getElementById("error_message").innerHTML = "";
  var address_a = document.getElementById("address").value;
  if (address_a == "") {
    document.getElementById("error_message").innerHTML = "must input starting address";
    $valid = false;
  }
  if ($valid == true) {
    location.href = "index.html";
  }
  return $valid;
}


// for signup.html
function signup_validate() {
  var $valid = true;
  var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
  document.getElementById("error_message").innerHTML = "";
  var vname = document.getElementById("name").value;
  var vmobile_prefix = document.getElementById("mobile_prefix").value;
  var vmobile = document.getElementById("mobile").value;
  var vemail = document.getElementById("email").value;
  var vpassword = document.getElementById("password").value;
  var vrpassword = document.getElementById("rpassword").value;
  if (vname == "") {
      document.getElementById("error_message").innerHTML += "must input name; ";
    $valid = false;
  }
  if (vmobile_prefix == "" || isNaN(vmobile_prefix)) {
    document.getElementById("error_message").innerHTML += "invalid mobile prefix; ";
  $valid = false;
  }
  if (vmobile == "" || isNaN(vmobile)) {
    document.getElementById("error_message").innerHTML += "invalid mobile number; ";
  $valid = false;
  }
  if (vemail == "" || !vemail.match(mailformat)) {
    document.getElementById("error_message").innerHTML += "invalid email address; ";
  $valid = false;
  }
  if (vpassword == "") {
    document.getElementById("error_message").innerHTML += "invalid password; ";
  $valid = false;
  }
  if (vrpassword == "" || vpassword !== vrpassword) {
    document.getElementById("error_message").innerHTML += "invalid re-input password; ";
  $valid = false;
  }
  
  if ($valid == true) {
    location.href = "signin1.html";
  } 
  return $valid;
}

// for edmyprofile.html
function edprofile_validate() {
  var $valid = true;
  var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
  document.getElementById("error_message").innerHTML = "";
  var vname = document.getElementById("name").value;
  var vmobile_prefix = document.getElementById("mobile_prefix").value;
  var vmobile = document.getElementById("mobile").value;
  var vemail = document.getElementById("email").value;
  console.log("vname");
  if (vname == "") {
      document.getElementById("error_message").innerHTML += "must input name; ";
    $valid = false;
  }
  if (vmobile_prefix == "" || isNaN(vmobile_prefix)) {
    document.getElementById("error_message").innerHTML += "invalid mobile prefix; ";
  $valid = false;
  }
  if (vmobile == "" || isNaN(vmobile)) {
    document.getElementById("error_message").innerHTML += "invalid mobile number; ";
  $valid = false;
  }
  if (vemail == "" || !vemail.match(mailformat)) {
    document.getElementById("error_message").innerHTML += "invalid email address; ";
  $valid = false;
  }

  
  if ($valid == true) {
    location.href = "myprofile.html";
  } 
  return $valid;
}

// for edmyprofile1.html
function edprofile1_validate() {
  var $valid = true;
  var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
  document.getElementById("error_message").innerHTML = "";
  var vname = document.getElementById("name").value;
  var vmobile_prefix = document.getElementById("mobile_prefix").value;
  var vmobile = document.getElementById("mobile").value;
  var vemail = document.getElementById("email").value;
  console.log("vname");
  if (vname == "") {
      document.getElementById("error_message").innerHTML += "must input name; ";
    $valid = false;
  }
  if (vmobile_prefix == "" || isNaN(vmobile_prefix)) {
    document.getElementById("error_message").innerHTML += "invalid mobile prefix; ";
  $valid = false;
  }
  if (vmobile == "" || isNaN(vmobile)) {
    document.getElementById("error_message").innerHTML += "invalid mobile number; ";
  $valid = false;
  }
  if (vemail == "" || !vemail.match(mailformat)) {
    document.getElementById("error_message").innerHTML += "invalid email address; ";
  $valid = false;
  }

  
  if ($valid == true) {
    location.href = "myprofile1.html";
  } 
  return $valid;
}


// for searchforrs.html
function rsvalidate() {
  var $valid = true;
  document.getElementById("error_message").innerHTML = "";
  var address_a = document.getElementById("address").value;
  if (address_a == "") {
    document.getElementById("error_message").innerHTML = "must input starting address";
    $valid = false;
  }
  if ($valid == true) {
    location.href = "searchforrs.html";
  }
  return $valid;
}

//  for searchforrt.html
function rtvalidate() {
  var $valid = true;
  document.getElementById("error_message").innerHTML = "";
  var address_a = document.getElementById("address").value;
  if (address_a == "") {
    document.getElementById("error_message").innerHTML = "must input starting address";
    $valid = false;
  }
  if ($valid == true) {
    location.href = "searchforrt.html";
  }
  return $valid;
}

// for about.html
function Show() {
  var x = document.getElementById("Show");
  if (x.style.display === "none") {
    x.style.display = "block";
    document.getElementById("showid").innerHTML = "hide-About";
  } else {
    x.style.display = "none";
    document.getElementById("showid").innerHTML = "show-About";
  }
}

function ShowIntroduction() {
  var x = document.getElementById("ShowIntroduction");
  if (x.style.display === "none") {
    x.style.display = "block";
    document.getElementById("showIntroductionID").innerHTML = "hide-Introduction";
  } else {
    x.style.display = "none";
    document.getElementById("showIntroductionID").innerHTML = "show-Introduction";
  }
}

function ShowProblem() {
  var x = document.getElementById("ShowProblem");
  if (x.style.display === "none") {
    x.style.display = "block";
    document.getElementById("ShowProblemID").innerHTML = "hide-Problem Statement";
  } else {
    x.style.display = "none";
    document.getElementById("ShowProblemID").innerHTML = "show-Problem Statement";
  }
}

function ShowSolution() {
  var x = document.getElementById("ShowSolution");
  if (x.style.display === "none") {
    x.style.display = "block";
    document.getElementById("ShowSolutionID").innerHTML = "hide-Problem Solution";
  } else {
    x.style.display = "none";
    document.getElementById("ShowSolutionID").innerHTML = "show-Problem Solution";
  }
}
// for edmyprofile.html
function ShowProfile() {
  var x = document.getElementById("main");
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
}

// for edmyprofile.html, signup.html

function ShowVehicleInformation() {
  var x = document.getElementById("VehicleInformation");
  if (x.style.display === "none") {
    x.style.display = "block";
    document.getElementById("VID").innerHTML = "hide-Vehicle Information";
  } else {
    x.style.display = "none";
    document.getElementById("VID").innerHTML = "show-Vehicle Information";
  }
}

function ShowMap() {
  var x = document.getElementById("Map");
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
}

function ShowMap2() {
  var x = document.getElementById("Map2");
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
}
