<?php
include("database.php");
session_start();
If (empty($_SESSION["MID"])) {
   $_SESSION["MESSAGE"] = "Not yet sign in, please sign in.";
   header ("location: /index.php");
   exit();
} else {
   $MID = $_SESSION["MID"];
}
$result = mysqli_query($conn,"SELECT * FROM memberprofile WHERE MID = $MID");
$record = mysqli_fetch_array($result);
if (!empty($_POST['email'])) {
  $memberName = $_POST["memberName"];
  $prefixMobile = $_POST["prefixMobile"];
  $phoneNum = $_POST["phoneNum"];
  $email = $_POST['email'];
  $vehicleNo = $_POST['vehicleNo'];
  $vehicleModel = $_POST['vehicleModel'];
  $vehicleBrand = $_POST['vehicleBrand'];
  $vehicleDesc = $_POST['vehicleDesc'];
  $query = "UPDATE memberprofile SET email = '$email', phoneNum = '$phoneNum', prefixMobile = '$prefixMobile', memberName = '$memberName',vehicleNo = '$vehicleNo', vehicleModel = '$vehicleModel', vehicleBrand = '$vehicleBrand', vehicleDesc = '$vehicleDesc' WHERE MID = $MID";
  $execute = mysqli_query($conn,$query);
  if ($execute == true) {
    header("location: ./myprofile.php");
  }
} else {  // first page load
    $memberName = $record["memberName"];
    $prefixMobile = $record["prefixMobile"];
    $phoneNum = $record["phoneNum"];
    $email = $record['email'];
    $vehicleNo = $record['vehicleNo'];
    $vehicleModel = $record['vehicleModel'];
    $vehicleBrand = $record['vehicleBrand'];
    $vehicleDesc = $record['vehicleDesc'];
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
        <h1>Ride Share Website : Passenger</h1>
    </div>
  </header>
  <nav id="mainNav">
    <div class="container">
      <ul>
        <li><a href="myridetrip.php">MyRideTrip</a></li>
        <li><a href="searchforrs.php">SearchForRide</a></li>
        <li><a href="addrt.php">AddRideTrip</a></li>
        <li><a href="myprofile.php">MyProfile</a></li>
        <li><a href="signout.php">SignOut</a></li>
      </ul>
    </div>
  </nav>
  <!--
  <section id="jumbo">
    <div class="container">
      <h1>Let's Start a RideShare</h1>
      <p>Sharing a ride has numerous benefits such as reducing traffic congestion and parking demands. Ridesharing also helps to eliminate vehicle emissions and creates less stressful commutes. </p>
    </div>
  </section>
  -->
   
   <div class="container">
    <!-- <button onclick="ShowProfile()">Edit My Profile</button> -->
    <div id="main">
      <h2>Edit My Profile</h2>
      <span id="error_message" style = "color:red"></span>  
        <br> 

        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" onSubmit="return edprofile_validate()">

      <!--  <Form > -->
          <span id="lab">Member ID : </span> <?php echo $MID ?> <br>
          <span id="lab">Name : </span><input type="text" id="name" name="memberName" value="<?php echo $memberName ?>"

          <span id="lab">Mobile prefix : </span><input type="text" id="mobile_prefix" name="prefixMobile" value="<?php echo $prefixMobile ?>" required /><br>
          <span id="lab">Mobile number : </span><input type="text" id="mobile" name="phoneNum" value="<?php echo $phoneNum ?>" required placeholder="input mobile numher" /><br>
          <span id="lab">Email : </span><input type="email" id="email" name="email" value="<?php echo $email ?>" required placeholder="input email address" /><br>
       <!-- </Form> -->
        </br>
    </div>

    <br>
    <button id="VID" onclick="ShowVehicleInformation()">hide - Vehicle Information</button>

    <div id="VehicleInformation">
    <div id="main">
      <h3>For Driver only, Vehicle Information </h3>
        <span id="lab">Vehicle No : </span><input type="text" name="vehicleNo" value="<?php echo $vehicleNo ?>" placeholder="input Vehicle no" /><br>
        <span id="lab">Vehicle Model : </span><input type="text" name="vehicleModel" value="<?php echo $vehicleModel ?>" placeholder="input Vehicle Model" /><br>
        <span id="lab">Vehicle Brand : </span><input type="text" name="vehicleBrand" value="<?php echo $vehicleBrand ?>" placeholder="input Vehicle Brand" /><br>
        <span id="lab">Vehicle Description : </span><input type="text" name="vehicleDesc" value="<?php echo $vehicleDesc ?>" placeholder="input Vehicle Description" /><br>
    </div>  
    </div>
    <div id="main">
    <input type="submit" class="button" value="Save and return"/>   
      <!-- <a href="myprofile.html" class="button">Save and return</a> -->
        <a href="myprofile.php" class="button">Cancel</a>
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