<?php 
if(isset($_REQUEST['msg']) && $_REQUEST['msg']=="success")
{
	echo '<div class="col-md-12 text-center isa_success">
				<p>Registration successfull. An email has been sent to you, with a password and activation code.</p>
				<p>You can now <a href="index.php?pg=login">login</a> to the '.SITE_NAME.'</p>
				<p>Note: If the email is not in the inbox, please check in spam/junk folders.</p>
		 </div>';
	
	return;
}
$message = "";
if(isset($_POST['SubmitButton'])){ //check if form was submitted
	//$input = $_POST['alias']; 
	$ty = userModel::playerSearchTo( $_POST['alias'] );
	
	print_r($ty);
}  
?>

<form action="<?=$_SERVER['PHP_SELF'];?>" method="post">
<?php //echo $message; ?>
  <div class="col-md-3">
  <input type="text" name="alias" placeholder="Enter Alias"/>
  </div>
    <div class="col-md-3">
  <input type="submit" id="show" name="SubmitButton"/>
   </div>
</form>  
<div class="menu" style="display: none;">dmmdd</div>
<script>
$(document).ready(function(){
    $('#show').click(function() {
      $('.menu').toggle("slide");
    });
});
</script>