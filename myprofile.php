
<?php
include ("database.php");
session_start();
If (empty($_SESSION["MID"])) {
  $_SESSION["MESSAGE"] = "Not yet sign in, please sign in.";
  header ("location: /index.php");
  exit();
} else {
  $MID = $_SESSION["MID"];
}

$table = "memberprofile";
try {
foreach($conn->query("SELECT * FROM $table where MID = $MID") as $row) {
  //echo "<li>" . $row['memberName'] . "</li>";
  $memberName = $row['memberName'];
  $MID =$row['MID'];
  $email = $row['email'];
  $prefixMobile = $row['prefixMobile'];
  $phoneNum = $row['phoneNum'];
  $vehicleNo = $row['vehicleNo'];
  $vehicleModel = $row['vehicleModel'];
  $vehicleBrand = $row['vehicleBrand'];
  $vehicleDesc = $row['vehicleDesc'];
}
} catch (PDOException $e) {
  print "Error!: " . $e->getMessage() . "<br/>";
  die();
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
        <h1>Ride Share Website : My Profile </h1>
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
    <div id="main">
      <h2>View My Profile</h2>
        </br>
        <span id="lab">Member ID : </span> <?php echo($MID) ?> </br>
        <span id="lab">Name : </span> <?php  echo($memberName) ?></br>
        <span id="lab">Mobile-prefix : </span> <?php echo($prefixMobile) ?> </br>
        <span id="lab">Mobile no : </span> <?php echo($phoneNum) ?> </br>
        <span id="lab">email : </span> <?php echo($email) ?> </br>
        </br>
    </div>
    <div id="main">
      <h3>For Driver only, Vehicle Information </h3>
      <span id="lab">Vehicle No : </span> <?php echo $vehicleNo ?> </br>
      <span id="lab">Vehicle Modle : </span> <?php echo $vehicleModel ?></br>
      <span id="lab">Vehicle Brand : </span> <?php echo $vehicleBrand ?></br>
      <span id="lab">Vehicle Description : </span> <?php echo $vehicleDesc ?> </br>
      <br>
    </div>  
    <div id="main">
        <a href="edmyprofile.php" class="button">edit</a>
        <?php 
           $driverpassenger = $_SESSION["driverpassenger"];
           if ($driverpassenger == "Driver") {
              ?>
              <a href="myrideshare.php" class="button">return</a>
              <?php
           } else {
              ?>
              <a href="myridetrip.php" class="button">return</a>
              <?php
           }
           ?>
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