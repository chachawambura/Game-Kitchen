 <?php 
 //$results = playModel::submitMyGameClaim($_POST);
 
 if(isset($_POST['submitResultsNow']) && $_POST['submitResultsNow'] == "Submit Results")
 {
 	
 	if(!isset($_POST['gameId']) || !isset($_POST['playerId']) || !isset($_POST['claimNow']) )
 	{
 		echo '<div class="col-md-12 isa_error text-center">You have to fill all the details.</div>';
 	}
 	else
 	{
 		if(!isset($_POST['claimNow']))
 			echo '<div class="col-md-12 isa_error text-center">You must accept terms and conditions.</div>';
 			else
 			{
 				echo playModel::submitMyGameClaim($_POST);
 			}
 		
 		
 		
 	}//termsandconditions
 } 
   ?>
         <h3>Claim Prize Now</h3>
         
        <form class="form" role="form" method="post" action="index.php?acc=games&page=claims&currentgameId" id="signup-nav2">        
        <input type="hidden" class="form-control" name="gameId" value="<?php echo $currentgameId?>"/>
	      <input type="hidden" class="form-control" name="playerId" value="<?php echo MYID?>"/>
	      <?php echo $message; ?>
         <div class="custom-control custom-checkbox">
         <input type="checkbox" class="custom-control-input" name="claimNow" value="Yes" id="defaultUnchecked">
        <label class="custom-control-label" for="defaultUnchecked">Yes</label>
        <input type="checkbox" class="custom-control-input" name="claimNow"  value="No" id="defaultUnchecked">
        <label class="custom-control-label" for="defaultUnchecked">No</label>
        </div>
        <div class="col-md-12 form-group">
    	<div class="col-md-12 text-center">
    	 <input type="submit" name="submitResultsNow" class="btn btn-success" value="Submit Results" />
    	<a href="<?php echo $urls; ?>" class="button">Back to Games</a>
    	</div>
    	</div>
         </form>