<div class="col-md-12 text-center pwd">
<h2 class="heading">Remind Password</h2>


<?php
if($_POST['submitThis'] == "Request")
	{
	echo userModel::remindPassword($_POST);
	}

?>

<form action="" method="post">
  
   <?php if(isset($_REQUEST['msg']) && $_REQUEST['msg']=="success" ): ?>
		<div class="col-md-12 isa_success text-center">
        	<p>Successful. The details have been sent to your inbox.</p>
            <p>Note: If the details are not in your inbox, please check in your spam/junk folder.</p>        
        </div>
        <div class="col-md-12 text-center">You can now login <a href="index.php?pg=login">Login Page</a></div>
    <?php 
		return;
	elseif(isset($_REQUEST['msg']) && $_REQUEST['msg']=="error" ): ?>   
        <div class="col-md-12 isa_error text-center">The details supplied are incorrect. Please try again, or contact admin.</div>
	<?php
    elseif(isset($_REQUEST['msg']) && $_REQUEST['msg']=="em" ): ?>   
        <div class="col-md-12 isa_error text-center">There was a problem relaying email. Please contact system admin.</div>
   
   <?php endif; ?>
   
	
	<div class="col-md-12"><div class="col-md-12 text-center">Please enter the below details, as used during registration</div></div>
    
    <div class="col-md-12">
        <div class="col-md-6 text-right"><label>Email Address</label></div>
        <div class="col-md-6"><input type="email" name="emailadd" required placeholder="Email address" /></div>
    </div>
    <div class="col-md-12">
        <div class="col-md-6 text-right"><label>Id / Ppt No</label></div>
        <div class="col-md-6"><input type="text" name="idno" required placeholder="Id No" maxlength="8" /></div>
    </div>
    
    
    <div class="col-md-12">
    	<div class="col-md-6">&nbsp;</div>
        <div class="col-md-6">
        	<input type="submit" name="submitThis" value="Request" />
        	
            <a href="index.php?pg=login" class="button">Cancel</a>
        </div>
	</div>
    
</form>

</div>