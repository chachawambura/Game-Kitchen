<?php 
if(isset($_POST['gplayerId']))
{
	
	$mm=$_POST['gplayerId'];
	
	echo  "Wick..............", $mm;
	
}

?>

     <?php 
           if(isset($_POST['challengePlayer']) && $_POST['challengePlayer'] == "Challenge Player")
           {
           	
            echo playModel::submitChallengePlayer( $_POST );
       
           }if(isset($_POST['directMessage']) && $_POST['directMessage'] == "Direct Message"){
           	
           	echo playModel::submitDirectMessage( $_POST );
           }if(isset($_POST['myFavourite']) && $_POST['myFavourite'] == "Direct Message"){
           	
           	echo playModel::submitMyFavourite( $_POST );
           }
           
           
           ?>


  <div class="col-md-5" style="display:block;">
 
  
   </div>