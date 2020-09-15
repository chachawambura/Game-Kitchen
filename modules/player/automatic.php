<?php 
header('Refresh: 10');

$userId = MYID;

$playerId = baseModel::gameDetails($gid);

//print_r($playerId);
$player1 = $playerId->player_1;

$gameId = $playerId->id;

$player2 = $playerId->player_2;


$getplayer1 =($playerId->player1_stake)*2;
$prize =$getplayer1-(15/100*$getplayer1);
if(MYID==$player1){
	if($playerId->player_1_result=="Yes" && $playerId->player_2_result=="No" && $playerId->win_status !="awarded" ){
		
		//echo 'reward player 1 automatic !!';
		echo playModel::automaticPayOutPlayer1($player1, $player2, $gameId, $prize);
      
	}else if($playerId->player_2_result=="Yes" && $playerId->player_1_result=="No" && $playerId->win_status !="awarded"){
		echo playModel::automaticPayOutPlayer2($player2, $player1, $gameId, $prize);
		//echo 'reward player 2 automatic !!';
		
		
	}else if($playerId->player_2_result=="No" && $playerId->player_1_result=="No" && $playerId->win_status !="awarded"){
		echo playModel::automaticShareBetweenPlayers($player1, $player2, $gameId, $prize);
		//echo 'this is a draw share between players !!';
	}
}else if(MYID==$player2){
	
	if($playerId->player_1_result=="Yes" && $playerId->player_2_result=="No" && $playerId->win_status !="awarded" ){
		
		//echo 'reward player 1 automatic !!';
		echo playModel::automaticPayOutPlayer1($player1, $player2, $gameId, $prize);
		
	}else if($playerId->player_2_result=="Yes" && $playerId->player_1_result=="No" && $playerId->win_status !="awarded"){
		echo playModel::automaticPayOutPlayer2($player2, $player1, $gameId, $prize);
		//echo 'reward player 2 automatic !!';
		
		
	}else if($playerId->player_2_result=="No" && $playerId->player_1_result=="No" && $playerId->win_status !="awarded"){
		
		echo playModel::automaticShareBetweenPlayers($player1, $player2, $gameId, $prize);
		//echo 'this is a draw share between players !!';
	}
	
}

?>