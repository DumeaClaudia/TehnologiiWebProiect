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
    <link rel="stylesheet" type="text/css" href="tableScores.css" />
    <link rel="stylesheet" type="text/css" href="style2.css" />
    <script type="text/javascript" src="js/search.js">
    </script>
    <meta charset="UTF-8">
    <title>
        Score table
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
            <a class="menu-button" href="playGame.php">Play</a>
            <a class="menu-button page-active" href="gamesScores.php">Games Scores</a>

        </div>
    </div>
    <div id="main">

        <div class="content">
            <p id="introducere">Here you can view all the scores of the players of the game "Guess the VIP" and the number of games that they played until today.</p>
        </div>

        <div class="content content-box">
            <p id="title-classification"><b> Score table:</b></p>

            <input id="search-box" type="text" name="search-smth" value="">


            <table id="score-table">
                <tr>
                    <th>Name</th>
                    <th>Score</th>
                    <th>Games played</th>
                </tr>
             <?php     
                 $score = mysql_query("SELECT (select userName from users where userId = a.userId) as userName,
                                                (select count(*) from answers where userId = a.userId) as games,
                                                count(*) as points
                                                from answers as a
                                                left join questions as q
                                                on a.questionid = q.questionId
                                                where a.answer = q.answerCorrect
                                                group by a.userId");      
                while ($row = mysql_fetch_array($score, MYSQL_NUM)) { ?>
                    <tr>
                        <td><?php echo $row[0]; ?></td>
                        <td><?php echo $row[2]; ?></td>
                        <td><?php echo $row[1]; ?></td>
                    </tr> 
                <?php
                }
                  mysql_free_result($score);       
              ?>
            </table>

        </div>
    </div>


    <div id="footer">
        <br>
        <div id="right"> Copyright&copy; 2017. <b> Guess the VIP. </b> All rights reserved. </div>
    </div>


</body>

</html>