<?php 

if(isset($_POST['submitResetButton']) && $_POST['submitResetButton'] == "Reset")
{
	
	echo  adminModel::adminResetPasswordNow( $_POST );
}

?>
 <form class="form" role="form" method="post" action="index.php?acc=reset_passw" id="signup-nav2">
 <div class="col-md-12 form-group">
     <?php echo "<p>Reset Password</p>";?>
   <div class="col-md-6">
 <input type="hidden" class="form-control" name="userId" value="<?php echo $playerId?>"/>
 
 </div>
 
  <div class="col-md-12">
  <label for="form-control">New Password</label>
 <input type="password" class="form-control" name="newpassword" value="" placeholder="New Password"/>
 </div>
  <div class="col-md-12">
  <label for="form-control">Confirm Password</label>
 <input type="password" class="form-control" name="confirmpassword" value="" placeholder="Confirm Password"/>
 </div>
 
       <div class="col-md-12 form-group">
    	<div class="col-md-12">
       		<input type="submit" name="submitResetButton" class="btn btn-success" value="Reset" />
            
    	</div>
    	
        </div>
 </div>
 </form>