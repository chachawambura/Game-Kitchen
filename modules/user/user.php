<?php 
$url = 'index.php?act=user';

$row = userModel::userDetails(MYID);

	
	
?>
<div class="container">
    <h2 class="heading">My Profile Details</h2>    
    <div class="col-md-12 content">
    
   		<?php
		
		$acc = $_REQUEST['acc'];
		
		switch($acc)
			{
			case "prof":
				include "profile_edit".EXT;
				break;
			case "pwd":
				include "password".EXT;
				break;
			default:
				include "profile".EXT;
				break;
			
			}
		?>
    
    </div>
</div>