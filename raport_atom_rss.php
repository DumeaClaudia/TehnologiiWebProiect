<?php
 ob_start();
 session_start();
 require_once 'dbconnect.php';
 ?>
<?xml version="1.0" encoding="utf-8"?>
<feed xmlns="http://www.w3.org/2005/Atom">
  <title>Gues the vip scores</title>
  <link href="http://localhost/gamesScores.php"/>
  <updated><?php echo date(DATE_RFC2822); ?></updated>
  <author>
    <name>Gues the vip team</name>
  </author>
 <?php     
     $score = mysql_query("SELECT a.date,(select userName from users where userId = a.userId) as user, 
(SELECT count(*) * 10
from answers as a2
join questions as q
on a2.questionid = q.questionId
WHERE a2.userId = a.userId and a.date = a2.date and a2.answer = q.answerCorrect) as points
from answers as a
group by userId
order by date desc");      
    while ($row = mysql_fetch_array($score, MYSQL_NUM)) { ?>
        <entry>
    <title><?php echo $row[0]; ?> scores</title>
    <link href="http://localhost/gamesScores.php"/>
    <updated><?php echo $row[0]; ?></updated>
    <summary>
          On <?php echo $row[0]; ?> the user
          "<?php echo $row[1]; ?>" had
          <?php echo $row[2]; ?> points
        </summary>
  </entry>
    <?php
    }
      mysql_free_result($score);       
  ?>


</feed>