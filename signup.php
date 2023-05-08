<?php
include("database.php");
If (isset($_POST["memberName"])) {
   $memberName = $_POST["memberName"];
   $prefixMobile = $_POST["prefixMobile"];
   $phoneNum = $_POST["phoneNum"];
   $email = $_POST["email"];
   $password = $_POST["password"];
   $dateOfRegister = date('Y-m-d');
   $vehicleNo = $_POST["vehicleNo"];
   $vehicleModel = $_POST["vehicleModel"];
   $vehicleBrand = $_POST["vehicleBrand"];
   $vehicleDesc = $_POST["vehicleDesc"];
   $query = "SELECT * FROM memberprofile WHERE email = '$email'";
   $result = mysqli_query($conn,$query);
   If ($result->num_rows == 0) {
   //If (validate ($email) == true) {
      $execute = mysqli_query($conn,"INSERT INTO memberprofile (memberName, prefixMobile, phoneNum, email, password, vehicleNo, vehicleModel, vehicleBrand, vehicleDesc) VALUES ('$memberName','$prefixMobile','$phoneNum','$email','$password','$vehicleNo','$vehicleModel','$vehicleBrand','$vehicleDesc')");
      If ($execute === true) {
         $message = 'New member created successfully, enter cancel to return';
      } else {
         $message = mysqli_error($conn);
      }
   } else {
         $message = 'Email already used or db error, sign-in failed, please use another email!';
   }
}

function validate($value) {
     $tvalue = $value;
     $query = "SELECT * FROM memberprofile WHERE email = '$tvalue'";
     $result = mysqli_query($conn,$query);
     If ($result->num_rows > 0) {
          return false;
      } else {
          return true;
     }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>RideShare Website</title>
  <link rel="icon" href="./images/Logo1.png" sizes="2000x2000" type="image/png">
  <link rel="stylesheet" href="./css/styles.css">
  <script src="./js/javascript.js"></script>
</head>
<body>
  <header id="mainHeader">
    <div class="container">
        <h1>Ride Share Website</h1>
    </div>
  </header>

  <nav id="mainNav">
    <div class="container">
      <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="about.html">About</a></li>
        <li><a href="contact.html">Contact</a></li>
        <li><a href="signin.php">Sign in/up</a></li>
      </ul>
    </div>
  </nav>

  <section id="jumbo">
    <div class="container">
      <h1>Let's Start a RideShare</h1>
      <p>Sharing a ride has numerous benefits such as reducing traffic congestion and parking demands. Ridesharing also helps to eliminate vehicle emissions and creates less stressful commutes. </p>
    </div>
  </section>
  
   
   <div class="container">
      <div id="main">
        <h2>Sign up, for new member </h2>
        <span id="error_message" style = "color:red"></span>  
        <br> 
    <form method="post" onSubmit="return signup_validate()" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">


    <!-- <form action="#" method="post"> -->
          <span id="lab">Name : </span><input type="text" id="name" name ="memberName" required placeholder="input your name" /><br>
          <span id="lab">Mobile prefix : </span><input type="text" id="mobile_prefix" name="prefixMobile" required placeholder="input mobile prefile +49" /><br>
          <span id="lab">Mobile number : </span><input type="text" id="mobile" name="phoneNum" required placeholder="input mobile numher" /><br>
          <span id="lab">Email : </span><input type="email" name="email" required id="email" placeholder="input email address" /><br>
          <span id="lab">Password : </span><input type="password" id="password" name="password" required placeholder="input your password" /><br>
          <span id="lab">Password (re-input): </span><input type="password" id="rpassword" required placeholder="re-input your password" /><br>
        </br>
    </div>

    <br>
    <button id="VID" onclick="ShowVehicleInformation()">hide - Vehicle Information</button>

    <div id="main">
      <div id="VehicleInformation">
      <h3>For Driver only, Vehicle Information </h3>
        <span id="lab">Vehicle No : </span><input type="text" name="vehicleNo" placeholder="input Vehicle no" /><br>
        <span id="lab">Vehicle Model : </span><input type="text" name="vehicleModel" placeholder="input Vehicle Model" /><br>
        <span id="lab">Vehicle Brand : </span><input type="text" name="vehicleBrand" placeholder="input Vehicle Brand" /><br>
        <span id="lab">Vehicle Description : </span><input type="text" name="vehicleDesc" placeholder="input Vehicle Description" /><br>
        <br>
        </div>

        <input type="submit" class="button" value="Save and return"/>        
        <!-- <input type="submit" class="button" value="Log in"/> -->
        <!-- <a href="signin.php" class="button">Save and retrn</a> -->
          <a href="index.php" class="button">cancel</a></br>       
        </br>

        </form>
        </br>
      </div>
    <div class="clearFix"></div>
  </div>

  
  <footer id="mainFooter">
    <p>Copyright &copy; 2023 RideShare Website  </p>
    <p>Imprint</p>
    <p>This website is student lab work and does not necessarily reflect Constructor University Bremen opinions. Constructor University Bremen does not endorse this site, nor is it checked by Constructor University regularly, nor is it part of the official Constructor University Bremen web presence. </p>
  </footer>
</body>
</html>