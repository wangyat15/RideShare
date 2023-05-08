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
    $NoOfPassengers = $_POST["NoOfPassengers"];
    $Fare = $_POST["Fare"];
    $RemarksToDriver = $_POST['RemarksToDriver'];
    $query = "INSERT INTO ridetrip (MID, Date, Time, Status, StartLocation, StartLaCoordinate, StartLoCoordinate, Destination, DestLaCoordinate, DestLoCoordinate, NoOfPassengers, Fare, RemarksToDriver) VALUES ($MID, '$Date', '$Time', '$Status', '$StartLocation', '$StartLaCoordinate', '$StartLoCoordinate', '$Destination', '$DestLaCoordinate', '$DestLoCoordinate', $NoOfPassengers, $Fare, '$RemarksToDriver')";
    $execute = mysqli_query($conn,$query);
    if ($execute == true) {
      if ($SID != 0) {
        // get the primary from the last insert row into ridetrip
        $query = "select * from ridetrip where TID =(SELECT LAST_INSERT_ID())";
        $result0 = mysqli_query($conn, $query);
        $row0 = mysqli_fetch_array($result0);
        $TID = $row['TID'];
        $query = "INSERT INTO pendingrequest (SID,TID,RequestStatus,SendBy) VALUES ($SID, $TID, $RequestStatus, $SendBy)";
        $execute1 =  mysqli_query($conn,$query);
      }
      $_SESSION["message"] = "Data insert is successfully";
    } else {
      $_SESSION["message"] = "Failed to insert";
    }
    if ($_SESSION["from_menu"] == 0) { //      Sign up from detailrs.php
      header("location: ./myridetrip.php");
      exit();
    } else {
        header("location: ./myridetrip.php");
        exit();
    }
  } else {  // first page load
    if ($_SESSION["from_menu"] == 0) {   // from detailrs.php
      $SID = $_SESSION["SID"];
      $result = mysqli_query($conn,"SELECT * FROM rideshare WHERE SID = $SID");
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
      $FarePerSeat = $row["FarePerSeat"];
      $Fare = $FarePerSeat;
      $NoOfPassengers = 1;
      $RemarksToDriver = "";
      $RequestStatus = 1;
      $SendBy = 2;  // send by passenger
    } else {
      $SID = 0;
      $Date = date('Y-m-d') ;
      $Time = date('H:i:s');
      $Status = 1;
      $StartLocation = "";
      $StartLaCoordinate = 53.1670277;
      $StartLoCoordinate = 8.6516237;
      $Destination = "";
      $DestLaCoordinate = 53.0479714;
      $DestLoCoordinate = 8.7858737;
      $FarePerSeat = 0;
      $Fare = 0;
      $NoOfPassengers = 1;
      $RemarksToDriver = "";
      $RequestStatus = 1;
      $SendBy = 2;  // send by passenger
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
  // Show the starting and destination path on map1
  tlat = <?php echo $StartLaCoordinate ?>;
  tlat1 = <?php echo $DestLaCoordinate ?>;
  tLng = <?php echo $StartLoCoordinate ?>;
  tLng1 = <?php echo $DestLoCoordinate ?>;
  var myLatLng = { lat: tlat, lng: tLng};  // Start location
  var myLatLng1 = { lat: tlat1, lng: tLng1 }; // Destination
  var vlatA = 53.1670277; // origin location
  var vlongA = 8.6516237;  
  var vlatB = 53.1670277; // destination location
  var vlongB = 8.6516237;  
  if (navigator.geolocation) {    
//        navigator.geolocation.getCurrentPosition(function(sPosition){
//        vlat = sPosition.coords.latitude;
//        vlong = sPosition.coords.longitude;
        var vlat = tlat; // default location at Jacobs University
        var vlong = tlng;  
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
  
  // share ride details and path on map, from driver
    var myLatLng = { lat: 53.1670277, lng: 8.6515237};  // Jacobs University
    var myLatLng1 = { lat: 53.0479714, lng: 8.7858737 }; // Bremen Airport
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
    <div class="main">
      <div id="sideleft">
         <h2>Add a new RideTrip by passenger</h2>
         <p>Enter the start and destination addresses to show the driving path, distance and duration on the Map</p>
         <form method="post" onSubmit="return add_validate();" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
           <span id="lab"> Date : </span> <input type ="date" id="date" required name="Date" value="<?php echo !empty($Date)? $Date:''; ?>">
           <label><span id="lab">Time:</span> <input type="time" id="itime" required name="Time" value="<?php echo !empty($Time)? $Time: '';?>"></label> </br>
           <span id="lab">Fare per passenger in &#8364: </span><input id="fare" type="text" required name="Fare" value="<?php echo !empty($Fare)? $Fare : 0; ?>" placeholder="input fare" > 
           <br/>
           <span id="lab">Number of passengers: </span><input type="text" id="npassenger" required name="NoOfPassengers" value="<?php echo !empty($NoOfPassengers)? $NoOfPassengers : 0; ?>" placeholder="input number of passengers"> 
           <br/>
           <span id=lab>Start location:</span> <input type="text" id="start_address" name="StartLocation" value="<?php echo $StartLocation; ?>" placeholder="Enter start address (w autocomplete)" style="width: 400px" maxlength="400"/> <br>
           <span id=lab>Destination:</span> <input type="text" id="end_address" name="Destination" value="<?php echo $Destination; ?>" placeholder="Destination address (w autocomplete)" style="width: 400px" maxlength="400"/> 
           <br>
          <span id="lab">Passenger note to driver: </span><input type="text" id="note" style="width: 400px" name="RemarksToDriver" value="<?php echo $RemarksToDriver; ?>" placeholder="input any note to driver" > 
           </br> </br>
           <!-- <input type="submit" class="button" value="Save and send request to Driver"> -->
<!--           <a class="button" href="myridetrip.html">Save and send request</a> -->
          <input type="submit" class="button" value="Save and Send Request"> 
          <?php
          if ($_SESSION["from_menu"] == 0 ) {  // from detailrs.php
             ?>
            <a href="myridetrip.php" class="button">Cancel </a>
            <?php
          } else {
            ?>
            <a href="myridetrip.php" class="button">Cancel </a>
            <?php
         }
         ?>
           <br>
           <span id="error_message" style = "color:red"></span>
          </br>
<!--         </form> -->
      </div>
      <div id="sideright">
        <section id="msg1" style= "font-weight:bold;"></section>
        <div id="map1" style="height: 500px;"></div>
      </div>
      </div>
    <div class="clearFix"></div>
<!--
    <div id="Detail">
    <aside id="sideleft">
 
      <h2>Share Ride Detail</h2></br>
      <section id="main">
        <h3>Share Ride Information: </h3>
        <span id="lab">SRide ID:</span> S0001111  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <span id="lab">date : </span>1 April 2023  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <span id="lab">Time : </span> 11:00am</br>
        <span id="lab">Start location :</span> Jacobs University Bremen </br>
        <span id="lab">Destination : </span>Bremen Airport </br>
        <span id="lab">Fare : </span>&#8364;100  &nbsp;&nbsp;&nbsp;&nbsp; 
        <span id="lab">No. of available seats: </span> 3 </br>
        <span id="lab">Driver message: </span>wait at main gateway </br>
      </section>
      <section id="main">
        <h3>Driver and Vehicle Information: </h3>
        <span id="lab">Driver name: </span>Peter Lee  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
        <span id="lab">Member ID: </span>M0002030</br>
        <span id="lab">Vehicle Model:</span> 408i &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  <span id="lab">Brand : </span>BMW </br>
        <span id="lab">Vehicle Desc: </span>blue color </br>
        <span id="lab">Rating (average/no. of ratings) : </span> 4.3 / 123 
      </section>
    </aside>
    <div id="sideright">
      <section id="msg" style= "font-weight:bold;"></section>
      <section>
      <h3>Driving path and map</h3>
      <div id="map" style="height: 430px;"></div>
      </section>
    </div>
    </div>
-->
    <div class="clearFix"></div>
    </div>
  </div>
 
  <footer id="mainFooter">
    <p>Copyright &copy; 2023 RideShare Website  </p>
    <p>Imprint</p>
    <p>This website is student lab work and does not necessarily reflect Constructor University Bremen opinions. Constructor University Bremen does not endorse this site, nor is it checked by Constructor University regularly, nor is it part of the official Constructor University Bremen web presence. </p>
  </footer>
</body>
</html>