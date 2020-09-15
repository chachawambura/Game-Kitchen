<h2 class="subheading">Registration</h2>
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


if(isset($_POST['submitThis']) && $_POST['submitThis'] == "Register")
	{
	
	if(!isset($_POST['fname']) || !isset($_POST['lname']) || !isset($_POST['emailadd']) )
		{
		echo '<div class="col-md-12 isa_error text-center">You have to fill all the details.</div>';
		}
	else
		{
		if(!isset($_POST['termsandconditions']) || $_POST['termsandconditions'] != '1')
			echo '<div class="col-md-12 isa_error text-center">You must accept terms and conditions.</div>';
		else
			{
		
			$exists = userModel::userExists($_POST);
			
			if($exists == 1)
				echo '<div class="col-md-12 isa_error text-center">Registration failed. Check if Email and phone have not been used by another user.</div>';
			else
				echo userModel::userSubmit($_POST);
	
			}//termsandconditions
		} //isset
	} //post

?>

<?php
if(isset($_REQUEST['msg']) && $_REQUEST['msg']=="email_error")
	echo '<div class="col-md-12 text-center isa_error">Your registration details have been submitted. There was a problem relaying email. please contact admin.</div>';
?>


<form class="form" role="form" method="post" action="index.php?pg=reg"  id="signup-nav">
    <div class="col-md-12 form-group">
    	<div class="col-md-6">
            <label class="sr-only" for="exampleInputEmail2">First Name</label>
            <input type="text" class="form-control" name="fname" placeholder="First Name" required value="<?php echo isset($_POST['fname']) ? $_POST['fname'] : '' ; ?>">
   		</div>
        <div class="col-md-6">
            <label class="sr-only" for="exampleInputEmail2">Last Name</label>
            <input type="text" class="form-control" name="lname" placeholder="Last Name" required value="<?php echo isset($_POST['lname']) ? $_POST['lname'] : '' ; ?>">
        </div>   
    </div>
 
    <div class="col-md-12 form-group">
       	<div class="col-md-6">
            <label class="sr-only" for="exampleInputEmail2">Email address</label>
            <input type="email" class="form-control" name="emailadd" placeholder="Valid Email address" required value="<?php echo isset($_POST['emailadd']) ? $_POST['emailadd'] : '' ; ?>">
    	</div>
        <div class="col-md-6">
            <label class="sr-only" for="exampleInputPassword2">Phone</label>
            <input type="tel" class="form-control" name="phoneno" placeholder="Phone number 07xx yyy zzzz" required value="<?php echo isset($_POST['phoneno']) ? $_POST['phoneno'] : '' ; ?>" >
        </div>
    </div>
   
    <div class="col-md-12 form-group">
        <div class="col-md-3">
            <label class="sr-only" for="exampleInputPassword2">Alias</label>
            <input type="text" class="form-control" name="alias" placeholder="Name Alias" value="<?php echo isset($_POST['alias']) ? $_POST['alias'] : '' ; ?>" >
        </div>
        <div class="col-md-3">
            <label class="sr-only" for="exampleInputPassword2">Console</label>
        <select class="mdb-select md-form" name="consoleId">
       <option value="" disabled selected>Choose your Console</option>
        <option value="ps4">PS4</option>
        <option value="xboxone">XBox One</option>
        </select>
        </div>
      <div class="col-md-6" id="ps4" style="display:none;">
     <label class="sr-only" for="exampleInputPassword2">Game Tag</label>
     <input type="text" class="form-control" name="nametag" placeholder="Game Tag" value="<?php echo isset($_POST['nametag']) ? $_POST['nametag'] : '' ; ?>" >
     </div>
     
    </div>
        <div class="col-md-12">
       		<input type="checkbox" class="form-control" name="termsandconditions" value="1" required>
       		 <a href="index.php?pg=terms">By checking this message, I hereby confirm that I agree with the Terms and Conditions, that I am 18 years old or over and that all information given is true.
       		 </a>
    	</div>
   
    
    <div class="col-md-12 form-group">
    	<div class="col-md-12 text-center">
       		<input type="submit" name="submitThis" class="btn btn-success" value="Register" />
            
    	</div>
    </div>
    
       
         <script type="text/javascript">

     $(document).ready(function(){
         $("select").change(function(){
             $( "select option:selected").each(function(){
                 if($(this).attr("value")=="ps4"){
                     $(".box").hide();
                     $("#ps4").show();
                 }
                 if($(this).attr("value")=="xboxone"){
                     $("#ps4").show();
                 }
                 
             });
         }).change();
     });
     </script> 
</form>