<?php include "header.php"; ?>

<?php 
$myid = $_SESSION['myid']; 

$userlevel = $_SESSION['userlevel'];

$myDetails = userModel::userDetails($myid);

$pg = $_REQUEST['pg'];

if(isset($pg) && strlen(trim($pg)) >0 ):
	?>
	<div class="container">
	<?php
	
	 switch($pg)
		{				
		default:
			$file = _DEFAULT . DS. $pg.EXT;					
			$include = is_file($file) ? $pg : "home";
			break;                
		}                
	  include $include . EXT;
	?>
	</div>
	<?php  
else:	
	$include = ( strlen( PAGE ) > 0 ) ? PAGE : 'dashboard';
	$module = ( strlen( PAGE ) > 0 ) ? PAGE : 'dashboard';
	include _PARENT . $module . DS . $module . EXT;			
endif;	


?>


<?php include _DEFAULT . DS . "footer" . EXT; ?>