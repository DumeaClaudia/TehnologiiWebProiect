<?php
 session_start();
 require_once 'dbconnect.php';
 ?>
 <!DOCTYPE html>
<html>
<head>
    <title>
        Score table
    </title>
</head>

<body>
 <table>
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
</body>
</html>