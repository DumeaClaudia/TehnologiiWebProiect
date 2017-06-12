<?php
 session_start();
 require_once 'dbconnect.php';
 
 // if session is not set this will redirect to login page
 if( !isset($_SESSION['user']) ) {
  header("Location: loginHome.php");
  exit;
 }
 // select loggedin users detail
 $res=mysql_query("SELECT * FROM users WHERE userId=".$_SESSION['user']);
 $userRow=mysql_fetch_array($res);
 $userId = $_SESSION['user'];
 
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
    <div id="background">
    </div>

    <div id="bar">
        <div id="name"> Guess the VIP </div>
        <div id="menu">
            <a class="menu-button" href="loginHome.php">Home</a>
            <a class="menu-button  page-active" href="playGame.php">Play</a>
            <a class="menu-button" href="gamesScores.php">Games Scores</a>
            <a class="menu-button" href="logout.php">Log out</a>
        </div>
    </div>


    <div id="main">
        <div id="main-top">
        </div>
        <div id="main-content">

            <div id="game-holder">
                <div id="game-title">
                    <p><b>Guess who?</b></p>
                </div>
                <?php 
                 $res = mysql_query("select q.questionId, q.questionImage, q.answer1, q.answer2, q.answer3, q.answer4
                from questions as q
                left join (select * from answers where userId = '$userId') as a
                on a.questionid = q.questionId
                where a.userId IS NULL
                order by rand()
                limit 1");

                 $count = mysql_num_rows($res); 
                 if ($count == 1) {
                     $questionRow = mysql_fetch_array($res, MYSQL_ASSOC);
                ?>
                <div class="game">
                    <div id="game-vip-photo">
                        <div class="vip-frame">
                            <img class="vip-img" id="vip-img" src="img/<?php echo $questionRow['questionImage'];?>" alt="<?php echo $questionRow['questionImage'];?>" />
                        </div>
                    </div>
                    <div id="game-answers" class=answers>
                        <button class="answer-button"><?php echo $questionRow['answer1'];?></button>
                        <button class="answer-button"><?php echo $questionRow['answer2'];?></button>
                        <button class="answer-button"><?php echo $questionRow['answer3'];?></button>
                        <button class="answer-button"><?php echo $questionRow['answer4'];?></button>
                    </div>
                    <div id="next-level">
                        <p id="answer-feedback">Your answer isn't correct. </p>
                        <button class="arrow-button" id="next-button"> <span>Next</span></button>
                    </div>
                </div>
                <?php 
                } else {
                    echo "No more questions for you.";
                }?>
            </div>
            <div id="others-scores"
                 <?php     
                 $score = mysql_query("SELECT (select userName from users where userId = a.userId) as userName,
                                                count(*) * 10 as points
                                                from answers as a
                                                left join questions as q
                                                on a.questionid = q.questionId
                                                where a.answer = q.answerCorrect
                                                group by a.userId
                                                order by points desc
                                                limit 10
                                                ");      
                while ($row = mysql_fetch_array($score, MYSQL_NUM)) { ?>
                     <hr class="scores-hr" />
                      <p> <?php echo $row[0]; ?>  score:<td><?php echo $row[1]; ?></p>
                <?php
                }
                  mysql_free_result($score);       
              ?>
                <br/>
            </div>
        </div>
        <div id="main-bottom">
            <div class="user-score">

                <div class="user-score-detail" id="showHideContainer">
                    <a>
                    User: <?php echo $userRow['userName']; ?>  Current score:
                     <?php     
                     $points = mysql_query("SELECT count(*) * 10 as points from answers as a join questions as q on a.questionid = q.questionId WHERE a.answer = q.answerCorrect and a.userId = ".$_SESSION['user']);  
                     $pointRow=mysql_fetch_array($points);
                     echo $pointRow['points'];            
                     ?> points
                </a>
                </div>
                <div id="hideaway" class="previous-scores" style="display:none;">
                    <table>
                <?php     
                 $score = mysql_query("SELECT  a.date,
                                       (SELECT count(*) * 10
                                            from answers as a2
                                            join questions as q
                                            on a2.questionid = q.questionId
                                            WHERE a2.userId = '$userId' and a.date = a2.date and a2.answer = q.answerCorrect) as points,
                                        count(*) as games
                                        from answers as a
                                        WHERE a.userId = '$userId'
                                        group by a.date
                                        order by a.date desc;");      
                while ($row = mysql_fetch_array($score, MYSQL_NUM)) { ?>
                    <tr>
                        <td><?php echo $row[0]; ?></td>
                        <td><?php echo $row[1]; ?> points</td>
                        <td><?php echo $row[2]; ?> games played</td>
                    </tr> 
                <?php
                }
                  mysql_free_result($score);       
              ?>
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