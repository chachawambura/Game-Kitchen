<?php

if($_REQUEST['msg']=="success")
		echo '<div class="col-md-12 isa_success text-center">
				<p>You have successfully accepted the tournament. You can now play and post results.</p>
				<p class="font-bold">Play and post results within the next : '.GAME_DURATION.' mins.</p>
				<p><a href="'.$urls.'" class="button">Back to Tournaments</a></p>
			  </div>';
			  

if($_REQUEST['page']=="accept" && isset($tid))
	{
	
	$accepted = playModel::checkIfInviteAccepted($tid);
	
	if($accepted < 1 )
		echo playModel::acceptTournament($tid, $urls);
	else
		echo '<div class="col-md-12 isa_error text-center">
				<p>Someone has already accepted this tournament before you.</p>
				<p><a href="'.$urls.'" class="button">Back to Tournaments</a></p>
			  </div>';
	}




?>