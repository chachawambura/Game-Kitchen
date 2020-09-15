<?php 

//echo $playerId;

$getEmail = userModel::userDetails($playerId);
$exactEm = $getEmail->emailadd;

if(isset($_POST['submitAmountTopUp']) && $_POST['submitAmountTopUp'] == "Top Up Now")
{
	
	if(!isset($_POST['playerId']) || !isset($_POST['amount']) )
	{
		echo '<div class="col-md-12 isa_error text-center">You have to fill all the details.</div>';
	}
	else
	{
		
    echo playModel::submitManualAmount($_POST);
    }
			
			
	
	
}

?>
     <form class="form" role="form" method="post" action="index.php?acc=topup&playerId" id="signup-nav2">        
	      <input type="hidden" class="form-control" name="playerId" value="<?php echo $playerId?>"/>
	      
	      <input type="hidden" class="form-control" name="player_email" value="<?php echo $exactEm?>"/>
	      
	      
	     <div class="input-group mb-3">
  <input type="text" class="form-control" name="amount" placeholder="Amount" aria-label="Amount" aria-describedby="basic-addon2">
  <div class="input-group-append">
    <span class="input-group-text" id="basic-addon2">Please specify Amount</span>
  </div>
</div>
          
        <div class="col-md-12 form-group">
    	<div class="col-md-12 text-center">
    	 <input type="submit" name="submitAmountTopUp" class="btn btn-success" value="Top Up Now" />
    	<a href="<?php echo $urls; ?>" class="btn btn-success">Back to Games</a>
    	</div>
    	</div>
    	</form>