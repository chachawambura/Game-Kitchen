<?php

$games = playModel::listMyGames(MYID);
//print_r($games);
$urls = 'index.php?acc=games';
$joingameId = $_REQUEST['&page=invite&gid'];
if(count($games) < 1 ):
echo '<div class="col-md-12 isa_warning text-center">There are no games</div>';
else:

foreach($games as $game)
{
	if($game->cancellation_status != "cancelled"){
	$file = GAMES_FOLDER . $game->gameImage ;
	$categId = $game->gamecategory_id;
	$tes = dashboardModel::getGameByCategoryId($categId);
	//print_r($tes);
	//$total = $game->player1_stake * 2-0.15*$game->player1_stake;
	
	$total =$game->player1_stake*2;
	$diff = ($total*15/100);
	
	$exactv = ($total-$diff);
	
	$status =$game->game_status;
	$myid =MYID;

	$gameId=$game->player_1;
	$gameId2=$game->player_2;
	$cancel = $game->cancellation_status;
	$gameId;
	//echo $myid.$gameId;
	if($status==0 && $cancel !="cancelled"){
		$mstatus ="Active";
	}else if($myid==$gameId && $cancel !="cancelled"){
		$mstatus ="";
		//echo $gameId2;
	}else if($status==1){
		$mstatus ="Joined";
		//echo $status;
	}else if($myid==$gameId && $cancel=="cancelled"){
		$mstatus ="cancelled";
	}
	$img = is_file( $file ) ? $file : NO_IMAGE ;
	
	$image = is_file($img) ? '<img src="upload/'.$tes->gameImage.'" align="left" >' : '';
	
	$details = '<h4>'.$game->gametitle.'</h4>
					<p><label>CAT</label>'.$tes->gametitle.'</p>
					<p><label>Prize</label><strong>'.$exactv.'</strong></p>
					<p><label>Entry Fee</label> '.$game->player1_stake.'</p>
                    <p><label>Status</label><strong>'.$mstatus.'</strong></p>
                    <p><label>Date</label> '.$game->date_created.'</p>
                    
					<p class="readmore"><a href="'.$urls.'&page=details&gid='.$game->id.'"><strong>View Tournament</strong></a></p>';
	
	//echo $file;
	
	echo '<div class="col-md-5 game-details">
					<div class="col-md-6">' .$image . '</div><div class="col-md-6">' . $details .'</div>
			  </div>';
	}
}

endif;



?>

