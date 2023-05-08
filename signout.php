<?php
  session_start();
  $_SESSION["MID"] = "";
  $_SESSION["email"] = "";
  session_destroy();
  header("location: ./index.php");
?>
