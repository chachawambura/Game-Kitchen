<?php
$win ="Yes";
$draw="";
$lose="No";
$gamesList = playModel::listMyGameHistoryByPlayerID(MYID);

//print_r($gamesList);
$urls = 'index.php?acc=games';

?>
<table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
  <thead>
    <tr>
      <th class="th-sm">Date & Time</th>
      <th class="th-sm">Game</th>
      <th class="th-sm">Player 2</th>
      <th class="th-sm">Stake</th>
      <th class="th-sm">Status

      </th>
    </tr>
  </thead>
  <tbody>
  <?php 
  
  if(count($gamesList) < 1 ):
  echo '<div class="col-md-12 isa_warning text-center">There are no games</div>';
  else:
  
  foreach($gamesList as $game)
  {
  	$d = $game->date_created;
  	$categId = $game->gamecategory_id;
  	$tes = dashboardModel::getGameByCategoryId($categId);
  	$player1 = $game->player_1;
  	$player2 = $game->player_2;
  	$gameId = $game->id;
  	$result1 = $game->player_1_result;
  	$result2 = $game->player_2_result;
  	if(MYID==$player1){
  		//echo 'player 1';oneplayer1Details
  		$status = playModel::oneplayer1Details($player1, $gameId);
  	 $getopp =userModel::userDetails($player2);
  	 if($game->player_2=="NULL"){
  	 	$fullnames ="No Opponent";
  	 }else{
  	 	$fullnames = $getopp->fname. " ".$getopp->lname;
  	 }
  	
  	 
  	}else if(MYID==$player2){
  	 //echo 'player 2';
  	 $getopp =userModel::userDetails($player1);
  	 $status = playModel::oneplayer2Details($player2, $gameId);
  	 $mystatus = "<strong> $status->win_status</strong>";
  	 if($game->player_1=="NULL"){
  	 	$fullnames ="No Opponent";
  	 }else{
  	 	$fullnames = $getopp->fname. " ".$getopp->lname;
  	 }
  	}
  	if($game->player2_result=="NULL"){
  		$mystatus = "<strong>waiting</strong>";
  	}else if($game->player1_result !="NULL" && $game->win_status=="cancelled"){
  	    $mystatus = "<strong>direct cancel</strong>";
  	}else {
  		$mystatus = "<strong> $status->win_status</strong>";
  	}
  	$opti = $getopp->alias;
  
  	
  	echo '<tr>
            <td>'.$d.'</td>'
		    . '<td>'.$tes->gametitle.'</td>'
  			. '<td><strong>'.$fullnames.'</strong></td>'
      		. '<td>'.$game->player1_stake.'</td>'
  			. '<td>'.$mystatus.'</td></tr>';
  	}
  
  endif;
  ?>
  </tbody>
  </table>

