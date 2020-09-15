<h3 class="sub-title text-center">My Profile Details</h3>

<?php
if(isset($_REQUEST['msg']))
	{
	if($_REQUEST['msg']=="success")
		echo '<div class="col-md-12 text-center isa_success">successfully updated records</div>';
	else
		echo '<div class="col-md-12 text-center isa_error">Failed to update records</div>';
	}
?>

<div class="col-md-12">

        <div class="col-md-4"><label>Full Name</label> : <?php echo userModel::userName(MYID); ?></div>
        <div class="col-md-4"><label>Email</label> : <?php echo $row->emailadd; ?></div>

        <div class="col-md-4"><label>Phone</label> : <?php echo $row->phone; ?></div>
        <div class="col-md-4"><label>D.O.B</label> : <?php echo baseModel::formatDate($row->dob); ?></div>
    
        <div class="col-md-4"><label>Gender</label> : <?php echo $row->gender; ?></div>
        <div class="col-md-4"><label>Id No / Ppt No</label> : <?php echo $row->idno; ?></div>
    
        <div class="col-md-4"><label>Date Joined</label> : <?php echo baseModel::formatDate($row->date_created); ?></div>
</div>      