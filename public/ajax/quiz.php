<?php


echo 'got here';

/*

require_once ('connect.php');
error_log(print_r($_POST));

$answArray = $_POST;
error_log(implode(" ",$answArray)."yoooooo");
$answeredId=implode(" ",$answArray);

$getQuesSql = mysqli_query($connection, "SELECT * FROM answers WHERE id=$answeredId");
//$answeredQuestionId = mysql_result(mysql_query($connection, "SELECT question_id FROM games LIMIT 1"),0);
$answeredQuestionId ='';
$userCQAns ='';

$getUserContestSql = mysqli_query($connection, "SELECT * FROM user_contest WHERE contest_id =1 AND user_id=1");
while($row1 = mysqli_fetch_assoc($getUserContestSql)){
	$userCQAns= $row1['user_answer'];
}


while($row3 = mysqli_fetch_assoc($getQuesSql)){
	$answeredQuestionId = $row3['questions_id'];
}

$myArray = array();
$myArray = explode(',', $userCQAns);
$newAnswers ='';
foreach($myArray as $my_Array){
	
	
	if (strpos($my_Array, '('.$answeredQuestionId.'-') !== false) {
    echo 'true';
   
    $newAnswers .= "(".$answeredQuestionId.'-'.$answeredId.'),';
    
}  else{
	
	$newAnswers .= $my_Array.',';
}
	
	 
	
}
$newAnswers = rtrim($newAnswers, ',');

mysqli_query($connection, "UPDATE user_contest SET user_answer='$newAnswers' WHERE contest_id =1 AND user_id=1");
*/
?>

