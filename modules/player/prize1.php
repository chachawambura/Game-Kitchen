 <?php 
 //$results = playModel::submitMyGameClaim($_POST);
 
 if(isset($_POST['submitClaimPlayer1']) && $_POST['submitClaimPlayer1'] == "Submit Results")
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
         
        <form class="form" role="form" method="post" action="index.php?acc=games&page=player1_prize&currentgameId" id="signup-nav2">        
        <input type="hidden" class="form-control" name="gameId" value="<?php echo $currentgameId?>"/>
	      <input type="hidden" class="form-control" name="playerId" value="<?php echo MYID?>"/>
	      <?php echo $message; ?>
         <div class="custom-control custom-checkbox">
         <input type="checkbox" class="check" name="claimNow" class="check" value="Yes" id="defaultUnchecked">
        <label class="custom-control-label" for="defaultUnchecked">Won</label>
        <input type="checkbox" class="check" name="claimNow"  class="check" value="No" id="defaultUnchecked">
        <label class="custom-control-label" for="defaultUnchecked">Lost</label>
        </div>
        <div class="col-md-12 form-group">
    	<div class="col-md-12 text-center">
    	 <input type="submit" name="submitClaimPlayer1" class="btn btn-success" value="Submit Results" />
    	<a href="<?php echo $urls; ?>" class="btn btn-success">Back to Games</a>
    	</div>
    	</div>
    	
     <script type="text/javascript">
$(document).ready(function(){
    $('.check').click(function() {
        $('.check').not(this).prop('checked', false);
    });
});
</script>
    	
         </form>