<?php
  include("database.php");
  session_start();
  $MID = $_SESSION["MID"];
  $result = mysqli_query($conn,"SELECT * FROM memberprofile WHERE MID = $MID");
  $record = mysqli_fetch_array($result);
  if (!empty($_POST["driverpassenger"])) {
     $driverpassenger = $_POST["driverpassenger"];
     $_SESSION["driverpassenger"] = $driverpassenger;
     if ($driverpassenger == "Driver") {
        header("location: ./myrideshare.php");
        exit();
     } else {
        header("location: ./myridetrip.php");
        exit();
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
      <section id="main">
        <h2>Successfully Login!  Welcome to Ride Share Website ! </h2>
        <h3> Member ID: <?php echo $record['MID']; ?>&nbsp;&nbsp;&nbsp;&nbsp; Name : <?php echo $record["memberName"]; ?></h3>
        </br></br>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <h3>Successfully signed in.  Welcome to Ride Share Website!</h3>
        <p>Are you a Driver or Passenger? </p>
        <input type="radio" id="passenger" checked name="driverpassenger" 
        value="Passenger"> <label for="passenger">Passenger</label><br>
        <input type="radio" id="driver" name="driverpassenger" value="Driver">  <label for="driver">Driver</label><br>
        
        </br>          
        </br>
        <input type="submit" class="button" value="Continue""/> 
        </form>
        </br></br>
        </br>
      </section>
     
    
    
    <div class="clearFix"></div>

  </div>

  
  <footer id="mainFooter">
    <p>Copyright &copy; 2023 RideShare Website  </p>
    <p>Imprint</p>
    <p>This website is student lab work and does not necessarily reflect Constructor University Bremen opinions. Constructor University Bremen does not endorse this site, nor is it checked by Constructor University regularly, nor is it part of the official Constructor University Bremen web presence. </p>
  </footer>
</body>
</html>