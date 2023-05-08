<?php
  session_start();
  $_SESSION["MID"] = ""; // global variable to indicate not yet sign in
  $_SESSION["from_menu"] = 1; //global variable to indicate action from Menu 
  $_SESSION["SID"] = 0;
  $_SESSION["TID"] = 0;
  include("database.php");
  $_POST['sStartLocation'] = "";  // disable search option for testing 
  if (!empty($_POST['sStartLocation'])) {
    $sDate = $_POST['sDate'];
    $sTime = $_POST['sTime'];
    $sStartLocation = $_POST['sStartLocation'];
    $result = mysqli_query($conn,"SELECT * FROM rideshare WHERE Date = '$sDate' AND Time = '$sTime' AND StartLocation = '$sStartLocation'");
  } else {           // seach for all rideshare records
      $sDate = date('Y-m-d');
      $sTime = date('H:i:s');
      $result = mysqli_query($conn,"SELECT * FROM rideshare");
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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="./js/javascript.js"></script>
  <script src="./js/jquery.js"></script>
  <script async src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC9mWeGiZ7Ig1M3q-QWmbU6cM0JEx8yF2c&libraries=places&callback=initMap"></script>
    
  <script language="javascript" type="text/javascript"> 
    function initMap() {
      if (navigator.geolocation) {    
//        navigator.geolocation.getCurrentPosition(function(sPosition){  // get current location, only support with https
//        vlat = sPosition.coords.latitude;
//        vlong = sPosition.coords.longitude;
        var vlat = 53.1670277; // default location at Jacobs University
        var vlong = 8.6516237;  
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 16,
          center: {lat: vlat, lng: vlong}
        });
        var input = document.getElementById('address');
        var autocomplete;
        autocomplete = new google.maps.places.Autocomplete(input), {
          types: ['geocode']};
        autocomplete.bindTo('bounds', map);
        var marker = new google.maps.Marker({
          map: map,
          anchorPoint: new google.maps.Point(0, -29)
        });

        autocomplete.addListener('place_changed', function() {
          marker.setVisible(false);
          var place = autocomplete.getPlace();
          if (!place.geometry) {
            window.alert("No details available for input: '" + place.name + "'");
            return;
          }

          if (place.geometry.viewport) {
            map.fitBounds(place.geometry.viewport);
          } else {
            map.setCenter(place.geometry.location);
            map.setZoom(17);
          }
          marker.setPosition(place.geometry.location);
          marker.setVisible(true);

          var address = '';
          if (place.address_components) {
            address = [
              (place.address_components[0] && place.address_components[0].short_name || ''),
              (place.address_components[1] && place.address_components[1].short_name || ''),
              (place.address_components[2] && place.address_components[2].short_name || '')
            ].join(' ');
          }
          
          var infowindow = new google.maps.InfoWindow({
            content: '<div><strong>' + address + '</strong><br>' +
                'Latitude: ' + place.geometry.location.lat() + '<br>' +
                'Longitude: ' + place.geometry.location.lng() + '</div>'
          });
          infowindow.open(map, marker);
        });

        /* $(document).ready(function() { 
        setCurrentDate()
        });*/
//      });  // for getCurrentPostion
     }   
       else {
         alert("Geolocation is not supported by this browser.");
     }

    }
   
    function setCurrentDate() {
      var now = new Date();
      var day = ("0" + now.getDate()).slice(-2);
      var month = ("0" + (now.getMonth() + 1)).slice(-2);
      var time = now.getHours()+ ":" + now.getMinutes + ":" + now.getSecond();
      var today = now.getFullYear() + "-" + (month) + "-" + (day);
      $('#today').val(today);
      $('#ctime').val(time);
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
    <div id="sideleft">
<!-- <section id="main"> -->
      <h2>Home - Search for a Ride</h2>
<!--      <form action="#" method="post"> -->
        <form method="post" onSubmit="return ivalidate();" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label><span id="lab">Date: </span><input type="date" id="today" name="sDate" value="<?php echo $sDate ?>" title="today"/> </label>
        &nbsp;&nbsp;&nbsp;
        <label><span id="lab">Time:</span> <input type="time" id="ctime" name="sTime" value="<?php echo $sTime ?>">
          &nbsp;&nbsp;&nbsp;
        <span id="lab">Time within:</span>
          <select>
            <option>15 minutes</option>
            <option selected>30 minutes</option>
            <option>60 minutes</option>
            <option>120 minutes or above</option>
          </select>
 
        &nbsp;&nbsp;&nbsp;
        <br>
        <span id="lab">Fare,max(&#8364;0-1000): </span><input type="range" min="0" max="1000" value = "100" 
        oninput="this.nextElementSibling.value = this.value" /> 
        <output>100</output>
        &nbsp;&nbsp;&nbsp;
        <span id="lab">Rating min (0-5):</span> <input type="range" min="0" max="5" value = "0" oninput="this.nextElementSibling.value = this.value" /> 
        <output>0</output>
        <br/>
        <span id=lab>Start location:</span> <input type="text" id=address name="sStartLocation" placeholder="Enter start address (w autocomplete)" style="width: 350px" maxlength="100"/> 
        <span id="lab">Distance within:</span> 
        <select>
          <option>100m</option>
          <option selected>500m</option>
          <option>1km</option>
          <option>2km or above</option>
        </select><br/>
<!--        <a href="index.html" class="button">Search </a></br> -->
        <input type="submit" class="button" value="Search">

        <span id="error_message" style = "color:red"></span>
<!--      </form> -->
    </div>
      <div id="sideright">
        <h3>Location of the start location</h2>
        <div id="map" style="height: 500px;"></div>
      </div>


    <div id="main">
      <h3>List of Available Share Ride (click the link to view the details and make a ride request) </h3>
      <?php
      if (mysqli_num_rows($result) > 0) {
      ?>
      <table id="table1">
        <tr>
          <th>&nbsp;</th>
          <th>SRide ID</th>
          <th>Date&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
          <th>Time</th>
          <th>Start from</th>
          <th>Destination</th>
          <th>Fare&#8364;</th>
          <th>Seats </th>
          <th>Driver rating</th>
        </tr>
        <?php
        $i=0;
        while($row = mysqli_fetch_array($result)){
        ?>
          <?php
              $SID = $row['SID'];
              $MID = $row['MID'];
              $rating = mysqli_query($conn,"SELECT AVG(d.rating) as arating FROM rideshare r, memberprofile m, driverrating d WHERE m.MID = r.MID AND r.SID = d.SID AND m.MID = $MID");
              $trating = $rating->fetch_assoc();
              $ttrating = $trating['arating'];
              $padded = sprintf('%0.2f', $ttrating);
          ?>
          <tr>
          <td><?php echo $i+1 ?></td>
          <td><?php echo '<a href="detailrs.php?sid='.$row['SID']. '">' .$row['SID']. '</a>' ?> </td>
          <td><?php echo '<a href="detailrs.php?sid='.$row['SID']. '">' .$row['Date']. '</a>' ?> </td>
          <td><?php echo '<a href="detailrs.php?sid='.$row['SID']. '">' .$row['Time']. '</a>' ?> </td>
          <td><?php echo '<a href="detailrs.php?sid='.$row['SID']. '">' .$row['StartLocation']. '</a>' ?> </td>
          <td><?php echo '<a href="detailrs.php?sid='.$row['SID']. '">' .$row['Destination']. '</a>' ?> </td>
          <td><?php echo '<a href="detailrs.php?sid='.$row['SID']. '">' .$row['FarePerSeat']. '</a>' ?> </td>
          <td><?php echo '<a href="detailrs.php?sid='.$row['SID']. '">' .$row['NoOfSeats']-$row['NoOfOccupiedSeats']. '</a>' ?> </td>
          <td><?php echo '<a href="detailrs.php?sid='.$row['SID']. '">' .$padded. '</a>' ?> </td>
        </tr>
        <?php
        $i++;
        }
        ?>
      </table>
      <?php
      } else {
        echo "no result found";
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