<?php
// connect MySQL and database rideshare
$hostName = "localhost";
$userName = "ringo";
$password = "496162";
$databaseName = "rideshare";
$conn = new mysqli($hostName,$userName,$password,$databaseName);
//echo '<script>alert("Testing")</script>';
// echo ("test");
if ($conn->connect_error) {
  die("Connection failed:".$conn->connect_error);
} 
?>