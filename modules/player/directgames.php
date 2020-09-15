
<div class="col-md-12">
        
<form action="#" method="post">
    Select all Notifications as read ?
    <input type="checkbox" name="formWheelchair" value="Yes" />
    <input type="submit" name="formSubmit" value="Submit" />
</form>



    <?php
if(isset($_POST['formWheelchair']) && 
   $_POST['formWheelchair'] == 'Yes') 
{
   echo dashboardModel::checkAllAsRead();
}


?>
</div>

<?php
$games = playModel::showDirectChallenges(MYID);
//print_r($games);
$urls = 'index.php?acc=games';


if(count($games) < 1 ):
echo '<div class="col-md-12 isa_warning text-center">There are no active games</div>';
else:

foreach($games as $game)
{
	if($game->game_type=="direct"){
	$file = GAMES_ICONS_FOLDER . $game->gameImage ;
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
	$player2=$game->player_2;
	$stake = $game->player1_stake;
	$winstatus = $game->win_status;
	//'.$urls.'&page=cancel_mygame&currentgameId='.$row->id.
	
	if($myid==$gameId){
		//echo 'player 1 logged in';
		if($game->player2_stake=="0"){
		if($game->win_status=="pending"){
			$remessage ='<a href="#"><strong>Waiting Accept</strong></a>';
			$cance ='<a href="'.$urls.'&page=cancelNow&currentgameId='.$game->id.'&playerId='.$gameId.'&stake='.$stake.'"><strong>Cancel</strong></a>';    
			}else {
		    if($game->win_status=="cancelled"){
			$remessage ='<a href="#"><strong>Cancelled</strong></a>';
			$cance ='<a href="#"><strong>Completed</strong></a>';
		    }else{
		    $remessage ='<a href="#"><strong>Finished</strong></a>';
		    }
		}
		}else {
		    
		$remessage ='<strong><a href="#">Accepted</a>';
		}
	}else if($myid==$player2){
		if($game->player2_stake=="0"){
			if($balance< $stake){
				echo '<div class="col-md-12 isa_error text-center"><strong>You have Insufficient funds. Please top up to accept challenge.</strong></div>';
			}else {
			    if($game->win_status=="cancelled"){
			        $remessage='<a href="#"><strong>Game Cancelled</strong></a>';
			        $cance ='<a href="#"><strong>Back</strong></a>';
			    }else{
                    $getstatus='0';
                   $gamesList = playModel::listActiveGames(MYID, $getstatus);
                   $gettotal = count($gamesList);
                    if($gettotal==0){
                    $remessage='<a href="index.php?acc=games&page=acceptChallenge&gid='.$game->id.'"><strong>Accept</strong></a>';
			        $cance ='<a href="index.php?acc=games&page=declineChallenge&gid='.$game->id.'&playerId='.$gameId.'&stake='.$stake.'"><strong>Decline</strong></a>';
                    }else{
                   $remessage='<a href="#"><strong>Exists</strong></a>';
			        $cance ='<a href="#"><strong>Exists</strong></a>';
                    }
			        
			    }
				
			}
		}else {
			$remessage='<strong><a href="#">Challenge Accepted</a></strong>';
		$cance ='<a href="index.php?acc=directgames"><strong>Back</strong></a>';
		}
		//echo 'player 2 logged in';
	}
	//echo $gameId;
	$opp = userModel::userDetails($player2);
	$opp2 = userModel::userDetails($gameId);
	if($status==0){
		$mstatus ="Active";
	}else if($myid==$gameId){
		$mstatus =$opp->alias;
		
	}else {
		//$mstatus ="Joined";
		$mstatus =$opp2->alias;
	}
	$img = is_file( $file ) ? $file : NO_IMAGE ;
	
	$image = is_file($img) ? '<img src="upload/'.$tes->gameImage.'" align="left" >' : '';
	
	$details = '<h4>'.$tes->gametitle.'</h4>
					<p><label>CAT</label>'.$tes->gametitle.'</p>
					<p><label>Prize</label><strong>'.$exactv.'</strong></p>
					<p><label>Entry Fee</label> '.$game->player1_stake.'</p>
                    <p><label>Status</label><strong>'.$mstatus.'</strong></p>
                    <p><label>Date</label> '.$game->date_created.'</p>
					<p class="readmore">'.$remessage.' '.$cance.'
                       
                     </p>';
	
	//echo $file;
	
	echo '<div class="col-md-6 game-details">
					<div class="col-md-6">' .$image . '</div><div class="col-md-6">' . $details .'</div>
			  </div>';
}
}

endif;




?>



