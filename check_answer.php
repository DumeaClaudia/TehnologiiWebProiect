<?php
 ob_start();
 session_start();
 require_once 'dbconnect.php';
  
if ( isset($_SESSION['user']) != "" ) {
  $question = $_GET['q'];
  $answer = $_GET['a'];
  
  $res = mysql_query("select q.questionId, q.questionImage, q.answer1, q.answer2, q.answer3, q.answer4, q.answerCorrect
                from questions as q
                where q.questionImage = '$question'
                limit 1 ");   

   $count = mysql_num_rows($res); 
   if ($count == 1) {
       $questionRow = mysql_fetch_array($res, MYSQL_ASSOC);
       $qid = $questionRow['questionId'];
       $uid = $_SESSION['user'];
       $userAnswer = 0;
       if ($answer == $questionRow['answer1']) {
          $userAnswer = 1;
       } else if ($answer == $questionRow['answer2']) {
          $userAnswer = 2;
       } else if ($answer == $questionRow['answer3']) {
          $userAnswer = 3;
       }  else if ($answer == $questionRow['answer4']) {
          $userAnswer = 4;
       } 

      if ($userAnswer == $questionRow['answerCorrect']){
        echo "The answer is correct";
      } else {
        echo "The answer is not correct.";
      }

      $query = "INSERT INTO answers(userId, questionId, answer) VALUES('$uid','$qid', '$userAnswer' )";
      $res = mysql_query($query);
  
      if ($res) {
      } else {
        echo "There was an error.".mysql_error();
      }
   } else {
       echo "The question is invalid";
   }
}
?>