<?php 	
	$row = userModel::userDetails( $_GET['id'] ); 
?>

<div class="notes">NB: The areas disabled can only be changed by the administrator.</div>


<form action="<?php echo $url; ?>&task=submit" method="post" enctype="multipart/form-data" name="form" id="form" onsubmit="return userfrm();">
<table>    

<?php if( $_GET['err'] == 10 ) : ?>
<tr><td colspan="2"><span class="error">Failed to upload the photo. Try again.</span></td></tr>
<?php endif; ?>

<?php if( $_GET['err'] == 11 ) : ?>
<tr><td colspan="2"><span class="error">Invalid File ~ Must be jpeg/gif/png/bmp</span></td></tr>
<?php endif; ?>

<tr>
	<td width="35%"><label>First name</label></td>
    <td width="65%"><input type="text" name="fname" id="fname" value="<?php echo $row->fname; ?>" disabled="disabled"/></td>
</tr>
<tr>
	<td><label>Last name</label></td>
	<td><input class="inputtype" type="text" name="lname" id="lname" value="<?php echo $row->lname; ?>" disabled="disabled" /></td>
</tr>
<tr><td><label>Job Title</label></td><td><input class="inputtype" type="text" name="job_title" id="job_title" value="<?php echo $row->job_title; ?>" disabled="disabled" /></td></tr>
<tr>
	<td valign="top"><label>Job Description</label></td>
    <td><textarea class="inputtype1" name="job_description" id="job_description"><?php echo $row->job_description; ?></textarea></td>
</tr>
<tr><td valign="top"><label>Skills</label></td><td><textarea class="inputtype" name="skills" id="skills"><?php echo $row->skills; ?></textarea></td></tr>
<tr>
	<td><label>Location</label></td>
	<td>
    	<select name="location_id" id="location_id" disabled="disabled">
        	<option value=""> --- </option>
            <?php echo baseModel::locationOptions( $row->location_id ); ?>
        </select>
    </td>
</tr>
<tr>
	<td><label>Department</label></td>
	<td>
    	<select name="department_id" id="department_id" disabled="disabled">
        	<option value=""> --- </option>
            <?php echo baseModel::departmentOptions( $row->department_id ); ?>
        </select>
    </td>
</tr>
<tr><td><label>Email</label></td><td><input class="inputtype" type="text" name="email" id="email" value="<?php echo $row->email; ?>" disabled="disabled" /></td></tr>
<tr><td><label>Work Phone / Ext</label>&nbsp;<span class="asterisk">*</span></td><td><input class="inputtype" type="text" name="work_phone" id="work_phone" value="<?php echo $row->work_phone; ?>" /></td></tr>
<tr>
	<td><label>Mobile Phone</label>&nbsp;<span class="asterisk">*</span></td>
	<td><input class="inputtype" type="text" name="mobile_phone" id="mobile_phone" value="<?php echo $row->mobile_phone; ?>" /></td>
</tr>
<tr>
	<td><label>Date of Birth</label>&nbsp;<span class="asterisk">*</span></td>
    <td><input class="inputtype" type="text" name="date_of_birth" id="date_of_birth" readonly="readonly" value="<?php echo $row->date_of_birth; ?>" /></td>
</tr>
<tr>
	<td><label>Gender</label></td>
    <td>
    	<select class="inputtype3" name="gender" id="gender" disabled="disabled">
        	<option value="<?php echo $row->gender; ?>"> <?php echo baseModel::genderTitle( $row->gender ); ?> </option>
            <option value=""> --- </option>
            <option value="1"> Female </option>            
            <option value="0"> Male </option>
        </select>        
    </td>
</tr>
<tr>
	<td><label>Out of Office</label></td>
    <td>
    	<select name="out_of_office" id="out_of_office">
        	<option value="<?php echo $row->out_of_office; ?>"> <?php echo baseModel::outOfOfficeTitle( $row->out_of_office ); ?> </option>
            <option value=""> --- </option>
            <option value="1"> Yes </option>
            <option value="0"> No </option>
        </select>   
    </td>
</tr>
<tr><td><label>Profile Picture</label></td><td><input type="file" name="profile_picture" id="profile_picture" /></td></tr>
<tr><td colspan="2">&nbsp;</td></tr>
<tr>
	<td></td>
    <td>
    	<input type="submit" name="submit" id="submit" value="Save" />
        <a class="button" onclick="history.go(-1);">Cancel</a>
  	</td>
</tr>
<tr><td colspan="2">&nbsp;</td></tr>
</table>
<input type="hidden" name="user_id" id="user_id" value="<?php echo $row->user_id; ?>" />
<input type="hidden" name="url" id="url" value="<?php echo $url; ?>" />
</form> 
<script type="text/javascript">    
	Calendar.setup({
	inputField     :    "date_of_birth",   // id of the input field
	ifFormat       :    "%Y-%m-%d",       // format of the input field
	showsTime      :    true,
	timeFormat     :    "24",			
});
</script>             	 	 	 	 	 	 	 	 	 	 	