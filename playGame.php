<?php
 ob_start();
 session_start();
 require_once 'DBconnect.php';
 
 // if session is not set this will redirect to login page
 if( !isset($_SESSION['user']) ) {
  header("Location: loginHome.php");
  exit;
 }
 // select loggedin users detail
 $res=mysql_query("SELECT * FROM users WHERE userId=".$_SESSION['user']);
 $userRow=mysql_fetch_array($res);
?>
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="style.css" />
    <link rel="stylesheet" type="text/css" href="game.css" />
    <script type="text/javascript" src="js/score.js"></script>

    <meta charset="UTF-8">
    <title>
        GuessTheVip
    </title>
</head>

<body>
    <div id="top-logo">
    </div>
    <div id="background">
    </div>

    <div id="bar">
        <div id="name"> Guess the VIP </div>
        <div id="menu">
            <a class="menu-button" href="loginHome.php">Home</a>
            <a class="menu-button  page-active" href="playGame.php">Play</a>
            <a class="menu-button" href="gamesScores.html">Games Scores</a>
            <a class="menu-button" href="logout.php">Log out</a>
        </div>
    </div>


    <div id="main">
        <div id="main-top">
        </div>
        <div id="main-content">

            <div id="game-holder">
                <div id="game-title">
                    <p><b>Level 1.   Guess who?</b></p>
                </div>
                <div class="game">
                    <div id="game-vip-photo">
                        <div class="vip-frame">
                            <img class="vip-img" src="img/2014-11-16-uktvsherlockbenedictcumberbatch5_1.jpg" alt="BenedictCumberbatch" />
                        </div>
                    </div>
                    <div id="game-answers" class=answers>
                        <button class="answer-button"> answer1</button>
                        <button class="answer-button"> answer2</button>
                        <button class="answer-button"> answer3</button>
                        <button class="answer-button"> answer4</button>
                    </div>
                    <div id="next-level">
                        <p id="answer-feedback">Your answer isn't correct. </p>
                        <button class="arrow-button" id="next-button"> <span>Next</span></button>
                    </div>
                </div>
            </div>
            <div id="others-scores">
                <h2><b>Scores:</b> </h2>
                <hr class="scores-hr" />
                <p>user1 score:30</p>
                <hr class="scores-hr" />
                <p>user2 score:30</p>
                <br/>
            </div>
        </div>
        <div id="main-bottom">
            <div class="user-score">

                <div class="user-score-detail" id="showHideContainer">
                    <a>
                    User: <?php echo $userRow['userName']; ?>  Current score: 960 points
                </a>
                </div>
                <div id="hideaway" class="previous-scores" style="display:none;">
                    <table>
                        <tr>
                            <td>21-Apr-17</td>
                            <td>60 points</td>
                            <td>2 games played</td>
                        </tr>
                        <tr>
                            <td>22-Apr-17</td>
                            <td>100 points</td>
                            <td>4 games played</td>
                        </tr>
                        <tr>
                            <td>23-Apr-17</td>
                            <td>800 points</td>
                            <td>30 games played</td>
                        </tr>

                    </table>
                </div>

            </div>
        </div>
    </div>


    <div id="footer">
        <br>
        <div id="right"> Copyright&copy; 2017. <b> Guess the VIP. </b> All rights reserved. </div>
    </div>
</body>

</html>