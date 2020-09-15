<?php 
$currId = MYID;
$showList = userModel::userDetails($currId);
$getemail = $showList->emailadd;
$getfname = $showList->fname;
?>

<?php 

if(isset($_POST['submitDirectMessage']) && $_POST['submitDirectMessage'] == "Submit Message")
{
	
	if(!isset($_POST['userId']) || !isset($_POST['inviteId']) || !isset($_POST['my_message']) )
	{
		echo '<div class="col-md-12 isa_error text-center">You have to fill all the details.</div>';
	}
	else
	{
		if(!isset($_POST['submitDirectMessage']))
			echo '<div class="col-md-12 isa_error text-center">You must accept terms and conditions.</div>';
			else
			{
				echo playModel::submitDirectMessageNow($_POST);
			}
			
			
			
	}//termsandconditions
} 

?>

<form class="form" role="form" method="post" action="index.php?acc=directm" id="signup-nav2">
    <div class="col-md-12 form-group">

    <input type="hidden" name="userId" value="<?php echo $currId;?>">
    
    <input type="hidden" name="inviteId" value="<?php echo $joingameId;?>">
    
    <input type="hidden" name="myemail" value="<?php echo $getemail;?>">
    
    <input type="hidden" name="fname" class="form-control" value="<?php echo $getfname;?>">
    
    <div class="form-group shadow-textarea">
         <label for="exampleFormControlTextarea6">Description</label>
         <textarea class="form-control z-depth-1" id="my_message" name="my_message" rows="3" placeholder="Write something here..."></textarea>
     </div>
    
     <div class="col-md-12 text-center">
    	 <input type="submit" name="submitDirectMessage" class="btn btn-success" value="Submit Message" />
    	<a href="<?php echo $urls; ?>" class="btn btn-success">Back to Games</a>
    	</div>
    </div>
    
  </form>