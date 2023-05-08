<?php
  session_start();
  include("database.php");
  $MID = $_SESSION["MID"];
  //$MID = 10000002;
  $result0 = mysqli_query($conn,"SELECT * FROM memberprofile WHERE MID = $MID");
  $result2 = mysqli_query($conn,"SELECT * FROM ridetrip r, pendingrequest p, requeststatus s WHERE r.TID = p.TID AND p.RequestStatu = s.RequestStatus AND MID = $MID ORDER BY r.TID DESC");
  $result1 = mysqli_query($conn,"SELECT * FROM ridetrip t, pendingrequest p,rideshare s, requeststatus r WHERE t.TID = p.TID AND p.SID = s.SID AND p.RequestStatu = r.RequestStatus AND s.MID = $MID");
  $row0 = mysqli_fetch_array($result0);
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
</head>
<body>
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
    <div id="main">
      <h3>My Ride Share : Member ID/Name : <?php echo $row0['MID'] ?> / <?php echo $row0['memberName'] ?> </h3>
      <?php
      if (mysqli_num_rows($result1) > 0) {
      ?>
      <table id="table1">
        <tr>
          <th>&nbsp;</th>
          <th>Status</th>
          <th>RShareID</th>
          <th>Date&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
          <th>Time</th>
          <th>Start from</th>
          <th>Destination</th>
          <th>Fare &#8364;</th>
          <th>No. of sits </th>
          <th>Msg to Passenger</th>
        </tr>
        <?php
         $i=0;
         while($row1 = mysqli_fetch_array($result1)){
         ?>
        <tr>
          <td><input type="checkbox"/></td>
          <td> <?php echo $row1['Desc'] ?> </td>
          <td> <?php echo $row1['SID'] ?> </td>
          <td> <?php echo $row1['Date'] ?></td>
          <td> <?php echo $row1['Time'] ?></td>
          <td> <?php echo $row1['StartLocation'] ?> </td>
          <td> <?php echo $row1['Destination'] ?></td>
          <td> <?php echo $row1['FarePerSeat'] ?> </td>
          <td> <?php echo $row1['NoOfSeats'] ?></td>
          <td> <?php echo $row1['RemarksToPassenger'] ?></td>
        </tr>
        <?php
        $i++;
        }
      }
      ?>
      </table>
      <input type="button" class="button" value="Search For Passenger" onclick="GetSelect6()"/>
        <input type="button" class="button" value="View Accepted Passenger" onclick="GetSelect7()"/>
    </div>

    <!-- List of Pending Request Reply of a select RShare -->
    <div id="main">
      <h3>List of Pending Request Reply : </h3>
      <?php
      if (mysqli_num_rows($result2) > 0) {
      ?>
      <table id="table1">
        <tr>
          <th>&nbsp;</th>
          <th>Send by</th>
          <th>Request Status</th>
          <th>RShareID</th>
          <th>SRideID</th>
          <th>Date&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
          <th>Time</th>
          <th>Start from</th>
          <th>Destination</th>
          <th>Fare &#8364;</th>
          <th>Passenger's message</th>
        </tr>
        <?php
         $i=0;
         while($row2 = mysqli_fetch_array($result2)){
         ?>
        <tr>
          <td><input type="checkbox"/></td>
          <td> Passenger</td>
          <td> <?php echo $row2['Desc'] ?></td>
          <td> <?php echo $row2['TID'] ?></td>
          <td> <?php echo $row2['SID'] ?></td>
          <td> <?php echo $row2['Date'] ?></td>
          <td> <?php echo $row2['Time'] ?></td>
          <td> <?php echo $row2['StartLocation'] ?></td>
          <td> <?php echo $row2['Destination'] ?></td>
          <td> <?php echo $row2['Fare'] ?></td>
          <td> <?php echo $row2['RemarksToDriver'] ?> </td>
        </tr>
        <?php
        $i++;
        }
      }
      ?>        
      </table>
      <input type="button" class="button" value="Accept a Pending from Passenger" onclick="GetSelect9()"/>
      <input type="button" class="button" value="Reject a Pending from Passenger" onclick="GetSelect10()"/>
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