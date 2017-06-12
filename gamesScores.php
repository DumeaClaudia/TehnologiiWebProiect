<?php
 ob_start();
 session_start();
 require_once 'DBconnect.php';
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

    <div id="background">
    </div>

    <div id="bar">
        <div id="name"> Guess the VIP </div>
        <div id="menu">
            <a class="menu-button" href="loginHome.php">Home</a>
            <?php  if ( isset($_SESSION['user'])) { ?>
            <a class="menu-button" href="playGame.php">Play</a>
            <?php  } ?>
            <a class="menu-button page-active" href="gamesScores.php">Games Scores</a>
            <?php  if ( isset($_SESSION['user'])) { ?>
            <a class="menu-button" href="logout.php">Log out</a>
            <?php  } ?>
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
                                                count(*) * 10 as points
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
          <div class=" content raports">
            <p> Raports:
            </p>
              <ul>
                <li>
                    <a href="search.php?q=">JSON</a>
                </li>
                 <li>
                    <a href="raport_html.php">HTML</a>
                </li>
                <li>
                    <a href="raport_csv.php">CSV</a>
                </li>
            </ul>
        </div>
    </div>


    <div id="footer">
        <br>
        <div id="right"> Copyright&copy; 2017. <b> Guess the VIP. </b> All rights reserved. </div>
    </div>


</body>

</html>