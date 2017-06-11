<?php
 ob_start();
 session_start();
 if( isset($_SESSION['user'])!="" ){
  header("Location: home.php");
 }
 include_once 'dbconnect.php';

 $error = false;

  if( isset($_POST['user']) and isset($_POST['password'])  and isset($_POST['password2'])) { 
  
  // clean user inputs to prevent sql injections
  $name = trim($_POST['user']);
  $name = strip_tags($name);
  $name = htmlspecialchars($name);
  
  
  $pass = trim($_POST['password']);
  $pass = strip_tags($pass);
  $pass = htmlspecialchars($pass);

  $pass2 = trim($_POST['password2']);
  $pass2 = strip_tags($pass2);
  $pass2 = htmlspecialchars($pass2);
  
  
  // basic name validation
  if (empty($name)) {
   $error = true;
   $nameError = "Please enter your full name.";
  } else if (strlen($name) < 3) {
   $error = true;
   $nameError = "Name must have atleat 3 characters.";
  } else if (!preg_match("/^[a-zA-Z ]+$/",$name)) {
   $error = true;
   $nameError = "Name must contain alphabets and space.";
  }
  
  // password validation
  if (empty($pass)){
   $error = true;
   $passError = "Please enter password.";
  } else if(strlen($pass) < 6) {
   $error = true;
   $passError = "Password must have atleast 6 characters.";
  } else if ($pass != $pass2) {
   $error = true;
   $passError = "Passwords are not equal.";
  }
 

  $res=mysql_query("SELECT * FROM users WHERE userName='$name'");
  $userRow=mysql_fetch_array($res);
  $count = mysql_num_rows($res);
       
  if( $count >= 1) {
    $error = true;
    $nameError = "User exists. Please choose another name.";
  }

 
  // password encrypt using SHA256();
  $password = hash('sha256', $pass);
  
  // if there's no error, continue to signup
  if( !$error ) {

   $query = "INSERT INTO users(userName,userPass) VALUES('$name', '$password')";
   $res = mysql_query($query);
    
   if ($res) {
    $errTyp = "success";
    $errMSG = "Successfully registered, you may login now";
    unset($name);
    unset($email);
    unset($pass);
   } else {
    $errTyp = "danger";
    $errMSG = "Something went wrong, try again later..."; 
   } 
    
  }
  
  
 }
?>
 <!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="style.css" />
    <link rel="stylesheet" type="text/css" href="login.css" />
    <link rel="stylesheet" type="text/css" href="style2.css" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>

<body>
    <div id="top-logo">
    </div>
    <div id="background">
    </div>
    <div id="bar">
        <div id="name"> Guess the VIP </div>
        <div id="menu">
            <a class="menu-button  page-active" href="loginHome.php">Home</a>
            <a class="menu-button" href="playGame.php">Play</a>
            <a class="menu-button" href="gamesScores.html">Games Scores</a>

        </div>
    </div>


    <div id="main">
        <div class="begin">
            <p id="welcome">Hello, welcome! Register to continue.</p>
          
            <img class="vip-collage" src="img/colaj.jpg" alt="colaj" />
        </div>

        <div id="formular">
            <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                <div id="user">
                    <div class="form-label"> <b>Username:</b></div>
                    <input type="text" name="user" value="<?php echo $name ?>" >
                   
                </div>
                  <span><?php echo $nameError; ?></span>
                <div id="pass">
                    <div class="form-label"><b>Password:</b>
                    </div>
                    <input type="password" name="password" value=""/>
                </div>
                 <div id="pass">
                    <div class="form-label"><b>Repeat Password:</b>
                    </div>
                    <input type="password" name="password2" value=""/>
                </div>
                  <span><?php echo $passError; ?></span>
                <br>
                <input id="logg" type="submit" value="   Register   "/>
                  <span><?php echo $errMSG; ?></span>
            </form>
             <p>
              <a href="loginHome.php">Log in.</a>
            </p>
        </div>
    </div>
    <div id="footer">
        <br>
        <div id="right"> Copyright&copy; 2017. <b> Guess the VIP. </b> All rights reserved. </div>
    </div>

</body>

</html>