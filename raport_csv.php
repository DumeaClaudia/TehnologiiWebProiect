<?php
 ob_start();
 session_start();
 require_once 'dbconnect.php';
     
     $score = mysql_query("SELECT (select userName from users where userId = a.userId) as userName,
                                    (select count(*) from answers where userId = a.userId) as games,
                                    count(*) as points
                                    from answers as a
                                    left join questions as q
                                    on a.questionid = q.questionId
                                    where a.answer = q.answerCorrect
                                    group by a.userId");  
     echo "name, score, games";  
     echo "  \r\n";
    while ($row = mysql_fetch_array($score, MYSQL_NUM)) { 
        echo $row[0], ',',  $row[2], ',',  $row[1];
        echo "  \r\n";    
    }
      mysql_free_result($score);       
  ?>
