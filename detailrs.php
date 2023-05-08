<?php
 session_start();
 if ($_SESSION["SID"] == 0) {
   $SID = $_GET['sid'];
   $_SESSION["SID"] = $SID;
 } else {
   $SID = $_SESSION["SID"];
 }
 include("database.php");
 //echo $SID;
 //echo '<script>alert("Testing")</script>';
 $result = mysqli_query($conn,"SELECT * FROM rideshare WHERE SID = $SID");
 $record = mysqli_fetch_array($result);
 $MID = $record['MID'];
 $lat = $record['StartLaCoordinate'];
 $Lng = $record['StartLoCoordinate'];
 $lat1 = $record['DestLaCoordinate'];
 $Lng1 = $record['DestLoCoordinate'];
 $mresult = mysqli_query($conn,"SELECT * FROM memberprofile WHERE MID = $MID");
 $mrecord = mysqli_fetch_array($mresult);
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
  <script src="./js/jquery.js"></script>
  <script async src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC9mWeGiZ7Ig1M3q-QWmbU6cM0JEx8yF2c&libraries=places&callback=initMap"></script>
  <script language="javascript" type="text/javascript"> 
  var tlat = 0;
  var tlat1 = 0;
  var tlng = 0;
  var tlng1 = 0;
  function initMap() {
    tlat = <?php echo $lat ?>;
    tlat1 = <?php echo $lat1 ?>;
    tLng = <?php echo $Lng ?>;
    tLng1 = <?php echo $Lng1 ?>;
    var myLatLng = { lat: tlat, lng: tLng};  // Start location
    var myLatLng1 = { lat: tlat1, lng: tLng1 }; // Destination
    var directionsDisplay;
    var directionsService = new google.maps.DirectionsService();
    var map;
    directionsDisplay = new google.maps.DirectionsRenderer();
    var mapOptions = {
      zoom: 15,
      center: myLatLng,
    };
    map = new google.maps.Map(document.getElementById('map'), mapOptions);
    directionsDisplay.setMap(map);

    var start = new google.maps.LatLng(myLatLng);
    var end = new google.maps.LatLng(myLatLng1);
    var ddist = 'distance';
    var dtime = 'time';
    var request = {
      origin: start,
      destination: end,
      travelMode: google.maps.TravelMode.DRIVING
    };

    directionsService.route(request, function(response, status) {
      if (status == google.maps.DirectionsStatus.OK) {
        directionsDisplay.setDirections(response);
        directionsDisplay.setMap(map);
        
         var directionsData = response.routes[0].legs[0]; // Get data about the mapped route
        if (!directionsData){
          alert("Directions request failed");
        } else {
          document.getElementById("msg").innerHTML = "Driving Distance(time): "+ directionsData.distance.text + "(" + directionsData.duration.text + ")";
        }            
      } else {
        alert("Directions Request from " + start.toUrlValue(6) + " to " + end.toUrlValue(6) + " failed: " + status);
      }
    });
 }
</script>

