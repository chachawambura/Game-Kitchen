<?php 
if(isset($_POST['submitTemporary']) && $_POST['submitTemporary'] == "Suspend Now")
{
	
	if(!isset($_POST['playerId']) || !isset($_POST['myreason']) )
	{
		echo '<div class="col-md-12 isa_error text-center">You have to fill all the details.</div>';
	}
	else
	{
		if(!isset($_POST['submitTemporary']))
			echo '<div class="col-md-12 isa_error text-center">You must accept terms and conditions.</div>';
			else
			{
				echo playModel::submitTemporaryGamer($_POST);
			}
			
			
			
	}//termsandconditions
} 
?>
 <h3>Temporary Suspend</h3>
         
        <form class="form" role="form" method="post" action="index.php?acc=temporary&playerId" id="signup-nav2">        
	      <input type="hidden" class="form-control" name="playerId" value="<?php echo $playerId?>"/>
	      
	      
	       <div class="form-group shadow-textarea">
         <label for="exampleFormControlTextarea6">Reason</label>
         <textarea class="form-control z-depth-1" id="myreason" name="myreason" rows="3" placeholder="Write something here..."></textarea>
          </div>
          
        <div class="col-md-12 form-group">
    	<div class="col-md-12 text-center">
    	 <input type="submit" name="submitTemporary" class="btn btn-success" value="Suspend Now" />
    	<a href="https://gamingkitchen.co.ke/index.php" class="btn btn-success">Back to Games</a>
    	</div>
    	</div>
    	</form>