<?php 

if(isset($_POST['submitDirectMessageReply']) && $_POST['submitDirectMessageReply'] == "Submit Reply")
{
	echo playModel::submitReplyToDirectMessage( $_POST );
}

?>
<form class="form" role="form" method="post" action="index.php?acc=games&page=reply" id="signup-nav2">
<div class="col-md-12 form-group">
 <input type="hidden" name="directMessageId" value="<?php echo $gid;?>" readonly />
 
 <div class="form-group shadow-textarea">
         <label for="exampleFormControlTextarea6">Message</label>
         <textarea class="form-control z-depth-1" id="my_message" name="my_message" rows="3" placeholder="Write something here..."></textarea>
  </div>
 
 <div class="col-md-12 text-center">
    	 <input type="submit" name="submitDirectMessageReply" class="btn btn-success" value="Submit Reply" />
    	<a href="<?php echo $urls; ?>" class="btn btn-success">Back to Games</a>
    	</div>
</div>


</form>