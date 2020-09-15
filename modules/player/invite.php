<?php
if($_REQUEST['page']=="invite")
	{
	
	$pending = playModel::checkIfInvitePending(MYID, $gid);
	
	if($pending < 1 )
		echo playModel::inviteToTournament($gid, $urls);
	else
		echo '<div class="col-md-12 isa_error text-center">
				<p>You have a pending invite on this game, waiting response. You cant invite twice for the same game.</p>
				<p><a href="'.$urls.'" class="button">Back to Games</a></p>
			  </div>';
	}




?>