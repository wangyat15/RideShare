<?php
  include("database.php");
  session_start();
  $_SESSION["message"] = "";
  $MID = $_SESSION["MID"];
  $Status = 1;
  if ((!empty($_POST['StartLocation'])) and (!empty($_POST['Destination']))) {
    $_SESSION["message"] = "";
    $Date = $_POST["Date"];
    $Time = $_POST["Time"];
    $StartLocation = $_POST["StartLocation"];
    $StartLaCoordinate = 53.1670277;
    $StartLoCoordinate = 8.6516237;
    $Destination = $_POST["Destination"];
    $DestLaCoordinate = 53.0479714 ;
    $DestLoCoordinate = 8.7858737;
    $NoOfSeats = $_POST["NoOfSeats"];
    $FarePerSeat = $_POST["FarePerSeat"];
    $RemarksToPassenger = $_POST['RemarksToPassenger'];
    $NoOfOccupiedSeats = 0;
    $query = "INSERT INTO rideshare (MID, Date, Time, Status, StartLocation, StartLaCoordinate, StartLoCoordinate, Destination, DestLaCoordinate, DestLoCoordinate, NoOfSeats, NoOfOccupiedSeats, FarePerSeat, RemarksToPassenger) VALUES ($MID, '$Date', '$Time', '$Status', '$StartLocation', '$StartLaCoordinate', '$StartLoCoordinate', '$Destination', '$DestLaCoordinate', '$DestLoCoordinate', $NoOfSeats, $NoOfOccupiedSeats, $FarePerSeat, '$RemarksToPassenger')";
    $execute = mysqli_query($conn,$query);
    if ($execute == true) {
      if ($SID != 0) {
        // get the primary from the last insert row into ridetrip
        $query = "select * from rideshare where SID =(SELECT LAST_INSERT_ID())";
        $result0 = mysqli_query($conn, $query);
        $row0 = mysqli_fetch_array($result0);
        $SID = $row['SID'];
        $query = "INSERT INTO pendingrequest (SID,TID,RequestStatus,SendBy) VALUES ($SID, $TID, $RequestStatus, $SendBy)";
        $execute1 =  mysqli_query($conn,$query);
      }
      $_SESSION["message"] = "Data insert is successfully";
    } else {
      $_SESSION["message"] = "Failed to insert";
    }
    if ($_SESSION["from_menu"] == 0) { //      Sign up from detailrs.php
      header("location: ./myrideshare.php");
      exit();
    } else {
        header("location: ./myrideshare.php");
        exit();
    }
  } else {  // first page load
    if ($_SESSION["from_menu"] == 0) {   // from detailrs.php
      $TID = $_SESSION["TID"];
      $result = mysqli_query($conn,"SELECT * FROM ridetrip WHERE TID = $TID");
      $row = mysqli_fetch_array($result);
      $Date = $row["Date"];
      $Time = $row["Time"];
      $Status = 1;
      $StartLocation = $row["StartLocation"];
      $StartLaCoordinate = $row["StartLaCoordinate"];
      $StartLoCoordinate = $row["StartLoCoordinate"];
      $Destination = $row["Destination"];
      $DestLaCoordinate = $row["DestLaCoordinate"];
      $DestLoCoordinate = $row["DestLoCoordinate"];
      $Fare = $row["Fare"];
      $NoOfPassengers = 1;
      $RemarksToPassenger = "";
      $RequestStatus = 1;
      $SendBy = 1;  // send by passenger
    } else {
      $TID = 0;
      $Date = date('Y-m-d') ;
      $Time = date('H:i:s');
      $Status = 1;
      $StartLocation = "";
      $StartLaCoordinate = 53.1670277;
      $StartLoCoordinate = 8.65162370;
      $Destination = "";
      $DestLaCoordinate = 53.0479714;
      $DestLoCoordinate = 8.7858737;
      $Fare = 0;
      $Fare = 0;
      $NoOfSeats = 1;
      $RemarksToPassenger = "";
      $RequestStatus = 1;
      $SendBy = 1;  // send by passenger
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
  <script src="./js/jquery.js"></script>
  <script async src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC9mWeGiZ7Ig1M3q-QWmbU6cM0JEx8yF2c&libraries=places&callback=initMap"></script>

  <script language="javascript" type="text/javascript"> 
  var tlat = 0;
  var tlat1 = 0;
  var tlng = 0;
  var tlng1 = 0;
    function initMap() {
      tlat = <?php echo $StartLaCoordinate ?>;
      tlat1 = <?php echo $DestLaCoordinate ?>;
      tLng = <?php echo $StartLoCoordinate ?>;
      tLng1 = <?php echo $DestLoCoordinate ?>;
      // Show the starting and destination path on map1
      var vlatA = 53.1670277; // origin location
      var vlongA = 8.6516237;  
      var vlatB = 53.1670277; // destination location
      var vlongB = 8.6516237;  
      if (navigator.geolocation) {    
    //        navigator.geolocation.getCurrentPosition(function(sPosition){
    //        vlat = sPosition.coords.latitude;
    //        vlong = sPosition.coords.longitude;
            var vlat = 53.1670277; // default location at Jacobs University
            var vlong = 8.6516237;  
            var map1 = new google.maps.Map(document.getElementById('map1'), {
              zoom: 16,
              center: {lat: vlat, lng: vlong}
            });
            var input = document.getElementById('start_address');
            var input1 = document.getElementById('end_address');
            var autocomplete;
            var autocomplete1;
            autocomplete = new google.maps.places.Autocomplete(input), {
              types: ['geocode']};
            autocomplete1 = new google.maps.places.Autocomplete(input1), {
              types: ['geocode']};
    
            autocomplete.bindTo('bounds', map1);
            autocomplete1.bindTo('bounds',map1);
    
            var marker = new google.maps.Marker({
              map: map1,
              anchorPoint: new google.maps.Point(0, -29)
            });
            var marker1 = new google.maps.Marker({
              map: map1,
              anchorPoint: new google.maps.Point(0, -29)
            }); 
            // starting location and show the location on Map
            autocomplete.addListener('place_changed', function() {
              marker.setVisible(false);
              var place = autocomplete.getPlace();
              if (!place.geometry) {
                window.alert("No details available for input: '" + place.name + "'");
                return;
              }
    
              if (place.geometry.viewport) {
                map1.fitBounds(place.geometry.viewport);
              } else {
                map1.setCenter(place.geometry.location);
                map1.setZoom(17);
              }
              marker.setPosition(place.geometry.location);
              marker.setVisible(true);
    
              var start_address = '';
              if (place.address_components) {
                start_address = [
                  (place.address_components[0] && place.address_components[0].short_name || ''),
                  (place.address_components[1] && place.address_components[1].short_name || ''),
                  (place.address_components[2] && place.address_components[2].short_name || '')
                ].join(' ');
              }
              
              var infowindow = new google.maps.InfoWindow({
                content: '<div><strong>' + start_address + '</strong><br>' +
                    'Latitude: ' + place.geometry.location.lat() + '<br>' +
                    'Longitude: ' + place.geometry.location.lng() + '</div>'
              });
              infowindow.open(map1, marker);     
              vlatA = place.geometry.location.lat();
              vlongA = place.geometry.location.lng();       
            });
    
            // destination location and show the driving path and distance 
            autocomplete1.addListener('place_changed', function() {
              marker1.setVisible(false);
              var place1 = autocomplete1.getPlace();
              if (!place1.geometry) {
                window.alert("No details available for input: '" + place1.name + "'");
                return;
              }
              vlatB = place1.geometry.location.lat();
              vlongB = place1.geometry.location.lng();
              // show the driving path from origin to destination
              var myLatLngA = { lat: vlatA, lng: vlongA};  // origin lat, long
              var myLatLngB = { lat: vlatB, lng: vlongB}; // destination lat, long
              var directionsDisplay1;
              var directionsService1 = new google.maps.DirectionsService();
              directionsDisplay1 = new google.maps.DirectionsRenderer();
              var mapOptions = {
                zoom: 15,
                center: myLatLngA,
              };
              map1 = new google.maps.Map(document.getElementById('map1'), mapOptions);
              directionsDisplay1.setMap(map1);
              var start1 = new google.maps.LatLng(myLatLngA);
              var end1 = new google.maps.LatLng(myLatLngB);
              var request1 = {
                origin: start1,
                destination: end1,
                travelMode: google.maps.TravelMode.DRIVING
              };
              directionsService1.route(request1, function(response, status) {
                if (status == google.maps.DirectionsStatus.OK) {
                  directionsDisplay1.setDirections(response);
                  directionsDisplay1.setMap(map1);          
                  var directionsData1 = response.routes[0].legs[0]; // Get data about the mapped route
                  if (!directionsData1){
                    alert("Directions request failed");
                  } else {
                    document.getElementById("msg1").innerHTML = "Driving Distance(time): "+ directionsData1.distance.text + "(" + directionsData1.duration.text + ")";
                  }
                        
                } else {
                  alert("Directions Request from " + start1.toUrlValue(6) + " to " + end1.toUrlValue(6) + " failed: " + status);
                }
              });
            });
    //      }); // for getCurrentPosition
         }   
           else {
             alert("Geolocation is not supported by this browser.");
         }
     }
  </script>
  
</head>
<body onload="initMap()">
  <header id="mainHeader">
    <div class="container">
        <h1>Ride Share Website : Driver</h1>
    </div>
  </header>
  <nav id="mainNav">
    <div class="container">
      <ul>
        <li><a href="myrideshare.php">MyRideShare</a></li>
        <li><a href="searchforrt.php">SearchForPassenger</a></li>
        <li><a href="addrs.php">AddRideShare</a></li>
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
    <div class="main">
      <div id="sideleft">
         <h2>Add a new Ride Share and send a request to passenger by driver</h2>
         <p>Enter the start and destination addresses to show the driving path, distance and duration on the Map</p>
<!--         <form action="#" method="post"> -->
        <form method="post" onSubmit="return addshare_validate();" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
           <span id="lab"> Date : </span> <input type ="date" id="date" required name="Date" value="<?php echo !empty($Date)? $Date:''; ?>">
           <span id="lab"> Time : </span> <input type ="time" id="itime" required step="any" name="Time" value="<?php echo !empty($Time)? $Time:''; ?>">
           <span id="lab">Fare per passenger in &#8364: </span><input type="text" id="fare" required name="FarePerSeat" value="<?php echo !empty($FarePerSeat)? $FarePerSeat:''; ?>" placeholder="input fare" /> 
           <br/>
           <span id="lab">Number of seats: </span><input type="text" id="nseat" name="NoOfSeats" value="<?php echo !empty($NoOfSeats)? $NoOfSeats:''; ?>" required placeholder="input number of seats" value="1"/> 
           <br/>
           <span id="lab">Start location:</span> <input type="text" id="start_address" name="StartLocation" value="<?php echo !empty($StartLocation)? $StartLocation:''; ?>" required placeholder="Enter start address (w autocomplete)" style="width: 400px" maxlength="400"/> </br>

           <span id="lab">Destination:</span> <input type="text" id="end_address" name="Destination" required  value="<?php echo !empty($Destination)? $Destination:''; ?>" placeholder="Enter destination address (w autocomplete)" style="width: 400px" maxlength="400"/> </br>
           <span id="lab">note to passenger: </span><input type="text" required name="RemarksToPassenger" value="<?php echo !empty($RemarksToPassenger)? $RemarksToPassenger:''; ?>" placeholder="input any note to passenger" style="width: 500px" maxlength="500" /> 
           </br> </br>
           <!-- <input type="submit" class="button" value="Save and send request to Driver"> -->
<!--           <a class="button" href="myrideshare.html">Send request and return</a>
           <input type="cancel" class="button" value="Cancel">  -->
          </br>
        </br>
        <input type="submit" class="button" value="Save and send request">
        <a class="button" href="myrideshare.php">Cancel</a> 
        <br>
        <span id="error_message" style = "color:red"></span>

<!--         </form> -->
      </div>
      <div id="sideright">
        <section id="msg1" style= "font-weight:bold;"></section>
        <div id="map1" style="height: 500px;"></div>
      </div>
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