<?php 
//echo "my id ",$userId;
$currentgameId = baseModel::gameDetails($gid);
$gameId = $currentgameId->id;
$st = $currentgameId->date_created;
$at = $currentgameId->date_invite_accepted;
$et = $currentgameId->tournament_end_date;
$alrtime = $currentgameId->alert_time;
$player1 =$currentgameId->player_1;
$player2 =$currentgameId->player_2;
$stake = $currentgameId->player1_stake;
$rest1 =$currentgameId->player_1_result;
$rest2=$currentgameId->player_2_result;
$getplayer1 =($currentgameId->player1_stake)*2;
$prize =$getplayer1-(15/100*$getplayer1);

//echo "Alert time :: ",$alrtime;
$starttime = date("H:i:s",strtotime($st));
$accepttime = date("H:i:s",strtotime($at));
$endtime = date("H:i:s",strtotime($et));
$showalert = date("H:i:s",strtotime($alrtime));
$currenttime = date("H:i:s");
$todaysDate = date('Y-m-d H:i:s');

if($currenttime >= $starttime && $currenttime <= $endtime){
	
	// between times
	//echo "<strong> within time </strong><br/>";
} else {
	// not between times
	//echo "<strong>past time $currentgameId->player_1_result<br/> </strong>";
	if(MYID==$player1){
		//echo 'player 1';
		if($rest1=="NULL" && $rest2=="NULL" && $player2 !="NULL" && $currentgameId->win_status !="awarded"){
			//echo 'Draw';
			echo playModel::automaticShareBetweenPlayers($player1, $player2, $gameId, $prize);
			
		}else if($rest1=="Yes" && $rest2=="NULL" && $player2 !="NULL" && $currentgameId->win_status !="awarded"){
			//echo 'player 1 awarded ';
		  echo playModel::automaticPayOutPlayer1($player1, $player2,  $gameId, $prize);
		 
		}else if($rest1=="NULL" && $rest2=="Yes" && $player2 !="NULL" && $currentgameId->win_status !="awarded"){
			//echo 'player 2 to be awarded ';
			echo playModel::automaticPayOutPlayer2($player2, $player1, $gameId, $prize);
			
		}else if($rest1=="No" && $rest2=="NULL" && $player2 !="NULL" && $currentgameId->win_status !="awarded"){
			//echo 'dispute created by player 1';
			
			echo playModel::automaticPayer1DisputeCreated($player2Id,$player1Id, $gameId, $prize);
		}else if($rest1=="NULL" && $rest2=="No" && $player2 !="NULL" && $currentgameId->win_status !="awarded"){
			//echo 'dispute created by player 2';
			
			echo playModel::automaticPayer2DisputeCreated($player1,$player2, $gameId, $prize);
		}else if($rest1=="NULL" && $rest2=="NULL" && $player2 =="NULL" && $currentgameId->win_status !="awarded"){
			//echo 'refund player 1';
		   echo playModel::automaticRefundToPlayer($player1,$gameId, $stake);
			
		}
	}else if(MYID==$player2){
		//echo 'player 2';
		
		if($rest1=="NULL" && $rest2=="NULL" && $player1 !="NULL" && $currentgameId->win_status !="awarded"){
			//echo 'Draw';
			echo playModel::automaticShareBetweenPlayers($player1, $player2, $gameId, $prize);
		}else if($rest1=="Yes" && $rest2=="NULL" && $player2 !="NULL" && $currentgameId->win_status !="awarded"){
			//echo 'player 1 awarded ';
			echo playModel::automaticPayOutPlayer1($player1, $player2,  $gameId, $prize);
		}else if($rest1=="NULL" && $rest2=="Yes" && $player1 !="NULL" && $currentgameId->win_status !="awarded"){
			//echo 'player 2 to be awarded ';
			echo playModel::automaticPayOutPlayer2($player2, $player1, $gameId, $prize);
		}else if($rest1=="No" && $rest2=="NULL" && $player1 !="NULL" && $currentgameId->win_status !="awarded"){
			//echo 'dispute created by player 1';
			echo playModel::automaticPayer1DisputeCreated($player2Id,$player1Id, $gameId, $prize);
		}else if($rest1=="NULL" && $rest2=="No" && $player1 !="NULL" && $currentgameId->win_status !="awarded"){
			//echo 'dispute created by player 2';
			echo playModel::automaticPayer2DisputeCreated($player1,$player2, $gameId, $prize);
		}else if($rest1=="NULL" && $rest2=="NULL" && $player1 =="NULL" && $currentgameId->win_status !="awarded"){
			//echo 'refund player 1';
			echo playModel::automaticRefundToPlayer($player1,$gameId, $stake);
			
		}
	}
}

?>