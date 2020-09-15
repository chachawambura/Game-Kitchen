<?php 

if(isset($_POST['submitMyDispute']) && $_POST['submitMyDispute'] == "Submit Dispute")
{
	
	
		if(!isset($_POST['submitMyDispute']))
			echo '<div class="col-md-12 isa_error text-center">You must accept terms and conditions.</div>';
			else
			{
			    
				echo playModel::submitMyDisputeGamer($_POST);
			    
			}
			
		
} 
?>
<form class="form" role="form"  method="post" action="index.php?acc=games&page=player1_dispute&currentgameId" enctype="multipart/form-data" id="signup-nav2">
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
      <input type="file" name="gameImage" required />
    </div>
    </div>
    </div>
   <div class="col-md-12 form-group">
    	<div class="col-md-12">
       		<input type="submit" name="submitMyDispute" class="btn btn-success" value="Submit Dispute" />
            
    	</div>
    	
        </div>
  </form>