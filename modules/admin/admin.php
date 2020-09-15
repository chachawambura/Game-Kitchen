<div class="table-responsive">
    <div class="row">
		<div class="col-xs-12">
			<div class="tabbable tabs-left">
				<ul class="nav nav-tabs">
        <li><a href="index.php?acc=allgames">All Games</a></li>
        <li><a href="index.php?acc=gamescategory">Games Category</a></li>
        <li><a href="index.php?acc=addgamecategory">New Game Category</a></li>
        <li><a href="index.php?acc=addLeague">Add League</a></li>
        <li><a href="index.php?acc=showLeague">Show League</a></li>
        <li><a href="index.php?acc=userslist">User List</a></li>
        <!--<li><a href="index.php?acc=userlogs">User Logs</a></li> -->
        <li><a href="index.php?acc=transactions">Transactions</a></li>  
        <li><a href="index.php?acc=disputes">Disputes List</a></li>
        <li><a href="index.php?acc=manualtopup">Manual Top Up</a></li>      
        
        <?php if(USRLVL==1): ?>
          
        <?php endif; ?>
        
	</ul>
</div>

<div class="col-md-12">
	<?php
	$acc = $_REQUEST['acc'];	
	$playerId = $_REQUEST['playerId'];
	$gameId = $_REQUEST['gameId'];
	switch($acc)
		{

		default:
			$file = APPLIC . DS . $mod . DS . $acc. EXT;
			if(is_file($file))
				include $file;
			else
				include "summ".EXT;
			break;	
			
		}	
	
	?>

</div>
</div>
</div>
</div>
