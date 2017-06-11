<?php
 ob_start();
 session_start();

 // phpinfo();
 require_once 'dbconnect.php';
 
 if ( ! isset($_SESSION['user']) != "" ) {
     $error = false;
    
     if( isset($_POST['user']) and isset($_POST['password'])) { 
      
      // prevent sql injections/ clear user invalid inputs
      $user = trim($_POST['user']);
      $user = strip_tags($user);
      $user = htmlspecialchars($user);
      
      $pass = trim($_POST['password']);
      $pass = strip_tags($pass);
      $pass = htmlspecialchars($pass);
      // prevent sql injections / clear user invalid inputs
      
      if(empty($user)){
       $error = true;
       $userError = "Please enter your user name.";
      } 
      
      if(empty($pass)){
       $error = true;
       $passError = "Please enter your password.";
      }
      
      // if there's no error, continue to login
      if (!$error) {
       
       $password = hash('sha256', $pass); // password hashing using SHA256
      
       $res=mysql_query("SELECT userId, userName, userPass FROM users WHERE userName='$user'");
       $row=mysql_fetch_array($res);
       $count = mysql_num_rows($res); // if uname/pass correct it returns must be 1 row
       
       if( $count == 1 && $row['userPass']==$password ) {
        $_SESSION['user'] = $row['userId'];
        header("Location: playGame.php");
       } else {
        $errMSG = "Incorrect Credentials, Try again...";
       }
        
      }
      
     }
} else {
   // select loggedin users detail
  $res=mysql_query("SELECT userId, userName, userPass FROM users WHERE userId=".$_SESSION['user']);
  $userRow=mysql_fetch_array($res);
  $count = mysql_num_rows($res); // if uname/pass correct it returns must be 1 row
       
  if( $count == 1 && $row['userPass']==$password ) {
    $errMSG = "Incorrect Credentials, Try again...";
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
            <p id="welcome">Hello <?php if (isset($userRow['userName'])) { echo $userRow['userName']; } else { echo 'Guest'; } ?>, welcome!</p>
            <p id="about-game"> The main idea of this game is to recognize different stars after their profile photo. The rules are simple. You have to choose from four options, where only one has the correct name and you will win some points, according to the dificulty of that image and the associated options. I hope you'll play and like it.
                <br> First of all you have to login to start a new game or come back to your account.
            </p>
            <img class="vip-collage" src="img/colaj.jpg" alt="colaj" />
        </div>

<?php  if ( ! isset($_SESSION['user'])) { ?>
        <div id="formular">
            <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                <div id="user">
                    <div class="form-label"> <b>Username:</b></div>
                    <input type="text" name="user" value="<?php echo $name ?>" >
                   
                </div>
                  <span><?php echo $userError; ?></span>
                <div id="pass">
                    <div class="form-label"><b>Password:</b>
                    </div>
                    <input type="password" name="password" value=""/>
                </div>
                  <span><?php echo $passError; ?></span>
                <br>
                <input id="logg" type="submit" value="   Log in   "/>
                  <span><?php echo $errMSG; ?></span>
            </form>
            <p>
              <a href="register.php">Register</a>
            </p>
        </div>
<?php  } ?>

        <div class="prop">
            <p><b>Play</b> and <b>enjoy</b> the game <b>Guess the VIP</b>.</p>
            <p> View your own <b>score</b> and try to be <b>the best</b>.</p>
        </div>

    </div>
    <div id="footer">
        <br>
        <div id="right"> Copyright&copy; 2017. <b> Guess the VIP. </b> All rights reserved. </div>
    </div>

</body>

</html>