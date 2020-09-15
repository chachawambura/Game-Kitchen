<?php 
//echo $currentgameId;

if(isset($_POST['submit2MyDispute2']) && $_POST['submit2MyDispute2'] == "Submit Dispute")
{
	
	if(!isset($_POST['gameId']) )
	{
		echo '<div class="col-md-12 isa_error text-center">You have to fill all the details.</div>';
	}
	else
	{
		if(!isset($_POST['submit2MyDispute2']))
			echo '<div class="col-md-12 isa_error text-center">You must accept terms and conditions.</div>';
			else
			{
				echo playModel::submitMyDispute2Gamer($_POST);
			}
			
			
			
	}//termsandconditions
} 

?>
<form class="form" role="form"  method="post" action="index.php?acc=games&page=player2_dispute2&currentgameId" enctype="multipart/form-data" id="signup-nav2">
   <h2>Upload Evidence</h2>
        <div class="col-md-12 form-group">
    	<div class="col-md-6">
    	 <input type="hidden" class="form-control" name="gameId" value="<?php echo $currentgameId?>" readonly/>
    	</div>
    	<div class="col-md-6">
    	 <input type="hidden" class="form-control" name="playerId" value="<?php echo MYID ?>" readonly/>
    	</div>
    	</div>
   
     <div class="col-md-12 form-group">
    	<div class="col-md-6">
    <div class="btn btn-primary btn-sm float-left">
      <span>Upload screen shot or video</span>
      <input type="file" name="gameImage"  data-max-file-size="10M" required />
    </div>
    </div>
    </div>
   <div class="col-md-12 form-group">
    	<div class="col-md-12">
         <input type="submit" name="submit2MyDispute2" class="btn btn-success" value="Submit Dispute" />            
    	</div>
    	
        </div>
  </form>