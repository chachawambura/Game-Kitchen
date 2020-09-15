<h3 class="sub-title text-center">Edit My Profile Details</h3>

<?php 

if( MYID < 1)
	echo '<script>self.location="index.php"</script>';

if(isset($_POST['submitThis']) && $_POST['submitThis'] == "Save")
	{
	
	if(!isset($_POST['fname']) || !isset($_POST['lname']) || !isset($_POST['phone']) || !isset($_POST['dob']) || !isset($_POST['gender']) || !isset($_POST['county_id']) || !isset($_POST['campus']) || !isset($_POST['admin_no']) || !isset($_POST['course_id']) || !isset($_POST['year_of_study']) )
		{
		echo '<div class="col-md-12 isa_error text-center">You have to fill all the details.</div>';
		}
	else
		{
		echo userModel::userSubmit($_POST);
			
		} //isset

	} //post

?>

<?php

$fname = isset($_POST['fname']) ? $_POST['fname'] : (isset($row->fname) ? $row->fname : '') ;
$lname = isset($_POST['lname']) ? $_POST['lname'] : (isset($row->lname) ? $row->lname : '') ;
$phone = isset($_POST['phone']) ? $_POST['phone'] : (isset($row->phone) ? $row->phone : '') ;
$dob = isset($_POST['dob']) ? $_POST['dob'] : (isset($row->dob) ? date("d/m/Y",strtotime($row->dob)) : '') ;
$admin_no = isset($_POST['admin_no']) ? $_POST['admin_no'] : (isset($row->admin_no) ? $row->admin_no : '') ;
$campus = isset($_POST['campus']) ? $_POST['campus'] : (isset($row->campus) ? $row->campus : '') ;

$select_male = isset($_POST['gender']) && $_POST['gender']=="Male" ? 'selected="selected"' : (isset($row->gender) && $row->gender =="Male" ? 'selected="selected"' : '');
$select_female = isset($_POST['gender']) && $_POST['gender']=="Female" ? 'selected="selected"' : (isset($row->gender) && $row->gender =="Female" ? 'selected="selected"' : '');


?>

<form action="" method="post" class="register"> 

    <div class="col-md-6 row">
        <div class="col-md-6"><label for="lfirstname" class="lfname" data-icon="u" > First Name </label></div>
        <div class="col-md-6"><input id="fname" name="fname" required type="text" placeholder="First Name" value="<?php echo $fname; ?>" /></div>
    </div>
                        
    <div class="col-md-6 row">
        <div class="col-md-6"><label for="llastname" class="llname" data-icon="u" > Last Name </label></div>
        <div class="col-md-6"><input id="lname" name="lname" required type="text" placeholder="Last Name" value="<?php echo $lname; ?>" /></div>
    </div>
    
    <div class="col-md-6 row">
        <div class="col-md-6"><label for="phonel" class="phonel" data-icon="9" > Phone Number </label></div>
        <div class="col-md-6"><input id="phone" name="phone" required type="tel" placeholder="07xxyyyzzz"  value="<?php echo $phone; ?>" /></div>
    </div>
    <div class="col-md-6 row">
        <div class="col-md-6"><label for="emaill" class="emaill" data-icon="e" > Email </label></div>
        <div class="col-md-6"><?php echo $row->emailadd; ?></div>
    </div>
    
    <div class="col-md-6 row">
        <div class="col-md-6"><label for="emaill" class="emaill" data-icon="e" >Id No / Ppt No</label></div>
        <div class="col-md-6"><?php echo $row->idno; ?></div>
    </div>    
    <div class="col-md-6 row">
        <div class="col-md-6"><label for="dob" class="dob" > Date Of Birth </label></div>
        <div class="col-md-6"><input type="text" name="dob" id="dob" placeholder="click to pick date" required value="<?php echo $dob; ?>" readonly="readonly" /></div>
    </div>
    
    <div class="col-md-6 row">
        <div class="col-md-6"><label for="genderl" class="genderl" > Gender </label></div>
        <div class="col-md-6">
            <select name="gender" id="gender" required >						
                <option value="">Select Gender</option>
                <option value="Female" <?php echo $select_female; ?>>Female</option>                
                <option value="Male" <?php echo $select_male; ?> >Male</option>
            </select>
        </div>
    </div>
    
    
	
    <div class="col-md-12 text-center"> 
    	<input type="submit" value="Save" name="submitThis" />
    	<a href="index.php?act=user" class="button">Cancel</a>
    </div>
	
    <input type="hidden" name="url" value="index.php?act=user" />
    <input type="hidden" name="user_id" value="<?php echo MYID ?>" />
    
</form>

<script>  
$(function(){
	$("#dob").datepicker(
		{
			minDate: new Date(1980,1-1,1), maxDate: '-18Y',
			dateFormat: 'dd/mm/yy',
			changeMonth: true,
			changeYear: true,
			yearRange: '-110:-18'
		}
	);
});
</script>