</head>
<body onload="initMap()">
  <header id="mainHeader">
    <div class="container">
        <h1>Ride Share Website</h1>
    </div>
  </header>

  <nav id="mainNav">
    <div class="container">
      <ul>
      <?php
         if (empty($_SESSION["MID"])) {  // not yet sign in
            ?>
            <li><a href="index.php">Home</a></li>
            <li><a href="about.html">About</a></li>
            <li><a href="contact.html">Contact</a></li>
            <li><a href="signin.php">Sign in/up</a></li>
          <?php
          } else {
          ?>
            <li><a href="myridetrip.php">MyRideTrip</a></li>
            <li><a href="searchforrs.php">SearchForRide</a></li>
            <li><a href="addrt.php">AddRideTrip</a></li>
            <li><a href="myprofile.php">MyProfile</a></li>
            <li><a href="signout.php">SignOut</a></li>
          <?php
          }
          ?>
      </ul>
    </div>
  </nav>
  <?php
    if (empty($_SESSION["MID"])) {  // not yet sign in
      ?>
      <section id="jumbo">
        <div class="container">
          <h1>Let's Start a RideShare</h1>
          <p>Sharing a ride has numerous benefits such as reducing traffic congestion and parking demands. Ridesharing also helps to eliminate vehicle emissions and creates less stressful commutes. </p>
        </div>
      </section>
      <?php
      }
      ?>
  
   
   <div class="container">
    <aside id="sideleft">
      <h2>Share Ride Detail</h2></br>
      <section id="main">
        <h3>Share Ride Information: </h3>
        <span id="lab">SRide ID:</span> <?php echo $record['SID']; ?>  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <span id="lab">date : </span> <?php echo $record['Date']; ?>  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <span id="lab">Time : </span> <?php echo $record['Time']; ?></br>
        <span id="lab">Start location :</span> <?php echo $record['StartLocation']; ?> </br>
        <span id="lab">Destination : </span><?php echo $record['Destination']; ?> </br>
        <span id="lab">Fare : </span>&#8364;<?php echo $record['FarePerSeat']; ?>  &nbsp;&nbsp;&nbsp;&nbsp; 
        <span id="lab">No. of available seats: </span> <?php echo $record['NoOfSeats']-$record['NoOfOccupiedSeats']; ?> </br>
        <span id="lab">Driver message: </span><?php echo $record['RemarksToPassenger']; ?> gateway </br>
      </section>
      <section id="main">
        <h3>Driver and Vehicle Information: </h3>
        <span id="lab">Driver name: </span><?php echo $mrecord['memberName']; ?>  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
        <span id="lab">Member ID: </span><?php echo $mrecord['MID']; ?></br>
        <span id="lab">Vehicle Model:</span> <?php echo $mrecord['vehicleModel']; ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  <span id="lab">Brand : </span><?php echo $mrecord['vehicleBrand']; ?> </br>
        <span id="lab">Vehicle Desc: </span><?php echo $mrecord['vehicleDesc']; ?> </br>
      </section>
    </aside>
    <div id="sideright">
      <section id="msg" style= "font-weight:bold;"></section>
      <section>
      <h3>Driving path and map</h3>
      <div id="map" style="height: 400px;"></div>
      </section>
    </div>
    <div class="clearFix"></div>
    <div id="main">
      <h3>Driver rating and comment history: </h3> 
          <?php
              $rating = mysqli_query($conn,"SELECT AVG(d.rating) as arating FROM rideshare r, memberprofile m, driverrating d WHERE m.MID = r.MID AND r.SID = d.SID AND m.MID = $MID");
              $trating = $rating->fetch_assoc();
              $ttrating = $trating['arating'];
              $padded = sprintf('%0.2f', $ttrating);
              $count = mysqli_query($conn,"SELECT count(*) as acount FROM rideshare r, memberprofile m, driverrating d WHERE m.MID = r.MID AND r.SID = d.SID AND m.MID = $MID");
              $tcount = $count->fetch_assoc();
              $ttcount = $tcount['acount'];
              $padded1= sprintf('%0.2f', $ttcount);
          ?>

      <p><span id="lab">Rating (average / no. of ratings) : </span> <?php echo $padded ?> / <?php echo $padded1 ?> </p>
      <table id="table1">
        <tr>
          <th> &nbsp; </th>
          <th>date</th>
          <th>rating</th>
          <th>comment</th>
        </tr>
        <?php
        $rresult = mysqli_query($conn,"SELECT * FROM rideshare r, memberprofile m, driverrating d WHERE m.MID = r.MID AND r.SID = d.SID AND m.MID = $MID");
        if (mysqli_num_rows($rresult) > 0){
        $i=0;
        while($row = mysqli_fetch_array($rresult)){
        ?>
        <tr>
          <td><?php echo $i+1 ?></td>
          <td><?php echo $row['Date'] ?></td>
          <td><?php
              $trate = $row['rating'];
              $padded2= sprintf('%0.2f', $trate);
              echo $padded2;
              ?>
          </td>
          <td><?php echo $row['comment'] ?></td>
        </tr>
        <?php
         $i++;
        }
        } else {
          echo "No rating records";
        }
        ?>
      </table>
    </div>
    <div id="main">
    <?php
         if (empty($_SESSION["MID"])) {  // not yet sign in
            $_SESSION["from_menu"] = 0; // not from Menu Bar
            ?>
            <a href="index.php" class="button">Return </a>
            <a href="signin.php" class="button">Make Request </a>
            <?php
          } else {
            ?>
            <a href="searchforrs.php" class="button">Return </a>
            <a href="addrt.php" class="button">Make Request </a>
            <?php
         }
         ?>
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