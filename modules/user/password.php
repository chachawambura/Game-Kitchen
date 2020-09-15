<div class="col-md-12 text-center"><h3>Change Password</h3></div>

<?php

$url_pwd = "index.php?act=user&acc=pwd";

if($_POST['submitThis'] == "Save"):

	if($_POST['npw'] == $_POST['cpw'])
		echo userModel::changePassword($_POST);
	else
		echo '<script>self.location="'.$url_pwd.'&msg=nomatch"</script>';
		
endif;

?>

<form action="" method="post" name="form" id="form"  class="form-password">

    <?php if( $_GET['err'] == 1 ) : ?>
    	<div class="col-md-12 isa_error text-center">The old password you entered does not match the current password.</div>
    <?php endif; ?>
    <?php if( $_GET['msg'] == "success" ) : ?>
    	<div class="col-md-12 isa_success text-center">You have successfully changed your password.</div>
        <p>&nbsp;</p>
        <?php return; ?>
    <?php endif; ?>
     <?php if( $_GET['msg'] == "nomatch" ) : ?>
    	<div class="col-md-12 isa_error text-center">The new passwords you entered do not match.</div>
    <?php endif; ?>
    
    <div class="col-md-12 text-center">
    	<div class="col-md-6"><label>Current Password</label></div>
        <div class="col-md-6"><input type="password" name="opw" id="opw" required placeholder="current password" /></div>
    </div>
    
    <div class="col-md-12 text-center">
    	<div class="col-md-6"><label>New Password</label></div>
        <div class="col-md-6"><input type="password" name="npw" id="npw" required placeholder="new password" /></div>
    </div>
    
    <div class="col-md-12 text-center">
    	<div class="col-md-6"><label>Confirm Password</label></div>
        <div class="col-md-6"><input type="password" name="cpw" id="cpw" required placeholder="confirm password" /></div>
    </div>    
    
    <div class="col-md-12 text-center">
    	<input type="submit" name="submitThis" id="submit" value="Save" />
        <a class="button" onclick="location.href = 'index.php'">Cancel</a>
    </div>
    
    <input type="hidden" name="url" id="url" value="<?php echo $url_pwd ?>" />
    
</form>