<?php
 session_start();
 require_once 'dbconnect.php';
 ?>
[
    <?php     
     $score = mysql_query("SELECT (select userName from users where userId = a.userId) as userName,
                                    (select count(*) from answers where userId = a.userId) as games,
                                    count(*) as points
                                    from answers as a
                                    left join questions as q
                                    on a.questionid = q.questionId
                                    where a.answer = q.answerCorrect
                                    group by a.userId");   
    $x = 0;   
    while ($row = mysql_fetch_array($score, MYSQL_ASSOC)) { 
       
        if ($_GET['q'] == "" or strpos($row['userName'], $_GET['q']) !== false){
             if ($x != 0) {
               echo ",";
            }
            $x ++;
            ?>
                {
               "name": "<?php echo $row['userName']; ?>",
               "score": <?php echo $row['points']; ?>,
               "games": <?php echo $row['games']; ?>
               }

            <?php
       }
    } ?>
]