<?php
  include("database.php");
  session_start();
  $_SESSION["message"] = "";
  if (!empty($_POST['email_name']) and (!empty($_POST['password']))) {
    $_SESSION["message"] = "";
    $email = $_POST["email_name"];
    $password = $_POST["password"];
    $result = mysqli_query($conn,"SELECT * FROM memberprofile WHERE email = '$email' AND password = '$password'");
    if ($result->num_rows > 0) {
      $row = mysqli_fetch_array($result);
      $_SESSION["MID"] = $row["MID"];
      $_SESSION["email"] = $row["email"];
      if ($_SESSION["from_menu"] == 0) { //      Sign up from detailrs.php
         header("location: ./addrt.php");
         exit();
      } else {
        header("location: ./DriverPassenger.php");
        exit();
      }
    } else {
      $_SESSION["message"] = "incorrect email or password, failed sign in, please try again";
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
      <section id="main">
        <h2>Sign in </h2>
        <form method="post" onSubmit="return validate();" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
          <div>
          <label for="lab">Email:</label>&nbsp;&nbsp;&nbsp;<span id="email_info" style = "color:red" ></span>
          </div>
          <div>  
            <input type="email" name="email_name" id="email" placeholder="input email" /> </br>
          </div>
          <div>
          <label for="lab">Password: </label>&nbsp;&nbsp;&nbsp;<span id="password_info" style = "color:red" ></span>
          </div>
          <div>
            <input type="password" name="password" id="password" placeholder="input password"/></br>
          </div>
          <br>
          <br>
          
             <!-- <input type="submit" class="button" value="Sign in" onclick="return validate()"/> -->

          <input type="submit" class="button" value="Sign in""/> 
          <?php
          if ($_SESSION["from_menu"] == 0 ) {  // from detailrs.php
            $_SESSION["return_from"] = 1;
            ?>
            <a href="detailrs.php" class="button">Cancel </a>
            <?php
          } else {
            ?>
            <a href="index.php" class="button">Cancel </a>
            <?php
         }
         ?>
        </br>
        <?php
             if (!empty($_SESSION["message"])) {
                ?>
                <span style = "color:red" ><?php echo $_SESSION["message"]; ?></span>
                <?php
             }
             ?>
        </form>
        </br></br>
        <span font-size="10px">For new member, <a href="signup.php">click here to sign up</a>
          </span>
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