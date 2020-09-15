<?php 
//echo  'cancel_mygame';
//echo  $currentgameId;
$dtz = dashboardModel::getGamingDetailsById($currentgameId);
//print_r($dtz);
$stake = $dtz->player1_stake;
$getEmail = userModel::userDetails(MYID);
$exactEm = $getEmail->emailadd;

$fname = $getEmail->fname;

//echo "My stake ::", $stake;

if(isset($_POST['submitCancelGameNow']) && $_POST['submitCancelGameNow'] == "Cancel Now")
{
	
	if(!isset($_POST['gameId']) || !isset($_POST['playerId']) || !isset($_POST['myreason']) )
	{
		echo '<div class="col-md-12 isa_error text-center">You have to fill all the details.</div>';
	}
	else
	{
		if(!isset($_POST['submitCancelGameNow']))
			echo '<div class="col-md-12 isa_error text-center">You must accept terms and conditions.</div>';
			else
			{
				echo playModel::submitCancelGame($_POST);
			}
			
			
			
	}//termsandconditions
} 
?>

<h3>Reason for Game Cancellation</h3>
         
        <form class="form" role="form" method="post" action="index.php?acc=games&page=cancel_mygame&currentgameId" id="signup-nav2">        
        <input type="hidden" class="form-control" name="gameId" value="<?php echo $currentgameId?>"/>
	    <input type="hidden" class="form-control" name="playerId" value="<?php echo MYID?>"/>
	    
	    <input type="hidden" class="form-control" name="player_email" value="<?php echo $exactEm?>"/>
	    
	     <input type="hidden" class="form-control" name="player_name" value="<?php echo $fname?>"/>
	    
	    <input type="hidden" class="form-control" name="amountStaked" value="<?php echo $stake?>"/>
	      
	      <div class="form-group shadow-textarea">
         <label for="exampleFormControlTextarea6">My Reason</label>
         <textarea class="form-control z-depth-1" id="myreason" name="myreason" rows="3" placeholder="Write something here..."></textarea>
          </div>
          
          <div class="col-md-12 text-center">
    	 <input type="submit" name="submitCancelGameNow" class="btn btn-success" value="Cancel Now" />
    	<a href="<?php echo $urls; ?>" class="btn btn-success">Back to Games</a>
    	</div>
    	
	   </form>