<?php

class playModel {
	
	
	
	public function  addRedStroke( $playerId, $mycolor ) {
		
		echo 'color red added !!!',$playerId,"Color :: ",$mycolor;
		
		$sql = new MYSQL;
		$query = $sql->update(' gaming_strikes gp1 ');
		$query .= $sql->set(" gp1.gaming_red ='". $mycolor ."' ");
		$query .= $sql->where( " gp1.user_id = " . $playerId . " " );
		$rows = DBASE::mysqlUpdate($query);
		
		echo '<script>self.location="index.php?acc=userslist"</script>';
		
	}
	//cance direct challenge
	
	//widthrawal code
	
	public function submitWithdrawalNow($amount, $phone){
	    
	    echo $amount+'Telephone'+$phone;
	    
	}
	
	public function cancelDirectChallenge($gid, $playerId, $stake){
	    
	    echo  'current ID',$gid,"player id",$playerId,'stake',$stake;
	    
	    $refund = "refunded";
	    $status="1";
	    $gcount='1';
	    $cancel = "cancelled";
	    $mnt = " has cancelled game with Id";
	    $myreason='Direct Game Cancelled';
	    //echo "Game Id :", $gameId. "Player Id :",$playerId. " My Reason :", $myreason;
	    
	    $sql = new MYSQL;
	    $query = $sql->insert( ' game_cancellation ' );
	    $query .= $sql->columns('gameId, playerId, myreason, amountRefunded, date_created, refund_status' );
	    $query .= $sql->values( " '".$gid."', ".$playerId.", '".$myreason."', '".$stake."', '".date("Y-m-d H:i:s")."', '".$refund."'  "  );
	    $rows = DBASE::mysqlInsert( $query);
	    //update balance
	    $query = $sql->update( ' balance ' );
	    $query .= $sql->set("balance = balance+$stake ");
	    $query .= $sql->where('uid=' . $playerId);
	    $rows = DBASE::mysqlUpdate( $query );
	    
	    //update wallet.
	    
	    $sql = new MYSQL;
	    $query = $sql->update(' gaming_wallet ');
	    $query .= $sql->set(" balance = balance-$stake ");
	    $rows = DBASE::mysqlUpdate($query);
	    
	    //update alert
	    $sql = new MYSQL;
	    $query = $sql->insert( ' gaming_alerts ' );
	    $query .= $sql->columns('usr_id, date_created, description, alert_type, read_status' );
	    $query .= $sql->values( " '".$playerId."', '".date("Y-m-d H:i:s")."', '".$mnt."', 'automatic cancellation', '0'  "  );
	    $rows = DBASE::mysqlUpdate($query);
	    
	    
	    //update player 1
	    
	    $query = $sql->update( ' gaming_player1 ply1 ' );
	    $query .= $sql->set("win_status = '$cancel' ");
	    $query .= $sql->where('ply1.gameId=' . $gid);
	    $rows = DBASE::mysqlUpdate( $query );
	    
	    //update game to cancelled
	    $query = $sql->update( ' game gm ' );
	    $query .= $sql->set("gm.cancellation_status = '$cancel', gm.game_status='1', gm.win_status='cancelled', gm.game_count ='". $gcount ."' ");
	    $query .= $sql->where('gm.id=' . $gid);
	    $rows = DBASE::mysqlUpdate( $query );
	    
	    echo '<script>self.location="index.php?acc=gamesactive"</script>';
	}
	
	public function declineDirectChallenge($gid, $playerId, $stake){
	    
	    echo  'current ID',$gid,"player id",$playerId,'stake',$stake;
	    
	    
	    $refund = "refunded";
	    $status="1";
	    $gcount='1';
	    $cancel = "cancelled";
	    $mnt = " has cancelled game with Id";
	    $myreason='Direct Game Cancelled';
	    //echo "Game Id :", $gameId. "Player Id :",$playerId. " My Reason :", $myreason;
	    
	    $sql = new MYSQL;
	    $query = $sql->insert( ' game_cancellation ' );
	    $query .= $sql->columns('gameId, playerId, myreason, amountRefunded, date_created, refund_status' );
	    $query .= $sql->values( " '".$gid."', ".$playerId.", '".$myreason."', '".$stake."', '".date("Y-m-d H:i:s")."', '".$refund."'  "  );
	    $rows = DBASE::mysqlInsert( $query);
	    //update balance
	    $query = $sql->update( ' balance ' );
	    $query .= $sql->set("balance = balance+$stake ");
	    $query .= $sql->where('uid=' . $playerId);
	    $rows = DBASE::mysqlUpdate( $query );
	    
	    //update wallet.
	    
	    $sql = new MYSQL;
	    $query = $sql->update(' gaming_wallet ');
	    $query .= $sql->set(" balance = balance-$stake ");
	    $rows = DBASE::mysqlUpdate($query);
	    
	    //update alert
	    $sql = new MYSQL;
	    $query = $sql->insert( ' gaming_alerts ' );
	    $query .= $sql->columns('usr_id, date_created, description, alert_type, read_status' );
	    $query .= $sql->values( " '".$playerId."', '".date("Y-m-d H:i:s")."', '".$mnt."', 'automatic cancellation', '0'  "  );
	    $rows = DBASE::mysqlUpdate($query);
	    
	    
	    //update player 1
	    
	    $query = $sql->update( ' gaming_player1 ply1 ' );
	    $query .= $sql->set("win_status = '$cancel' ");
	    $query .= $sql->where('ply1.gameId=' . $gid);
	    $rows = DBASE::mysqlUpdate( $query );
	    
	    //update game to cancelled
	    $query = $sql->update( ' game gm ' );
	    $query .= $sql->set("gm.cancellation_status = '$cancel', gm.game_status='1', gm.win_status='cancelled', gm.game_count ='". $gcount ."' ");
	    $query .= $sql->where('gm.id=' . $gid);
	    $rows = DBASE::mysqlUpdate( $query );
	    echo '<script>self.location="index.php?acc=gamesactive"</script>';
	}
	
	public function  addGreenStroke( $playerId,  $mycolor ) {
		
		echo 'color green added !!!',$playerId,"Color :",$mycolor;
		
		$sql = new MYSQL;
		$query = $sql->update(' gaming_strikes gp1 ');
		$query .= $sql->set(" gp1.gaming_green ='". $mycolor ."' ");
		$query .= $sql->where( " gp1.user_id = " . $playerId . " " );
		$rows = DBASE::mysqlUpdate($query);
		
		echo '<script>self.location="index.php?acc=userslist"</script>';
		
	}
	
	//remind player 1
	
	public function alertPlayer1($player1, $gameId, $status){
	    $alertt ="It seems your game doesnt have an opponent automatic refund will be done after 10 minutes Thanks";
	    $sql = new MYSQL;
	    $query = $sql->insert(' gaming_alerts ');
	    $query .= $sql->columns(' usr_id, date_created, description, alert_type, read_status  ' );
	    $query .= $sql->values( " '".$player1."', '".date("Y-m-d H:i:s")."', '".$alertt."', 'Pending Result', '0'");
	    $rows = DBASE::mysqlUpdate($query);
	    
	    //update gaming notifications
	    $sql = new MYSQL;
	    $query = $sql->update(' gaming_notifications gp1');
	    $query .= $sql->set(" gp1.game_status ='1' ");
	    $query .= $sql->where( " gp1.game_id = " . $gameId . " " );
	    $rows = DBASE::mysqlUpdate($query);
	    
	}
	// remind both players 
	
	public function alertBothPlayers($player1, $player2,  $gameId, $status){
	
	    $alertt ="Please submit your game outcome before the system rewards the winner automatically";
	    $sql = new MYSQL;
	    $query = $sql->insert(' gaming_alerts ');
	    $query .= $sql->columns(' usr_id, date_created, description, alert_type, read_status  ' );
	    $query .= $sql->values( " '".$player1."', '".date("Y-m-d H:i:s")."', '".$alertt."', 'Pending Result', '0'");
	    $rows = DBASE::mysqlUpdate($query);
	    //player 2
	    $sql = new MYSQL;
	    $query = $sql->insert(' gaming_alerts ');
	    $query .= $sql->columns(' usr_id, date_created, description, alert_type, read_status  ' );
	    $query .= $sql->values( " '".$player2."', '".date("Y-m-d H:i:s")."', '".$alertt."', 'Pending Result', '0'");
	    $rows = DBASE::mysqlUpdate($query);
	    //update gaming notifications
	    
	    $sql = new MYSQL;
	    $query = $sql->update(' gaming_notifications gp1');
	    $query .= $sql->set(" gp1.game_status ='1' ");
	    $query .= $sql->where( " gp1.game_id = " . $gameId . " " );
	    $rows = DBASE::mysqlUpdate($query);
	    
	    
	    
	}
	public function  addOrangeStroke( $playerId, $mycolor ) {
		
		echo 'color orange added !!!',$playerId,"Color :",$mycolor;
		$sql = new MYSQL;
		$query = $sql->update(' gaming_strikes gp1 ');
		$query .= $sql->set(" gp1.gaming_orange ='". $mycolor ."' ");
		$query .= $sql->where( " gp1.user_id = " . $playerId . " " );
		$rows = DBASE::mysqlUpdate($query);
		
		echo '<script>self.location="index.php?acc=userslist"</script>';
		
	}
	
	
	
	public function awardAllPlayersNow( $post ){
		
		$gameId = $post['myGameId'];
		$player2Id = $post['player2Id'];
		$prizeId =  $post['prizeId'];
		$player1Id =  $post['player1Id'];
		$rewa = ($prizeId/2);
		$sta ="draw";
		$gcount='1';
		$sql = new MYSQL;
		$query = $sql->update(' gaming_player1 gp1 ');
		$query .= $sql->set(" gp1.win_status ='". $sta ."' ");
		$query .= $sql->where( " gp1.gameId = " . $gameId . " AND  gp1.player_1 = " . $player1Id . " " );
		$rows = DBASE::mysqlUpdate($query);
		//update winner
		$sql = new MYSQL;
		$query = $sql->update(' gaming_player2 gp1');
		$query .= $sql->set(" gp1.win_status ='". $sta ."' ");
		$query .= $sql->where( " gp1.gameId = " . $gameId . " AND  gp1.player_2 = " . $player2Id . " " );
		$rows = DBASE::mysqlUpdate($query);
		
		$winstatus ='awarded';
		//update game award status
		$sql = new MYSQL;
		$query = $sql->update(' game g ');
		//$query .= $sql->set(" g.win_status ='". $winstatus ."' ");
		$query .= $sql->set(" g.win_status ='". $winstatus ."', g.game_count ='". $gcount ."' ");
		$query .= $sql->where( 'g.id=' . $gameId);
		$rows = DBASE::mysqlUpdate($query);
		
		
		//update player 1
		$sql = new MYSQL;
		$query = $sql->update(' balance b ');
		$query .= $sql->set(" b.balance = balance+$rewa");
		$query .= $sql->where( " b.uid = " . $player1Id." " );
		$rows = DBASE::mysqlUpdate($query);
		//update player 2
		$sql = new MYSQL;
		$query = $sql->update(' balance b ');
		$query .= $sql->set(" b.balance = balance+$rewa");
		$query .= $sql->where( " b.uid = " . $player2Id." " );
		$rows = DBASE::mysqlUpdate($query);
		
		//update wallet balance
		$damount= ($rewa*2);
		$sql = new MYSQL;
		$query = $sql->update(' gaming_wallet ');
		$query .= $sql->set(" balance = balance-$damount ");
		$rows = DBASE::mysqlUpdate($query);
		
		//update game status
		$sql = new MYSQL;
		$query = $sql->update(' game g ');
		$query .= $sql->set(" g.player_1_result ='draw', g.player_2_result = 'draw'  ");
		$query .= $sql->where( 'g.id=' . $gameId);
		$rows = DBASE::mysqlUpdate($query); 
		
		echo '<script>self.location="index.php?acc=disputes"</script>';
		
	}
	
	public function showReplyByMessageId( $directmessageId ) {
		
		$sql = new MYSQL;
		$query = $sql->select(' * ');
		$query .= $sql->from(' direct_message_reply g ');
		$query .= $sql->where(" g.gdm_id='".$directmessageId."' ");
		$rows = DBASE::mysqlRowObjects($query);
		
		return $rows;
		
	}
	
	public function showDirectChallengesByStatus( $uid, $mystatus){
		
		 $sql = new MYSQL;
		$query = $sql->select(' * ');
		$query .= $sql->from(' game g ');
		$query .= $sql->where( " (g.player_1='".$uid."' or g.player_2='".$uid."') and g.game_type = '".$mystatus."'  " );
		$query .= $sql->order(' g.date_created desc LIMIT 10');
		$rows = DBASE::mysqlRowObjects($query);
		
		return $rows; 
	}
	
	public function showDirectChallengesByStatusPlayer2 ( $uid, $mystatus){
		
		
		$sql = new MYSQL;
		$query = $sql->select(' * ');
		$query .= $sql->from(' game g ');
		//$query .= $sql->where( " g.player_1 ='" . $uid ."' OR g.player_2='" . $uid . "' AND g.game_type = 'direct'  ");
		$query .= $sql->where("  g.player_2='" . $uid . "' and g.game_type = '" .$mystatus. "' ");
		$query .= $sql->order(' g.date_created desc LIMIT 10');
		$rows = DBASE::mysqlRowObjects($query);
		
		return $rows;
	}
	
	public function gameSummaryByWin( $uid, $mystatus){
		
		$sql = new MYSQL;
		$query = $sql->select(' * ');
		$query .= $sql->from(' gaming_player1 g  ');
		$query .= $sql->where(" g.player_1='" . $uid . "'  and g.win_status = '" .$mystatus. "' ");
		$query .= $sql->order(' g.date_created desc LIMIT 10');
		$rows = DBASE::mysqlRowObjects($query);
		
		return $rows;
		
		
	}
	
	public function gameSummaryByWin2( $uid, $mystatus){
		
		$sql = new MYSQL;
		$query = $sql->select(' * ');
		$query .= $sql->from(' gaming_player2 g  ');
		$query .= $sql->where(" g.player_2='" . $uid . "'  and g.win_status = '" .$mystatus. "' ");
		$query .= $sql->order(' g.date_created desc LIMIT 10');
		$rows = DBASE::mysqlRowObjects($query);
		
		return $rows;
		
		
	}
	
	public function gameSummaryByDraw( $uid, $mystatus){
		
		$sql = new MYSQL;
		$query = $sql->select(' * ');
		$query .= $sql->from(' gaming_player1 g ');
		$query .= $sql->where("  g.player_1='" . $uid . "' and g.win_status = '" .$mystatus. "' ");
		$query .= $sql->order(' g.date_created desc LIMIT 10');
		$rows = DBASE::mysqlRowObjects($query);
		
		return $rows;
		
		
	}
	//
	public function gameSummaryByLose( $uid, $mystatus){
		
        $sql = new MYSQL;
		$query = $sql->select(' * ');
		$query .= $sql->from(' gaming_player1 g ');
		$query .= $sql->where("  g.player_1='" . $uid . "' and g.win_status = '" .$mystatus. "' ");
		$query .= $sql->order(' g.date_created desc LIMIT 10');
		$rows = DBASE::mysqlRowObjects($query);
		
		return $rows;
		
		
	}
	public function  submitReplyToDirectMessage( $post ){
		
		/*$dmessage =  stripslashes($_POST['directMessageId']);
		$messag  = stripslashes($_POST['my_message']);
		$timeNow = date("Y-m-d H:i:s");
		$stat = 1;
		echo $dmessage, "", $messag, "Time",$timeNow;
		
		$sql = new MYSQL;
		$query = $sql->insert( ' direct_message_reply ' );
		$query .= $sql->columns('gdm_id ,  date_created, description' );
		$query .= $sql->values( " '".$dmessage."','".date("Y-m-d H:i:s")."', '".$messag."'  ");
		$rows = DBASE::mysqlInsert( $query);
		
		//update reply 
		$sql = new MYSQL;
		$query = $sql->update( ' gaming_direct_message ' );
		$query .= $sql->set("accept_status = accept_status+$stat ");
		$query .= $sql->where(' id=' . $dmessage);
		$rows = DBASE::mysqlUpdate( $query );
		
		echo '<script>self.location="index.php?acc=directmessage"</script>';
		
		*/
	}
	
	public function submitFavouritePlayers($currId, $joingameId){
	
		$sql = new MYSQL;
		$query = $sql->insert( ' gaming_favourites ' );
		$query .= $sql->columns('usr_id , invite_id, date_created, description' );
		$query .= $sql->values( " '".$currId."', ".$joingameId.",'".date("Y-m-d H:i:s")."', 'favourite'  "  );
		$rows = DBASE::mysqlInsert( $query);
		
	}
	
	public function acceptDirectChallenge( $directGameId, $stakeAmount, $player2ID){
		//gaming_direct_challenge
		echo 'Game Id ',$directGameId;
		echo "<br/>";
		echo "my stake ",$stakeAmount;
		echo  "<br/>";
		
		echo "Player 2",$player2ID;
		 $sql = new MYSQL;
		$query = $sql->update( ' game ' );
		$query .= $sql->set(" player2_stake = '".$stakeAmount."', game_status='1' ");
		$query .= $sql->where(' id=' . $directGameId);
		$rows = DBASE::mysqlUpdate( $query );  
		
		//deduct my balance
		$rows = DBASE::mysqlUpdate( $query );
		$last_id =$rows;
		$sql = new MYSQL;
		$query = $sql->update( ' balance ' );
		$query .= $sql->set("balance = balance-$stakeAmount ");
		$query .= $sql->where('uid=' . $player2ID);
		$rows = DBASE::mysqlUpdate( $query );
		
		//insert player 2 ID
		
		$sql = new MYSQL;
		$query = $sql->insert(' gaming_player2 ');
		$query .= $sql->columns('gameId, player_2, player_stake, player_result, date_created, win_status' );
		$query .= $sql->values( " '".$directGameId."', '".$player2ID."','$stakeAmount', 'NULL', '".date("Y-m-d H:i:s")."', 'pending'");
		$rows = DBASE::mysqlUpdate($query);
		//echo '<div>Joined to new game successful.</div>';
		
		// gaming wallet balance
		$sql = new MYSQL;
		$query = $sql->update(' gaming_wallet ');
		$query .= $sql->set(" balance = balance+$stakeAmount");
		//$query .= $sql->where(" uid = " . $userId);
		$rows = DBASE::mysqlUpdate($query);
		//send mail
		
		$to = $email;
		$cc = SYSTEM_EMAIL;
		$bcc = "kellyomwaka@gmail.com";
		$from = SYSTEM_EMAIL;
		$subject = SITE_NAME_SHORT .' - Dispute  Submission';
		
		$body = '
				<p>Dear <strong>'.$playername.'</strong></p>
                <p>You have joined the match created by '.$opponentName.'.  </p>
                <p>Kindly send them a friend request using their gamer tag  '.$gameTag.'.</p>
                		
				<p>Regards,<br>'.SITE_NAME_SHORT.'</p>
						
				';
		
		$sent = baseModel::sendmail( $from, $to, $cc, $bcc, $subject, $body ) ;
		
		//update alert
		$sql = new MYSQL;
		$query = $sql->insert( ' gaming_alerts ' );
		$query .= $sql->columns('usr_id, date_created, description, alert_type, read_status' );
		$query .= $sql->values( " '".$player2ID."', '".date("Y-m-d H:i:s")."', '".$mnt."', 'Direct Game Joining',  '0'  "  );
		
		echo '<script>self.location="index.php?acc=gamesactive"</script>';
		
	}
	
	public function acceptDirectMessage( $messageId ){	
	/*	$sql = new MYSQL;
		$query = $sql->update( ' gaming_direct_message ' );
		$query .= $sql->set(" accept_status = '1' ");
		$query .= $sql->where(' id=' . $messageId);
		$rows = DBASE::mysqlUpdate( $query );
		echo '<script>self.location="index.php?acc=directmessage"</script>';*/
	}
	
	public function submitReadNotification( $notificationId ) {
		
		$sql = new MYSQL;
		$query = $sql->update( ' gaming_alerts ' );
		$query .= $sql->set(" read_status = '1' ");
		$query .= $sql->where(' id=' . $notificationId);
		$rows = DBASE::mysqlUpdate( $query );
		
		echo '<script>self.location="index.php?pg=notifications"</script>';

	}
	
	public function automaticRefundToPlayer($playerId ,$gameId, $amountStaked){
		
		echo "player ",$playerId," game id ",$gameId," stake",$amountStaked;
		
	    $email =  stripslashes($_POST['player_email']);
		$fname =  stripslashes($_POST['player_name']);
		
		$refund = "refunded";
		$status="1";
		$gcount='1';
		$cancel = "cancelled";
		$mnt = " has cancelled game with Id";
		//echo "Game Id :", $gameId. "Player Id :",$playerId. " My Reason :", $myreason;
		
		$sql = new MYSQL;
		$query = $sql->insert( ' game_cancellation ' );
		$query .= $sql->columns('gameId, playerId, myreason, amountRefunded, date_created, refund_status' );
		$query .= $sql->values( " '".$gameId."', ".$playerId.", 'System Automatic refund', '".$amountStaked."', '".date("Y-m-d H:i:s")."', '".$refund."'  "  );
		$rows = DBASE::mysqlInsert( $query);
		//update balance
		$query = $sql->update( ' balance ' );
		$query .= $sql->set("balance = balance+$amountStaked ");
		$query .= $sql->where('uid=' . $playerId);
		$rows = DBASE::mysqlUpdate( $query );
		
		//update wallet.
		
		$sql = new MYSQL;
		$query = $sql->update(' gaming_wallet ');
		$query .= $sql->set(" balance = balance-$amountStaked ");
		$rows = DBASE::mysqlUpdate($query);
		

		//update player 1
		
		$query = $sql->update( ' gaming_player1 ply1 ' );
		$query .= $sql->set("win_status = '$cancel' ");
		$query .= $sql->where('ply1.gameId=' . $gameId);
		$rows = DBASE::mysqlUpdate( $query );
		
		//update game to cancelled
		$query = $sql->update( ' game gm ' );
		$query .= $sql->set("gm.game_status ='1', gm.win_status='awarded', gm.cancellation_status='cancelled', gm.game_count ='". $gcount ."' ");
		$query .= $sql->where('gm.id=' . $gameId);
		$rows = DBASE::mysqlUpdate( $query );
		
			
		
		echo '<script>self.location="index.php?acc=gamesactive"</script>'; 
		
		
	}
	
	public function automaticShareBetweenPlayers($player1Id, $player2Id, $gameId, $prize){
		$sta ="draw";
		$rewa = ($prize/2);
				
		$sql = new MYSQL;
		$query = $sql->update(' gaming_player1 gp1 ');
		$query .= $sql->set(" gp1.win_status ='". $sta ."' ");
		$query .= $sql->where( " gp1.gameId = " . $gameId . " AND  gp1.player_1 = " . $player1Id . " " );
		$rows = DBASE::mysqlUpdate($query);
		
		//update winner
		$sql = new MYSQL;
		$query = $sql->update(' gaming_player2 gp1');
		$query .= $sql->set(" gp1.win_status ='". $sta ."' ");
		$query .= $sql->where( " gp1.gameId = " . $gameId . " AND  gp1.player_2 = " . $player2Id . " " );
		$rows = DBASE::mysqlUpdate($query);
		
		$winstatus ='awarded';
		$gcount='1';
		//update game award status
		$sql = new MYSQL;
		$query = $sql->update(' game g ');
		//$query .= $sql->set(" g.win_status ='". $winstatus ."' ");
		$query .= $sql->set(" g.win_status ='". $winstatus ."', g.game_count ='". $gcount ."' ");
		$query .= $sql->where( 'g.id=' . $gameId);
		$rows = DBASE::mysqlUpdate($query);
		
		$sql = new MYSQL;
		$query = $sql->update(' balance b ');
		$query .= $sql->set(" b.balance = balance+$rewa");
		$query .= $sql->where( " b.uid = " . $player1Id."  	OR  b.uid = " . $player2Id." " );
		$rows = DBASE::mysqlUpdate($query);
		
		//update wallet balance
		$damount= ($rewa*2);
		$sql = new MYSQL;
		$query = $sql->update(' gaming_wallet ');
		$query .= $sql->set(" balance = balance-$damount ");
		$rows = DBASE::mysqlUpdate($query);
		
		//
		$sql = new MYSQL;
		$query = $sql->update(' gaming_player1 ');
		$query .= $sql->set(" win_status ='". $sta ."' ");
		$query .= $sql->where( " player_1 ='" . $playerId ."' and gameId = '".$gameId."' ");
		$rows = DBASE::mysqlUpdate($query);
		
		//update game status
		
		$sql = new MYSQL;
		$query = $sql->update(' game g ');
		$query .= $sql->set(" g.player_1_result ='draw', g.player_2_result = 'draw'  ");
		$query .= $sql->where( 'g.id=' . $gameId);
		$rows = DBASE::mysqlUpdate($query);
		
		echo '<script>self.location="index.php?acc=games&page=games-mine"</script>';
		
		
	}
	
	public function automaticPayOutPlayer1($player1Id, $player2, $myGameId, $prizeId) {
		
		//echo "Player 1",$player1Id,"Game Id ","",$player2,"",$myGameId,"Prize ",$prizeId;
			
		$alias2 = $post['alias2'];
		$fname1 = $post['fname1'];
		$email =  stripslashes($_POST['player_email']);
		$mnt =$email." has been awarded by admin as winner";
		//$prizeId =  $post['prizeId'];
		$sta ="Won";
		$sta1 ="Lose";
		$winstatus ='awarded';
		$gcount='1';
		//update game award status
		$sql = new MYSQL;
		$query = $sql->update(' game g ');
		$query .= $sql->set(" g.win_status ='". $winstatus ."', g.game_count ='". $gcount ."' ");
		$query .= $sql->where( 'g.id=' . $myGameId);
		$rows = DBASE::mysqlUpdate($query);
		
		$sql = new MYSQL;
		$query = $sql->update(' gaming_player1 gp1 ');
		$query .= $sql->set(" gp1.win_status ='". $sta ."' ");
		$query .= $sql->where( " gp1.gameId = " . $myGameId . " AND  gp1.player_1 = " . $player1Id . " " );
		$rows = DBASE::mysqlUpdate($query); 
		
		//update winner
		$sql = new MYSQL;
		$query = $sql->update(' gaming_player2 gp1');
		$query .= $sql->set(" gp1.win_status ='". $sta1 ."' ");
		$query .= $sql->where( " gp1.gameId = " . $myGameId . " AND  gp1.player_2 = " . $player2 . " " );
		$rows = DBASE::mysqlUpdate($query);
		
		$sql = new MYSQL;
		$query = $sql->update(' gaming_wallet ');
		$query .= $sql->set(" balance = balance-$prizeId");
		$rows = DBASE::mysqlUpdate($query);
		
		$sql = new MYSQL;
		$query = $sql->update('gaming_player1 gb,  balance b ');
		$query .= $sql->set(" b.balance = balance+$prizeId");
		$query .= $sql->where( ' b.uid = gb.player_1 and gb.gameId=' . $myGameId);
		$rows = DBASE::mysqlUpdate($query);
		
		//sent email
		
		$to = $email;
		$cc = SYSTEM_EMAIL;
		$bcc = "kellyomwaka@gmail.com";
		$from = SYSTEM_EMAIL;
		$subject = SITE_NAME_SHORT .' - Gaming Kitchen WON Game';
		
		$body = '
				<p>Dear '.$fname1.'</p>
				<p>Congratulations, you have WON the game '.$myGameId.' vs. '.$alias2.' and received Ksh '.$prizeId.'</p>
				<p>Regards,<br>'.SITE_NAME_SHORT.'</p>
						
				';
		
		$sent = baseModel::sendmail( $from, $to, $cc, $bcc, $subject, $body ) ;
		
	
		
	}
	
	public function automaticPayOutPlayer2($player2Id, $player1Id,  $myGameId, $prizeId){
		//error_reporting(E_ALL);
		//ini_set('display_errors', 1);
		//echo "player 2 ",$player2Id,"player 1 ",$player1Id,"game Id ",$myGameId, "Ksh. ",$prizeId; 
		
		$email =  stripslashes($_POST['player_email']);
		$alias1 = $post['alias1'];
		$fname2 = $post['fname2'];
		$sta ="Won";
		$sta1 ="Lose";
		$gcount='1';
		$mnt=$email."who is winner has been awarded as a winner.";
		
		$winstatus ='awarded';
		//update game award status
		$sql = new MYSQL;
		$query = $sql->update(' game g ');
		//$query .= $sql->set(" g.win_status ='". $winstatus ."' ");
		$query .= $sql->set(" g.win_status ='". $winstatus ."', g.game_count ='". $gcount ."' ");
		$query .= $sql->where( 'g.id=' . $myGameId);
		$rows = DBASE::mysqlUpdate($query);
		
		
		$sql = new MYSQL;
		$query = $sql->update(' gaming_player1 gp1 ');
		$query .= $sql->set(" gp1.win_status ='". $sta1 ."' ");
		$query .= $sql->where( " gp1.gameId = " . $myGameId . " AND  gp1.player_1 = " . $player1Id . " " );
		$rows = DBASE::mysqlUpdate($query);
		
		//update winner
		$sql = new MYSQL;
		$query = $sql->update(' gaming_player2 gp1');
		$query .= $sql->set(" gp1.win_status ='". $sta ."' ");
		$query .= $sql->where( " gp1.gameId = " . $myGameId . " AND  gp1.player_2 = " . $player2Id . " " );
		$rows = DBASE::mysqlUpdate($query);
		
		$sql = new MYSQL;
		$query = $sql->update(' gaming_wallet ');
		$query .= $sql->set(" balance = balance-$prizeId");
		$rows = DBASE::mysqlUpdate($query);
		
		$sql = new MYSQL;
		$query = $sql->update('gaming_player2 gb,  balance b ');
		$query .= $sql->set(" b.balance = balance+$prizeId");
		$query .= $sql->where( ' b.uid = gb.player_2 and gb.gameId=' . $myGameId);
		$rows = DBASE::mysqlUpdate($query);
		
		//sent email
		
		$to = $email;
		$cc = SYSTEM_EMAIL;
		$bcc = "kellyomwaka@gmail.com";
		$from = SYSTEM_EMAIL;
		$subject = SITE_NAME_SHORT .' - Gaming Kitchen WON Game';
		
		$body = '
				<p>Dear '.$fname2.'</p>
				<p>Congratulations, you have WON the game '.$myGameId.' vs. '.$alias1.' and received Ksh '.$prizeId.'</p>
				<p>Regards,<br>'.SITE_NAME_SHORT.'</p>
						
				';
		
		$sent = baseModel::sendmail( $from, $to, $cc, $bcc, $subject, $body ) ;
		
		
		
	}
	
	public function submitToFavouriteList( $post ){
		
		$userId = $post['userId'];
		$opponentId = $post['player2Id'];
		$my_message ="Add to favourite";
		
		$sql = new MYSQL;
		$query = $sql->insert(' gaming_favourites ');
		$query .= $sql->columns(' usr_id, invite_id, date_created, description' );
		$query .= $sql->values( " '".$userId."', '".$opponentId."', '".date("Y-m-d H:i:s")."', '".$my_message."'");
		$rows = DBASE::mysqlUpdate($query);
		
		//send email alert
		
		$sql = new MYSQL;
		$query = $sql->insert(' gaming_alerts ');
		$query .= $sql->columns(' usr_id, date_created, description, alert_type, read_status  ' );
		$query .= $sql->values( " '".$userId."', '".date("Y-m-d H:i:s")."', '".$my_message."', 'Add to Favourite', '0'");
		$rows = DBASE::mysqlUpdate($query);
	}
	
	public function submitDirectChallenge( $post ) {
		$current_date = date("Y-m-d H:i:s");
		$userId = $post['userId'];
		$opponentId = $post['player2Id'];
		$gameCategoryId = $post['gameCategoryId'];
		$gameConsoleId = $post['gameConsoleId'];
		$stake = $post['stake'];
		$starlevel = $post['starlevel'];
		$gamerules = $post['gamerules'];
		$date = date('Y-m-d H:i:s');
		$stake2='0';
		$email = $post['myemail'];
		$fname = $post['fname'];
		//calculate game end time
		$date1 = date('Y-m-d H:i:s');
		$datez = strtotime($date1);
		$datey = strtotime("+10 minute", $datez);
		$final =  date('d-m-Y H:i:s', $datey);
		
		$sql = new MYSQL;
		$query = $sql->insert( 'game' );
		$query .= $sql->columns('gamecategory_id, player_1, player_2, player1_stake,  player_1_result, player2_stake,  player_2_result, date_created, game_type,  date_invite_accepted, tournament_end_date, game_status' );
		$query .= $sql->values( " '".$gameCategoryId."', '".$userId."','".$opponentId."' ,'".$stake."','NULL','0','NULL','$current_date','direct', '$current_date','$final','0'");
		
		$rows = DBASE::mysqlInsert( $query);
		$alertt = strtotime("+5 minute", $datez);
		$alertime =  date('d-m-Y H:i:s', $alertt);
		$last_id = $rows;
		//echo "New record created successfully. Last inserted ID is: " . $last_id;
		//update gaming notification table
		$sql = new MYSQL;
		$query = $sql->insert(' gaming_notifications ');
		$query .= $sql->columns('game_id, alert_time, end_time' );
		$query .= $sql->values( " '".$last_id."', '".$alertime."', '".$final."' ");
		$rows = DBASE::mysqlUpdate($query);
		
		// update player balance
		$sql = new MYSQL;
		$query = $sql->update(' balance ');
		$query .= $sql->set(" balance = balance-$stake");
		$query .= $sql->where(" uid = " . $userId);
		$rows = DBASE::mysqlUpdate($query);
		//admin balance
		$sql = new MYSQL;
		$query = $sql->insert(' gaming_balance ');
		$query .= $sql->columns('usr_id, amount_deposited, date_created, balance_status' );
		$query .= $sql->values( " '".$userId."', '".$stake."', '".date("Y-m-d H:i:s")."', 'account debited'");
		$rows = DBASE::mysqlUpdate($query);
		
		// gaming wallet balance
		$sql = new MYSQL;
		$query = $sql->update(' gaming_wallet ');
		$query .= $sql->set(" balance = balance+$stake");
		//$query .= $sql->where(" uid = " . $userId);
		$rows = DBASE::mysqlUpdate($query);
		
		//insert game details to db
		
		$sql = new MYSQL;
		$query = $sql->insert(' gaming_details ');
		$query .= $sql->columns('gameId, gmlevel, gmperiod, gmconsole, date_created,  gm_status' );
		$query .= $sql->values( " '".$last_id."', '".$starlevel."', '".$gamerules."', '".$gameConsoleId."', '".date("Y-m-d H:i:s")."', 'pending'");
		$rows = DBASE::mysqlUpdate($query);
		
		//insert into player 2
		
		$sql = new MYSQL;
		$query = $sql->insert(' gaming_player1 ');
		$query .= $sql->columns('gameId, player_1, player_stake, player_result, date_created, win_status' );
		$query .= $sql->values( " '".$last_id."', '".$userId."', '".$stake."','NULL', '".date("Y-m-d H:i:s")."', 'pending'");
		$rows = DBASE::mysqlUpdate($query);
		
		//update alert table
		$usere = $fname." has created new game with a stake of  Ksh : ".$stake;
		$alertt ="Direct Challenge";
		$sql = new MYSQL;
		$query = $sql->insert(' gaming_alerts ');
		$query .= $sql->columns(' usr_id, date_created, description, alert_type, read_status  ' );
		$query .= $sql->values( " '".$userId."', '".date("Y-m-d H:i:s")."', '".$usere."', 'Direct Challenge', '0'");
		$rows = DBASE::mysqlUpdate($query);
		
		//send email alert
		
		$to = $email;
		$cc = SYSTEM_EMAIL;
		$bcc = "kellyomwaka@gmail.com";
		$from = SYSTEM_EMAIL;
		$subject = SITE_NAME_SHORT .' - CUSTOM GAME';
		
		$body = '
				<p>Dear <strong>'.$fname.'</strong></p>
				<p>Thank you for creating a match with The Gaming Kitchen, please wait as we find you a suitable opponent.</p>
				<p>Regards,<br>'.SITE_NAME_SHORT.'</p>
						
				';
		
		$sent = baseModel::sendmail( $from, $to, $cc, $bcc, $subject, $body ) ;
		
		
		//submit game
		echo '<script>self.location="' . $url . 'index.php?acc=games&page=games-all"</script>';	
		
	}
	
	public function submitDirectMessageNow ( $post ) {
		
	/*	$current_date = date("Y-m-d H:i:s");
		$userId = $post['userId'];
		$inviteId = $post['inviteId'];
		$my_message = $post['my_message'];
		$email = $post['myemail'];
		$fname = $post['fname'];
		$usere =" has submitted direct message";
		$sql = new MYSQL;
		$query = $sql->insert(' gaming_direct_message ');
		$query .= $sql->columns(' usr_id, invite_id, date_created, description' );
		$query .= $sql->values( " '".$userId."', '".$inviteId."', '".date("Y-m-d H:i:s")."', '".$my_message."'");
		$rows = DBASE::mysqlUpdate($query);*/
		
		//send email alert
		
		$sql = new MYSQL;
		$query = $sql->insert(' gaming_alerts ');
		$query .= $sql->columns(' usr_id, date_created, description, alert_type, read_status  ' );
		$query .= $sql->values( " '".$userId."', '".date("Y-m-d H:i:s")."', '".$usere."', 'Direct Message', '0'");
		$rows = DBASE::mysqlUpdate($query);
		
		$to = $email;
		$cc = SYSTEM_EMAIL;
		$bcc = "kellyomwaka@gmail.com";
		$from = SYSTEM_EMAIL;
		$subject = SITE_NAME_SHORT .' - DIRECT MESSAGE';
		
		$body = '
				<p>Dear <strong>'.$fname.'</strong></p>
				<p>Thank you for Sending direct message, once received will be notified</p>
				<p>Regards,<br>'.SITE_NAME_SHORT.'</p>
						
				';
		
		$sent = baseModel::sendmail( $from, $to, $cc, $bcc, $subject, $body ) ;
		
		
	}
	public function submitChallengePlayer ( $post ){
		$gplayerId = stripslashes($_POST['gplayerId']);
		echo "tried this 40 ::",  $gplayerId;
		
		echo '<script>self.location="index.php?acc=cancel_mygame"</script>';
		echo 'challenge';
		
		return 'cance_mygame';
	}
	public function submitMyFavourite( $post ) {
		
		
	}
	public function submitDirectMessage ( $post ) {
	/*	$userId = stripslashes($_POST['userId']);
		$email = stripslashes($_POST['player_email']);
		$gplayerId = stripslashes($_POST['gplayerId']);
		$currtime = date("Y-m-d H:i:s");
		$check ="Hello, <br/> Please check my profile to see more games.";
		echo "User ID ",$userId;
		echo "Guest Id ",$gplayerId;
		
		
		$sql = new MYSQL;
		$query = $sql->insert( ' gaming_direct_message ' );
		$query .= $sql->columns('usr_id, invite_id, date_created, description' );
		$query .= $sql->values( " '".$userId."', '".$gplayerId."', '".$currtime."', '".$check."'"  );
		
		$rows = DBASE::mysqlInsert( $query);
		//sent
		
		$to = $email;
		$cc = SYSTEM_EMAIL;
		$bcc = "kellyomwaka@gmail.com";
		$from = SYSTEM_EMAIL;
		$subject = SITE_NAME_SHORT .' - DIRECT MESSAGE';
		
		$body = '
				<p>Dear Admin</p>
				<p><strong>'.$playemail.' account has been credited by admin with '.$amount.' at  '.$gettime.'.</strong></p>
				<p> Thanks IN Advance.:</p>
						
				<p>Regards,<br>'.SITE_NAME_SHORT.'</p>
						
				';
		
		$sent = baseModel::sendmail( $from, $to, $cc, $bcc, $subject, $body ) ;*/
	}
	public function autoUpdateGamingAlerts(){
	     //to be updated
	}
	
	public function searchPlayerByAlias( $alias ){
	
		$sql = new MYSQL;
		$query = $sql->select( ' * ' );
		$query .= $sql->from( 'user_details' );
		$query .= $sql->where( " `alias` LIKE '%".$alias."%' " );
		
		
		$rows = DBASE::mysqlRowObjects( $query );
		
		if(count($rows) < 1 )
			return '<font color="#ff4563">No name set</font>';
			else
			{
				$row = &$rows[0];
				 $row->lname;
				 $userId = $row->user_id;
				 //echo "[[[[[[[[[[[[[[[[[[[[[[[["+$userId+"vvvvvvvvvvvvvvvvvvvvv";
				 $opponent_status = $row->game_status;
				
				   $goNow ='<a href="index.php?acc=direct&searchplayerId='.$userId.'">
				 
                      <input type="submit" name="challengePlayer" class="btn btn-success" value="Challenge Player" /></a>';
				 
				
				 $getstatus='0';
				 $gamesList = playModel::countActiveGames($userId, $getstatus);
				 
				 $gettotal = count($gamesList);
				 
				 //echo $gettotal;
				 
				 if($gettotal==0){
				 $challenge = $goNow;
				 }else{
				 	$challenge = $goNow;
				 }
				 
				 $myresults = '
                        
                  <div class="col-md-10" style="display:block;">
                         
                       <div class="col-md-3">
                       <input type="label" name="CourseID" class="form-control"  value="'.$row->fname.'" readonly> 
                       </div>
                       <div class="col-md-3">
                       <input type="label" name="CourseID" class="form-control" value="'.$row->lname.'" readonly> 
                       </div>
                      
                      ' .$challenge.'
				      
  
  <a href="index.php?acc=favourite&searchplayerId='.$userId.'">
  <input type="submit" name="myFavourite" class="btn btn-success" value="My Favourite" />
   </a>
                      

                          </div>
                        ';
				 
				 return $myresults;
				
			}
			
			
			
			//echo '<script>self.location="index.php?acc=available_games"</script>';
			

	}
	
	
	//manual top up
	
	public function submitManualAmount( $post ){
		$playerId = stripslashes($_POST['playerId']);
		$amount = stripslashes($_POST['amount']);
		$amnt =  $amount." Ksh has been deposited on your account";
		$email = "kellyomwaka@gmail.com";
		$playemail = stripslashes($_POST['player_email']);
		$gettime = date("Y-m-d H:i:s");
		//echo "Email working ::: ", $email;
		$sql = new MYSQL;
		$query = $sql->update(' balance b ');
		$query .= $sql->set(" b.balance = balance+$amount");
		$query .= $sql->where( ' b.uid=' . $playerId);
		$rows = DBASE::mysqlUpdate($query);
		
		$to = $email;
		$cc = SYSTEM_EMAIL;
		$bcc = "kellyomwaka@gmail.com";
		$from = SYSTEM_EMAIL;
		$subject = SITE_NAME_SHORT .' - Manual Top Up';
		
		$body = '
				<p>Dear Admin</p>
				<p><strong>'.$playemail.' account has been credited by admin with '.$amount.' at  '.$gettime.'.</strong></p>
				<p> Thanks IN Advance.:</p>
						
				<p>Regards,<br>'.SITE_NAME_SHORT.'</p>
						
				';
		
		$sent = baseModel::sendmail( $from, $to, $cc, $bcc, $subject, $body ) ;
		
		//update notification
		
		/* $sql = new MYSQL;
		$query = $sql->update(' gaming_alerts ');
		$query .= $sql->set(" usr_id ='". $userId ."',  description ='Maximillah mueni'  ");
		//$query .= $sql->where(" date_created >= NOW() + INTERVAL 2 minute");
		$query .= $sql->where(" DATE_ADD(date_created, INTERVAL 2 MINUTE) "); */
		$sql = new MYSQL;
		$query = $sql->insert( ' gaming_alerts ' );
		$query .= $sql->columns('usr_id, date_created, description , read_status' );
		$query .= $sql->values( " '".$playerId."', '".date("Y-m-d H:i:s")."', '".$amnt."', '0'  "  );
		
		$rows = DBASE::mysqlUpdate($query);
		
		echo '<script>self.location="index.php?acc=manualtopup"</script>';
		
		//echo '<script>self.location="index.php?acc=userslist"</script>';
		
	}
	
	public function playerDetailsByUserId( $names ){
		
		echo $names;
	}
	

    public function listAllGames() {

        $sql = new MYSQL;
        $query = $sql->select('*');
        $query .= $sql->from(' game ');
        $query .= $sql->where(" date_created >= date_sub(now(),interval 10 minute) AND player_1 != " . MYID . " ");
        $query .= $sql->order(' date_created desc');

        $rows = DBASE::mysqlRowObjects($query);
        //SELECT name, species, birth FROM pet  WHERE species = 'dog' OR species = 'cat'
        return $rows;
    }
    public function submitMyDispute2Gamer ( $post ) {
    	//error_reporting(E_ALL);
    	//ini_set('display_errors', 1);
    	$gameId = stripslashes($_POST['gameId']);
    	$playerId = stripslashes($_POST['playerId']);
    	$email =  stripslashes($_POST['player_email']);
    	$mnt = $email."  has submitted dispute.";
    	$status ="dispute";
    	$profileImageName = time() . '-' . $_FILES["gameImage"]["name"];
    	// For image upload
    	$target_dir = "mydispute_2/";
    	$target_file = $target_dir . basename($profileImageName);
    	
    	// VALIDATION
    	// validate image size. Size is calculated in Bytes
    	if($_FILES['gameImage']['size'] > 200000) {
    		$msg = "Image size should not be greated than 200Kb";
    		$msg_class = "alert-danger";
    	}
    	// check if file exists
    	if(file_exists($target_file)) {
    		$msg = "File already exists";
    		$msg_class = "alert-danger";
    	}
    	// Upload image only if no errors
    	if (empty($error)) {
    		if(move_uploaded_file($_FILES["gameImage"]["tmp_name"], $target_file)) {
    		
    			$sql = new MYSQL;
    			$query = $sql->insert( ' game_player2_dispute ' );
    			$query .= $sql->columns('gameId, playerId, disputeImage, dispute_status' );
    			$query .= $sql->values( " '".$gameId."', '".$playerId."', '".$profileImageName."', '".$status."'"  );
    			
    			$rows = DBASE::mysqlInsert( $query);
    			
    		}
    		
    		echo '<div class="col-md-12 isa_error text-center">dispute  uploaded successfully.</div>';
    	}
    	
    	
    	$to = $email;
    	$cc = SYSTEM_EMAIL;
    	$bcc = "kellyomwaka@gmail.com";
    	$from = SYSTEM_EMAIL;
    	$subject = SITE_NAME_SHORT .' - Dispute  Submission';
    	
    	$body = '
				<p>Dear Gaming Kitchen</p>
				<p>Player 2 with '.$playerId.' has submitted a dispute.</p>
				<p>Please check your admin to review the dispute</p>
				<p>Regards,<br>'.SITE_NAME_SHORT.'</p>
						
				';
    	
    	$sent = baseModel::sendmail( $from, $to, $cc, $bcc, $subject, $body ) ;
    	
    	
    //update alert
    	$sql = new MYSQL;
    	$query = $sql->insert( ' gaming_alerts ' );
    	$query .= $sql->columns('usr_id, date_created, description, alert_type, read_status' );
    	$query .= $sql->values( " '".$playerId."', '".date("Y-m-d H:i:s")."', '".$mnt."', 'dispute uploaded', '0'  "  );
    	$rows = DBASE::mysqlUpdate($query); 
    	
    	
    }
    public function submitMyDisputeGamer( $post ) {
    	
    	$gameId = stripslashes($_POST['gameId']);
    	$playerId = stripslashes($_POST['playerId']);
    	$email =  stripslashes($_POST['player_email']);
    	$mnt = $email."  has submitted dispute.";
    	$status ="dispute";
    	$profileImageName = time() . '-' . $_FILES["gameImage"]["name"];
    	// For image upload
    	$target_dir = "mydispute_1/";
    	$target_file = $target_dir . basename($profileImageName);
    	// VALIDATION
    	// validate image size. Size is calculated in Bytes
    	if($_FILES['gameImage']['size'] > 200000) {
    		$msg = "Image size should not be greated than 200Kb";
    		$msg_class = "alert-danger";
    	}
    	// check if file exists
    	if(file_exists($target_file)) {
    		$msg = "File already exists";
    		$msg_class = "alert-danger";
    	}
    	// Upload image only if no errors
    	if (empty($error)) {
    		if(move_uploaded_file($_FILES["gameImage"]["tmp_name"], $target_file)) {
    		    $sql = new MYSQL;
    			$query = $sql->insert( ' game_player1_dispute ' );
    			$query .= $sql->columns('gameId, playerId, disputeImage, dispute_status' );
    			$query .= $sql->values( " '".$gameId."', '".$playerId."', '".$profileImageName."', '".$status."'"  );
    			
    			$rows = DBASE::mysqlInsert( $query); 
    		}
    		
    		echo '<div class="col-md-12 isa_error text-center">dispute  uploaded successfully.</div>';
    	}
    	
    	  	
    	$to = $email;
    	$cc = SYSTEM_EMAIL;
    	$bcc = "kellyomwaka@gmail.com";
    	$from = SYSTEM_EMAIL;
    	$subject = SITE_NAME_SHORT .' - Dispute  Submission';
    	
    	$body = '
				<p>Dear Gaming Kitchen</p>
				<p>Player 2 with '.$playerId.' has submitted a dispute.</p>
				<p>Please check your admin to review the dispute</p>
				<p>Regards,<br>'.SITE_NAME_SHORT.'</p>
						
				';
    	
    	$sent = baseModel::sendmail( $from, $to, $cc, $bcc, $subject, $body ) ;
    	
    	//update alert
    	$sql = new MYSQL;
    	$query = $sql->insert( ' gaming_alerts ' );
    	$query .= $sql->columns('usr_id, date_created, description, alert_type, read_status' );
    	$query .= $sql->values( " '".$playerId."', '".date("Y-m-d H:i:s")."', '".$mnt."', 'dispute uploaded', '0'  "  );
    	$rows = DBASE::mysqlUpdate($query); 
    	
    }
    public function submitPermanentGamer( $post ){
    
    	$playerId = $post['playerId'];
    	$myreason = $post['myreason'];
    	$email =  stripslashes($_POST['player_email']);
    	$activee = "1";
    	$susType = "Permanent";
    	$mnt = $email." has been permanently diactivated";
    	    	
    	$sql = new MYSQL;
    	$query = $sql->insert(' suspend_user ');
    	$query .= $sql->columns('userId, suspensionType, reason ' );
    	$query .= $sql->values( " '".$playerId."', '".$susType."', '".$myreason."'");
    	$rows = DBASE::mysqlUpdate($query);
    	
    	$sql = new MYSQL;
    	$query = $sql->update( ' users ' );
    	$query .= $sql->set("active = '0', suspend_Status='1' ");
    	$query .= $sql->where('id=' . $playerId);
    	$rows = DBASE::mysqlUpdate( $query ); 
    	
    	
    	
    	//update alert
    	$sql = new MYSQL;
    	$query = $sql->insert( ' gaming_alerts ' );
    	$query .= $sql->columns('usr_id, date_created, description, read_status' );
    	$query .= $sql->values( " '".$playerId."', '".date("Y-m-d H:i:s")."', '".$mnt."', read_status='1'  "  );
    	
    	$rows = DBASE::mysqlUpdate($query);
    	
    	echo '<script>self.location="index.php?acc=userslist"</script>';
    }
    public function submitTemporaryGamer( $post ){
    	
    	$playerId = $post['playerId'];
    	$myreason = $post['myreason'];
    	$email =  stripslashes($_POST['player_email']);
    	$activee = "1";
    	$susType = "Temporary";
    	$mnt = $email." has been temporarily deactivated.";
    	///echo "Temporary :", $playerId, " Reason :", $myreason;
    	
    	//userId
    	
    	$sql = new MYSQL;
    	$query = $sql->insert(' suspend_user ');
    	$query .= $sql->columns('userId, suspensionType, reason ' );
    	$query .= $sql->values( " '".$playerId."', '".$susType."', '".$myreason."'");
    	$rows = DBASE::mysqlUpdate($query);
    	
    	$sql = new MYSQL;
    	$query = $sql->update( ' users ' );
    	$query .= $sql->set("suspend_Status = 1 ");
    	$query .= $sql->where('id=' . $playerId);
    	$rows = DBASE::mysqlUpdate( $query ); 
    	
    	
    	$to = $email;
    	$cc = SYSTEM_EMAIL;
    	$bcc = "kellyomwaka@gmail.com";
    	$from = SYSTEM_EMAIL;
    	$subject = SITE_NAME_SHORT .' - Dispute  Submission';
    	
    	$body = '
				<p>Dear Gaming Kitchen</p>
				<p>Player 2 with '.$playerId.' has been Temporarely diactivated due to violation of our policies.</p>
						
				<p>Regards,<br>'.SITE_NAME_SHORT.'</p>
						
				';
    	
    	$sent = baseModel::sendmail( $from, $to, $cc, $bcc, $subject, $body ) ;
    	
    	//update alert
    	$sql = new MYSQL;
    	$query = $sql->insert( ' gaming_alerts ' );
    	$query .= $sql->columns('usr_id, date_created, description' );
    	$query .= $sql->values( " '".$playerId."', '".date("Y-m-d H:i:s")."', '".$mnt."'  "  );
    	
    	echo '<script>self.location="index.php?acc=userslist"</script>';
    	
    	
    }
   public  function joinMyGame($post ){
    	$gameId = $post['gameId'];
    	$playerId = $post['playerId'];
    	$creatorId = $post['creatorId'];
    	$mystakeId = $post['mystakeId'];
    	$playername = $post['playername'];
    	$opponentName = $post['opponentName'];
    	$gameTag = $post['gameTag'];
    	$email =  stripslashes($_POST['player_email']);
    	$mnt = $email." has joined game with Id ".$gameId;
    	//update alert
    	$usere = $playername." have joined game created by  ". $opponentName;
    	$date = date("Y-m-d H:i:s");
    	$status='1';
    	$my_message="Accepted Direct Message";
    	//update direct message table
    	$usere =" has submitted direct message";
    	/* $sql = new MYSQL;
    	$query = $sql->insert(' gaming_direct_message ');
    	$query .= $sql->columns(' usr_id, invite_id, date_created, description' );
    	$query .= $sql->values( " '".$creatorId."', '".$playerId."', '".date("Y-m-d H:i:s")."', '".$my_message."'");
    	$rows = DBASE::mysqlUpdate($query); */
    	
    	$sql = new MYSQL;
    	$query = $sql->update( ' game ' );
    	$query .= $sql->set("game_status = 1, player_2='".$playerId."', player2_stake='".$mystakeId."' , date_invite_accepted='".$date."' ");
    	$query .= $sql->where('id=' . $gameId);
    	//deduct my balance
    	$rows = DBASE::mysqlUpdate( $query );
    	$last_id =$rows;
    	$sql = new MYSQL;
    	$query = $sql->update( ' balance ' );
    	$query .= $sql->set("balance = balance-$mystakeId ");
    	$query .= $sql->where('uid=' . $playerId);
    	$rows = DBASE::mysqlUpdate( $query );
    	
    	//insert player 2 ID
    	
    	$sql = new MYSQL;
    	$query = $sql->insert(' gaming_player2 ');
    	$query .= $sql->columns('gameId, player_2, player_stake, player_result, date_created, win_status' );
    	$query .= $sql->values( " '".$gameId."', '".$playerId."','$mystakeId', 'NULL', '".date("Y-m-d H:i:s")."', 'pending'");
    	$rows = DBASE::mysqlUpdate($query);
    	//echo '<div>Joined to new game successful.</div>';
    	
    	// gaming wallet balance
    	$sql = new MYSQL;
    	$query = $sql->update(' gaming_wallet ');
    	$query .= $sql->set(" balance = balance+$mystakeId");
    	//$query .= $sql->where(" uid = " . $userId);
    	$rows = DBASE::mysqlUpdate($query);
    	//send mail
    	
    	$to = $email;
    	$cc = SYSTEM_EMAIL;
    	$bcc = "kellyomwaka@gmail.com";
    	$from = SYSTEM_EMAIL;
    	$subject = SITE_NAME_SHORT .' - Dispute  Submission';
    	
    	$body = '
				<p>Dear <strong>'.$playername.'</strong></p>
                <p>You have joined the match created by '.$opponentName.'.  </p>
                <p>Kindly send them a friend request using their gamer tag  '.$gameTag.'.</p>
						
				<p>Regards,<br>'.SITE_NAME_SHORT.'</p>
						
				';
    	
    	$sent = baseModel::sendmail( $from, $to, $cc, $bcc, $subject, $body ) ;
    	
    	//update alert
    	$sql = new MYSQL;
    	$query = $sql->insert( ' gaming_alerts ' );
    	$query .= $sql->columns('usr_id, date_created, description, alert_type, read_status' );
    	$query .= $sql->values( " '".$playerId."', '".date("Y-m-d H:i:s")."', '".$mnt."', 'Game Joining',  '0'  "  );
    	
    	
    	//get direct message
    	
    	echo '<script>self.location="index.php?acc=gamesactive"</script>';
    }
    public function  getMyGameIdAward( $gameId ) {
        $sql = new MYSQL;
    	$query = $sql->select( ' * ' );
    	$query .= $sql->from( 'game g ' );
    	$query .= $sql->where( 'id=' . $gameId );
    	
    	$rows = DBASE::mysqlRowObjects( $query );
    	
    	$row = &$rows[0];
    	
    	return $row;
    }
    public function listMyGamesByStatus( $uid ){
      //echo $uid;
        $st="pending";
    	$sql = new MYSQL;
    	$query = $sql->select('*');
    	$query .= $sql->from(' game g ');
    	$query .= $sql->where(" g.player_1='".$uid."' OR g.player_2='".$uid."' AND date_created >= date_sub(now(),interval 120 minute)");
    	$query .= $sql->order(' g.date_created desc LIMIT 2');
    	$rows = DBASE::mysqlRowObjects($query);
    	
    	return $rows;
    	
    }
    //get disputed
    
    public function disputeMyGamesByStatus( $uid ){
       
            //echo $uid;
            $st="pending";
            $sql = new MYSQL;
            $query = $sql->select('*');
            $query .= $sql->from(' game g ');
            $query .= $sql->where(" g.player_1='".$uid."' OR g.player_2='".$uid."' ");
            $query .= $sql->order(' g.date_created desc ');
            $rows = DBASE::mysqlRowObjects($query);
            
            return $rows;
        
    }
    
    public function showDirectChallenges( $uid ){
    
    	$st="pending";
    	$sql = new MYSQL;
    	$query = $sql->select(' * ');
    	$query .= $sql->from(' game g ');
    	$query .= $sql->where(" g.player_1='".$uid."' OR g.player_2='".$uid."' AND date_created >= date_sub(now(),interval 120 minute)");
    	$query .= $sql->order(' g.date_created desc LIMIT 5');
    	$rows = DBASE::mysqlRowObjects($query);
    	
    	return $rows;
    	
    }
    
    public function  showAllDesputedGame( $playerId ){
    	//echo $playerId;
    	$sql = new MYSQL;
    	$query = $sql->select( ' * ' );
    	$query .= $sql->from( 'game_player1_dispute g ' );
    	$query .= $sql->where( ' g.gameId=' . $playerId );
    	
    	$rows = DBASE::mysqlRowObjects( $query );
    	
    	$row = &$rows[0];
    	
    	return $row;
    	
    }
    
    //adminSubmitWinner
    
    public function adminSubmitWinner( $post ){
    	
    	$myGameId = $post['myGameId'];
    	$player1Id = $post['player1Id'];
    	$alias2 = $post['alias2'];
    	$fname1 = $post['fname1'];
    	$gcount='1';
    	$email =  stripslashes($_POST['player_email']);
    	$mnt =$email." has been awarded by admin as winner";
    	$prizeId =  $post['prizeId'];
    	$sta ="Won";
    	$sta1 ="Lose";
    	
    	$sql = new MYSQL;
    	$query = $sql->update(' gaming_player1 gp1, gaming_player2 g ');
    	$query .= $sql->set(" gp1.win_status ='". $sta ."',  g.win_status ='". $sta1 ."'");
    	//$query .= $sql->where( 'g.gameId=' . $gameId);
    	$query .= $sql->where( " gp1.gameId = " . $myGameId . " AND  gp1.player_1 = " . $player1Id . " " );
    	$rows = DBASE::mysqlUpdate($query);
    	
    	//update dispute 
    	$sql = new MYSQL;
    	$query = $sql->update(' game_player1_dispute g, game_player2_dispute gp1 ');
    	$query .= $sql->set(" g.dispute_status ='". $sta ."', gp1.dispute_status ='".$sta1."'");
    	$query .= $sql->where( " gp1.gameId = " . $myGameId . " AND  g.playerId = " . $player1Id . " " );
    	$rows = DBASE::mysqlUpdate($query);
    	
    	
    	$sql = new MYSQL;
    	$query = $sql->update(' gaming_wallet ');
    	$query .= $sql->set(" balance = balance-$prizeId");
    	$rows = DBASE::mysqlUpdate($query);
    	
    	$sql = new MYSQL;
    	$query = $sql->update('gaming_player1 gb,  balance b ');
    	$query .= $sql->set(" b.balance = balance+$prizeId");
    	$query .= $sql->where( ' b.uid = gb.player_1 and gb.gameId=' . $myGameId);
    	$rows = DBASE::mysqlUpdate($query); 
    	
    	
    	//update game to cancelled
    	$query = $sql->update( ' game gm ' );
    	$query .= $sql->set("gm.game_status ='1', gm.win_status='awarded', gm.game_count ='". $gcount ."'  ");
    	$query .= $sql->where('gm.id=' . $myGameId);
    	$rows = DBASE::mysqlUpdate( $query );
    	
    	//sent email
    	
    	$to = $email;
    	$cc = SYSTEM_EMAIL;
    	$bcc = "kellyomwaka@gmail.com";
    	$from = SYSTEM_EMAIL;
    	$subject = SITE_NAME_SHORT .' - Gaming Kitchen WON Game';
    	
    	$body = '
				<p>Dear '.$fname1.'</p>
				<p>Congratulations, you have WON the game '.$myGameId.' vs. '.$alias2.' and received Ksh '.$prizeId.'</p> 		
				<p>Regards,<br>'.SITE_NAME_SHORT.'</p>
						
				';
    	
    	$sent = baseModel::sendmail( $from, $to, $cc, $bcc, $subject, $body ) ;
    	
    	
    	$sql = new MYSQL;
    	$query = $sql->insert( ' gaming_alerts ' );
    	$query .= $sql->columns('usr_id, date_created, description, alert_type, read_status' );
    	$query .= $sql->values( " '".$playerId."', '".date("Y-m-d H:i:s")."', '".$mnt."', 'dispute award',  '0'  "  );
    	
    	echo '<script>self.location="index.php?acc=disputes"</script>';
    }
    
    public function adminSubmitWinner2 ( $post ){
    
    	$myGameId = $post['myGameId'];
    	$player2Id = $post['player2Id'];
    	$prizeId =  $post['prizeId'];
    	$gcount='1';
    	$email =  stripslashes($_POST['player_email']);
    	$alias1 = $post['alias1'];
    	$fname2 = $post['fname2'];
    	$sta ="Won";
    	$sta1 ="Lose";
    	$mnt=$email."who is winner has been awarded as a winner.";
    	
    	$sql = new MYSQL;
    	$query = $sql->update(' gaming_player2 g, gaming_player1 gp1 ');
    	$query .= $sql->set(" g.win_status ='". $sta ."', gp1.win_status ='".$sta1."'");
    	//$query .= $sql->where( " gp1.gameId = " . $myGameId . " AND  g.player_2 = " . $player2Id . " " );
    	$query .= $sql->where( " g.player_2 ='" . $player2Id ."' and gp1.gameId = '".$myGameId."' ");
    	$rows = DBASE::mysqlUpdate($query);
    	//update dispute table
    	
    	$sql = new MYSQL;
    	$query = $sql->update(' game_player2_dispute g, game_player1_dispute gp1 ');
    	$query .= $sql->set(" g.dispute_status ='". $sta ."', gp1.dispute_status ='".$sta1."'");
    	$query .= $sql->where( " gp1.gameId = " . $myGameId . " AND  g.playerId = " . $player2Id . " " );
    	$rows = DBASE::mysqlUpdate($query);
    	
    	$sql = new MYSQL;
    	$query = $sql->update(' gaming_wallet ');
    	$query .= $sql->set(" balance = balance-$prizeId");
    	$rows = DBASE::mysqlUpdate($query);
    	
    	$sql = new MYSQL;
    	$query = $sql->update('gaming_player2 gb,  balance b ');
    	$query .= $sql->set(" b.balance = balance+$prizeId");
    	$query .= $sql->where( ' b.uid = gb.player_2 and gb.gameId=' . $myGameId);
    	$rows = DBASE::mysqlUpdate($query);
    	
    	//update game to cancelled
    	$query = $sql->update( ' game gm ' );
    	$query .= $sql->set("gm.game_status ='1', gm.win_status='awarded',  gm.game_count ='". $gcount ."' ");
    	$query .= $sql->where('gm.id=' . $myGameId);
    	$rows = DBASE::mysqlUpdate( $query );
    	
    	//sent email
    	
    	$to = $email;
    	$cc = SYSTEM_EMAIL;
    	$bcc = "kellyomwaka@gmail.com";
    	$from = SYSTEM_EMAIL;
    	$subject = SITE_NAME_SHORT .' - Gaming Kitchen WON Game';
    	
    	$body = '
				<p>Dear '.$fname2.'</p>
				<p>Congratulations, you have WON the game '.$myGameId.' vs. '.$alias1.' and received Ksh '.$prizeId.'</p>
				<p>Regards,<br>'.SITE_NAME_SHORT.'</p>
						
				';
    	
    	$sent = baseModel::sendmail( $from, $to, $cc, $bcc, $subject, $body ) ;
    	
    	
    	$sql = new MYSQL;
    	$query = $sql->insert( ' gaming_alerts ' );
    	$query .= $sql->columns('usr_id, date_created, description, alert_type, read_status' );
    	$query .= $sql->values( " '".$playerId."', '".date("Y-m-d H:i:s")."', '".$mnt."', 'dispute award',  '0'  "  );
    	
    	echo '<script>self.location="index.php?acc=disputes"</script>';
    
    	
    }
    
    public function showAllDesputed2Game( $playerId ){
    
    	$sql = new MYSQL;
    	$query = $sql->select( ' * ' );
    	$query .= $sql->from( 'game_player2_dispute g ' );
    	$query .= $sql->where( ' g.gameId=' . $playerId );
    	$rows = DBASE::mysqlRowObjects( $query );
    	
    	$row = &$rows[0];
    	
    	return $row;
    	
    }
    
    public function showDesputedGameByPlayerId( $playerId, $gameId ){
    	
    	$sql = new MYSQL;
    	$query = $sql->select( ' * ' );
    	$query .= $sql->from( 'game_player2_dispute g ' );
    	//$query .= $sql->where(' g.playerId=' . $playerId );
    	//$query .= $sql->where(" g.playerId='".$playerId."'");
    	$query .= $sql->where( " g.playerId ='" . $playerId ."' and g.gameId = '".$gameId."' ");
    	$rows = DBASE::mysqlRowObjects( $query );
    	
    	$row = &$rows[0];
    	
    	return $row;
    	
    }
    
    public function showDesputed1GameByPlayerId( $playerId, $gameId ){
    	
    	$sql = new MYSQL;
    	$query = $sql->select( ' * ' );
    	$query .= $sql->from( 'game_player1_dispute g ' );
    	//$query .= $sql->where(' g.playerId=' . $playerId );
    	$query .= $sql->where(" g.playerId='".$playerId."' and g.gameId = '".$gameId."' ");
    	$rows = DBASE::mysqlRowObjects( $query );
    	
    	$row = &$rows[0];
    	
    	return $row;
    	
    }
    
    public function  oneplayer1History( $playerId ){
    
    	$sql = new MYSQL;
    	$query = $sql->select( ' * ' );
    	$query .= $sql->from( 'gaming_player1 ply1' );
    	$query .= $sql->where( " ply1.player_1 ='" . $playerId ."' ");
    	$rows = DBASE::mysqlRowObjects( $query );
    	$row = &$rows[0];
    	return $row;
    	
    }
    
    public function  oneplayer1Details( $playerId, $gameId ){
    	//echo $gameId, "vvvvvvvvvvvvvvvvvvvvvv",$playerId;
    	$sql = new MYSQL;
    	$query = $sql->select( ' * ' );
    	$query .= $sql->from( 'gaming_player1 ply1' );
    	//$query .= $sql->where( "ply1.gameId='".$playerId."' AND ply1.player_1='".$gameId."' " );
    	$query .= $sql->where( " ply1.player_1 ='" . $playerId ."' and ply1.gameId = '".$gameId."' ");
    	$rows = DBASE::mysqlRowObjects( $query );
    	$row = &$rows[0];
    	return $row;
    	
    }
    
    public function  oneplayer2History( $playerId ){
    	
    	$sql = new MYSQL;
    	$query = $sql->select( ' * ' );
    	$query .= $sql->from( 'gaming_player2 ply2' );
    	$query .= $sql->where( " ply2.player_2 ='" . $playerId ."'  ");
    	$rows = DBASE::mysqlRowObjects( $query );
    	$row = &$rows[0];
    	
    	return $row;
    	
    	
    }
    
    public function  oneplayer2Details( $playerId, $gameId ){
    	$sql = new MYSQL;
    	$query = $sql->select( ' * ' );
    	$query .= $sql->from( 'gaming_player2 ply2' );
    	//$query .= $sql->where( "ply1.gameId='".$playerId."' AND ply1.player_1='".$gameId."' " );
    	$query .= $sql->where( " ply2.player_2 ='" . $playerId ."' and ply2.gameId = '".$gameId."' ");
    	$rows = DBASE::mysqlRowObjects( $query );
    	$row = &$rows[0];
  
    	return $row;
    	
    	
    }
    
    public function showAllMyGames( $playerId ) {
    	$sql = new MYSQL;
    	$query = $sql->select('*');
    	$query .= $sql->from(' game g');
    	$query .= $sql->where(" g.player_1=" . $playerId . " OR  g.player_2=" . $playerId . " ");
    	$query .= $sql->order(' g.date_created desc');
    	
    	$rows = DBASE::mysqlRowObjects($query);
    	
    	return $rows;
    	
    }
    
    public function checkAllGames(){
    	$sql = new MYSQL;
    	$query = $sql->select('*');
    	$query .= $sql->from(' game g');
    	$query .= $sql->order(' g.date_created desc');
    	$rows = DBASE::mysqlRowObjects($query);
    	
    	return $rows;
    	
    }
    
   
    public function listMyGames($uid) {

        $sql = new MYSQL;
        $query = $sql->select('*');
        $query .= $sql->from(' game g');
        $query .= $sql->where(" g.player_1=" . $uid . "  AND date_created >= date_sub(now(),interval 40 minute) ");
        $query .= $sql->order(' g.date_created desc');

        $rows = DBASE::mysqlRowObjects($query);

        return $rows;
    }

    public function listActiveGames( $uid, $status ) {
    
    	$sql = new MYSQL;
    	$query = $sql->select('*');
    	$query .= $sql->from(' game g');
    	//$query .= $sql->where(" g.player_1=" . $uid . " OR  g.player_2=" . $uid . " ");
    	$query .= $sql->where( " (g.player_1 ='" . $uid ."' or g.player_2 ='" . $uid ."') and g.game_count = '".$status."' ");
    	$query .= $sql->order(' g.date_created desc');
    	
    	$rows = DBASE::mysqlRowObjects($query);
    	
    	return $rows; 
    	
    	//echo "user Id",$uid," status ",$status;
    }
    public function countActiveGames( $uid, $status ) {
    	
    	
    	$sql = new MYSQL;
    	$query = $sql->select('*');
    	$query .= $sql->from(' game g');
    	//$query .= $sql->where(" g.player_1=" . $uid . " OR  g.player_2=" . $uid . " ");
    	$query .= $sql->where( " (g.player_1 ='" . $uid ."' or g.player_2 ='" . $uid ."') and g.game_count = '".$status."' ");
    	$query .= $sql->order(' g.date_created desc');
    	
    	$rows = DBASE::mysqlRowObjects($query);
    	
    	return $rows; 
    	
    }

    public function checkIfInviteAccepted($tid) {

        $sql = new MYSQL;
        $query = $sql->select(' * ');
        $query .= $sql->from(' tournament ');
        $query .= $sql->where(" id = " . $tid . " and  player_2 != 0 ");

        $count = DBASE::mysqlNumRows($query);

        return $count;
    }
    //award prize
    
    public function submitAward1( $post ){
    	
    	$gameId = $post['gameId'];
    	$mnt="winner is player 1";
    	$playerId = $post['player1Id'];
    	$won_status = "won";
    	$sta ="Won";
    	$sta1 ="Lose";
    	//echo $gameId;
    	$prizeId = $post['prizeId'];
    	echo "Game ID ",$gameId, "Player ",$playerId,"Prize : ",$prizeId;
    	
    	//$query .= $sql->where( " gp1.gameId = " . $myGameId . " AND  gp1.player_1 = " . $player1Id . " " );
    	//update table
    	$sql = new MYSQL;
    	$query = $sql->update(' game gp1 ');
    	$query .= $sql->set(" gp1.win_status ='". $won_status ."' ");
    	$query .= $sql->where(  " gp1.id = " . $gameId . " AND  gp1.player_1 = " . $playerId . " ");
    	$rows = DBASE::mysqlUpdate($query);
    	
    	//update loose
    	$sql = new MYSQL;
    	$query = $sql->update(' gaming_player1 gp1, gaming_player2 g ');
    	$query .= $sql->set(" gp1.win_status ='". $sta ."',  g.win_status ='". $sta1 ."'");
    	$query .= $sql->where(  " g.gameId = gp1.gameId and gp1.gameId = " . $gameId . " AND  gp1.player_1 = " . $playerId . " ");
    	//$query .= $sql->where( 'g.gameId = gp1.gameId and gp1.gameId=' . $gameId);
    	$rows = DBASE::mysqlUpdate($query);
    	
    	    	
    	$sql = new MYSQL;
    	$query = $sql->update(' gaming_wallet ');
    	$query .= $sql->set(" balance = balance-$prizeId");
    	$rows = DBASE::mysqlUpdate($query); 
    	
    	$sql = new MYSQL;
    	$query = $sql->update('gaming_player1 gb,  balance b ');
    	$query .= $sql->set(" b.balance = balance+$prizeId");
    	$query .= $sql->where( ' b.uid = gb.player_1 and gb.gameId=' . $gameId);
    	$rows = DBASE::mysqlUpdate($query);
    	
    	//update alert
    	$sql = new MYSQL;
    	$query = $sql->insert( ' gaming_alerts ' );
    	$query .= $sql->columns('usr_id, date_created, description, alert_type, read_status' );
    	$query .= $sql->values( " '".$player2Id."', '".date("Y-m-d H:i:s")."', '".$mnt."', 'Rewarded', '0'  "  );
    	
    	echo '<script>self.location="index.php?acc=gamesactive"</script>';
    	
    }
    
    public function submitDispute( $post ){
    
    	$gameId = $post['gameId'];
    	
    	echo $gameId;
    	
    }
    
    public function submitDispute2( $post ){
    
    	$gameId = $post['gameId'];
    	
    	echo $gameId;
    	
    }
    
    public function submitAward2( $post ){
    	$gameId = $post['gameId'];
    	//echo $gameId;
    	$prizeId = $post['prizeId'];
    	
    	$playerId = $post['player2Id'];
    	
    	$mnt="player 2 is the winner";
    	$sta ="Won";
    	$sta1 ="Lose";
    	$sql = new MYSQL;
    	$query = $sql->update(' gaming_player2 g, gaming_player1 gp1 ');
    	$query .= $sql->set(" g.win_status ='". $sta ."', gp1.win_status ='".$sta1."'");
    	//$query .= $sql->where( 'g.gameId = gp1.gameId and gp1.gameId=' . $gameId);
    	$query .= $sql->where(  " gp1.gameId = g.gameId and gp1.gameId = " . $gameId . " AND  g.player_2 = " . $playerId . " ");
    	$rows = DBASE::mysqlUpdate($query);
    	//update loose
    	/* $sql = new MYSQL;
    	$query = $sql->update(' gaming_player1 gp1 ');
    	$query .= $sql->set(" gp1.win_status ='". $sta1 ."'");
    	$query .= $sql->where( ' gp1.gameId=' . $gameId);
    	$rows = DBASE::mysqlUpdate($query); */
    	
    	$sql = new MYSQL;
    	$query = $sql->update(' gaming_wallet ');
    	$query .= $sql->set(" balance = balance-$prizeId");
    	$rows = DBASE::mysqlUpdate($query); 
    	
    	$sql = new MYSQL;
    	$query = $sql->update('gaming_player2 gb,  balance b ');
    	$query .= $sql->set(" b.balance = balance+$prizeId");
    	$query .= $sql->where( ' b.uid = gb.player_2 and gb.gameId=' . $gameId);
    	$rows = DBASE::mysqlUpdate($query);
    	
    	//update alert
    	$sql = new MYSQL;
    	$query = $sql->insert( ' gaming_alerts ' );
    	$query .= $sql->columns('usr_id, date_created, description' );
    	$query .= $sql->values( " '".$player2Id."', '".date("Y-m-d H:i:s")."', '".$mnt."'  "  );
    	
    	echo '<script>self.location="index.php?acc=gamesactive"</script>';
   
    }
    
    public function submitCancelGame( $post ){
    	
    	$gameId = $post['gameId'];
    	$playerId = $post['playerId'];
    	$myreason = $post['myreason'];
    	$email =  stripslashes($_POST['player_email']);
    	$fname =  stripslashes($_POST['player_name']);
    	
    	//echo "Your name :: ", $fname;
    	$amountStaked = $post['amountStaked'];
    	$refund = "refunded";
    	$status="1";
    	$gcount='1';
    	$cancel = "cancelled";
    	$mnt = " has cancelled game with Id";
    	//echo "Game Id :", $gameId. "Player Id :",$playerId. " My Reason :", $myreason;
    	
    	$sql = new MYSQL;
    	$query = $sql->insert( ' game_cancellation ' );
    	$query .= $sql->columns('gameId, playerId, myreason, amountRefunded, date_created, refund_status' );
    	$query .= $sql->values( " '".$gameId."', ".$playerId.", '".$myreason."', '".$amountStaked."', '".date("Y-m-d H:i:s")."', '".$refund."'  "  );
    	$rows = DBASE::mysqlInsert( $query);
    	//update balance
    	$query = $sql->update( ' balance ' );
    	$query .= $sql->set("balance = balance+$amountStaked ");
    	$query .= $sql->where('uid=' . $playerId);
    	$rows = DBASE::mysqlUpdate( $query );
    	
    	//update wallet.
    	
        $sql = new MYSQL;
    	$query = $sql->update(' gaming_wallet ');
    	$query .= $sql->set(" balance = balance-$amountStaked ");
    	$rows = DBASE::mysqlUpdate($query); 
    	
    	//update alert
    	$sql = new MYSQL;
    	$query = $sql->insert( ' gaming_alerts ' );
    	$query .= $sql->columns('usr_id, date_created, description, alert_type, read_status' );
    	$query .= $sql->values( " '".$playerId."', '".date("Y-m-d H:i:s")."', '".$mnt."', 'automatic cancellation', '0'  "  );
    	$rows = DBASE::mysqlUpdate($query); 
    	
      	
    	//update player 1
    	
    	$query = $sql->update( ' gaming_player1 ply1 ' );
    	$query .= $sql->set("win_status = '$cancel' ");
    	$query .= $sql->where('ply1.gameId=' . $gameId);
    	$rows = DBASE::mysqlUpdate( $query );
    	
    	//update game to cancelled
    	$query = $sql->update( ' game gm ' );
    	$query .= $sql->set("gm.cancellation_status = '$cancel', gm.game_status='1', gm.win_status='cancelled', gm.game_count ='". $gcount ."' ");
    	$query .= $sql->where('gm.id=' . $gameId);
    	$rows = DBASE::mysqlUpdate( $query );
    	
    	//sent 
    	$to = $email;
    	$cc = SYSTEM_EMAIL;
    	$bcc = "kellyomwaka@gmail.com";
    	$from = SYSTEM_EMAIL;
    	$subject = SITE_NAME_SHORT .' - GAME CANCELLATION';
    	
    	$body = '
				<p>Dear '.$fname.'</p>
				<p>'.$fname.'<strong> we have noticed you have canceled the match you created. Amount Kshs. <strong>'.$amountStaked.' has been refunded to your gaming account.</p>
				<p> Reason for cancellation '.$myreason.'</p>
                <p>You can now join or create another match with us. Thank You</p>		
				<p>Regards,<br>'.SITE_NAME_SHORT.'</p>
						
				';
    	
    	$sent = baseModel::sendmail( $from, $to, $cc, $bcc, $subject, $body ) ;
    	
    	

    	echo '<script>self.location="index.php?acc=gamesactive"</script>';
    	
    }

    public function submitMyGameClaim( $post ){
    	$gameId = $post['gameId'];
    	$playerId = $post['playerId'];
    	$claimNow = $post['claimNow'];
    	$mnt= "claim has been submitted  ".$claimNow;
    	
    	$sql = new MYSQL;
    	$query = $sql->update(' game g , gaming_player1 gp1 ');
    	$query .= $sql->set(" g.player_1_result ='". $claimNow ."', gp1.player_result ='". $claimNow ."'");
    	$query .= $sql->where( 'g.id=' . $gameId);
    	$rows = DBASE::mysqlUpdate($query);
    	
    	//update alert
    	$usere = $fname." has created new game with id".$last_id. "Amount stake   : ".$stake;
    	$alertt ="Custom Game";
    	$sql = new MYSQL;
    	$query = $sql->insert(' gaming_alerts ');
    	$query .= $sql->columns(' usr_id, date_created, description, alert_type, read_status  ' );
    	$query .= $sql->values( " '".$playerId."', '".date("Y-m-d H:i:s")."', '".$mnt."', 'Result Submitted', '0'");
    	$rows = DBASE::mysqlUpdate($query);
    	
    	echo '<script>self.location="index.php?acc=gamesactive"</script>';
    	
    }
    
    public function rewardWinner(){
    	// gaming wallet balance
    	$sql = new MYSQL;
    	$query = $sql->update(' photos g');
    	$query .= $sql->set(" g.name ='CCC', g.image ='YYYY', DATE_SUB(NOW(), INTERVAL 1 MINUTE)");
    	//name
    	//image
    	//(date) VALUES (DATE_ADD(NOW(), INTERVAL 1 DAY))
    	//$query = $sql->update(' gaming_player1 ');
    	//$query .= $sql->set(" win_status = 'Won'");
    	//$query .= $sql->where(" gp1.player_result = 'Yes'  AND date_created >= NOW(),interval 1 minute) ");
    	$rows = DBASE::mysqlUpdate($query);
    	
    	
    }
    //play 2 submit claim
    public function submitMyGameClaim2 ( $post ) {
    	$gameId = $post['gameId'];
    	$playerId = $post['playerId'];
    	$mnt =" player 2 has submitted his claim";
    	$claimNow = $post['claimNow'];
    	echo $gameId."".$playerId;
    	$sql = new MYSQL;
    	$query = $sql->update(' game g , gaming_player2 gp2 ');
    	$query .= $sql->set(" g.player_2_result ='". $claimNow ."', gp2.player_result ='". $claimNow ."' ");
    	$query .= $sql->where( 'g.id='. $gameId);
    	$rows = DBASE::mysqlUpdate($query);
    	
    	//update alert
    	$sql = new MYSQL;
    	$query = $sql->insert(' gaming_alerts ');
    	$query .= $sql->columns(' usr_id, date_created, description, alert_type, read_status  ' );
    	$query .= $sql->values( " '".$playerId."', '".date("Y-m-d H:i:s")."', '".$mnt."', 'Claim Prize', '0'");
    	$rows = DBASE::mysqlUpdate($query);
    	
    	echo '<script>self.location="index.php?acc=gamesactive"</script>';
    }
    public function userPhoneNumber($uid) {
        $sql = new MYSQL;
        $query = $sql->select(' * ');
        $query .= $sql->from(' user_details ');
        $query .= $sql->where(" user_id = " . $uid . " ");

        $rows = DBASE::mysqlRowObjects($query);

        //return baseModel::numberFormat($rows[0]->phoneno);
        return $rows[0]->phoneno;
    }

    public function checkBalance($uid) {

        $sql = new MYSQL;
        $query = $sql->select(' * ');
        $query .= $sql->from(' balance ');
        $query .= $sql->where(" uid = " . $uid . " ");

        $rows = DBASE::mysqlRowObjects($query);

        return $rows[0]->balance;
    }
    
    public function adminCheckBalance() {
    	$sql = new MYSQL;
    	$query = $sql->select(' * ');
    	$query .= $sql->from(' gaming_wallet ');
    	//$query .= $sql->where(" uid = " . $uid . " ");
    	$rows = DBASE::mysqlRowObjects($query);
    	
    	return $rows[0]->balance;
    }
    
    public function cancelGameNow($uid){
    	
    	echo $uid +"sssssssssssssssssss";
    }

    public function listOpenTournaments() {

        $sql = new MYSQL;
        $query = $sql->select(' * ');
        $query .= $sql->from(' tournament ');
        $query .= $sql->where(" player_1 != " . MYID . " and player_2 = 0 and NOW() < tournament_end_date ");

        $rows = DBASE::mysqlRowObjects($query);

        return $rows;
    }
    
    public function getBalanceByUserId( $userId ) {
    
    	$sql = new MYSQL;
    	$query = $sql->select(' * ');
    	$query .= $sql->from(' gaming_balance ');
    	$query .= $sql->where(" usr_id = " . $userId . "");
    	
    	$rows = DBASE::mysqlRowObjects($query);
    	
    	return $rows;
    	
    }
    
    public function showMyFavourites( $playerId ) {
    
    	$sql = new MYSQL;
    	$query = $sql->select(' * ');
    	$query .= $sql->from(' gaming_favourites ');
    	$query .= $sql->where(" usr_id = " . $playerId . " ");
    	
    	$rows = DBASE::mysqlRowObjects($query);
    	
    	return $rows;
    }
    //get game history 
    public function listMyGameHistoryByPlayerID( $playerId) {
    	
    	$sql = new MYSQL;
    	$query = $sql->select(' * ');
    	$query .= $sql->from(' game ');
    	$query .= $sql->where(" player_1 = " . $playerId . " OR  player_2 = " . $playerId . " ");
    	$query .= $sql->order(' date_created desc');
    	$rows = DBASE::mysqlRowObjects($query);
    	
    	return $rows;
    	
    }
    
    public function listMyGameHistoryByWin( $playerId, $win) {
     
    	 $sql = new MYSQL;
    	$query = $sql->select(' * ');
    	$query .= $sql->from(' game ');
    	$query .= $sql->where(" player_1 = " . $playerId . " OR  player_2 = " . $playerId . "  AND win_status = '".$win."'  ");
    	$query .= $sql->order(' date_created desc');
    	$rows = DBASE::mysqlRowObjects($query);
    	
    	return $rows;  
    	
    	//echo "Guess who wins ",$playerId," Win status ",$win,"<br/>";
    	
    	
    }
    
  
    //get transaction history
    
    public function listTransactionHistoryByPlayerID( $playerId ) {
    	
    	$sql = new MYSQL;
    	$query = $sql->select(' * ');
    	$query .= $sql->from(' gaming_balance ');
    	$query .= $sql->where(" usr_id = " . $playerId . " ");
    	
    	$rows = DBASE::mysqlRowObjects($query);
    	
    	return $rows;
    	
    }
    
    //list game with favourite id
    public function showAllMyFavouriteGames( $gameId ) {
    	
    	$sql = new MYSQL;
    	$query = $sql->select(' * ');
    	$query .= $sql->from(' game ');
    	$query .= $sql->where(" player_1 = " . $gameId . " OR player_2 = " . $gameId . " ");
    	
    	$rows = DBASE::mysqlRowObjects($query);
    	
    	return $rows;
    	
    }
    

    public function listMyTournaments() {

        $sql = new MYSQL;
        $query = $sql->select(' * ');
        $query .= $sql->from(' game ');
        $query .= $sql->where(" player_1 = " . MYID . " or  player_2 = " . MYID . " ");

        $rows = DBASE::mysqlRowObjects($query);

        return $rows;
    }

    public function listMyCurrentActiveTournaments() {

        $sql = new MYSQL;
        $query = $sql->select(' * ');
        $query .= $sql->from(' tournament ');
        $query .= $sql->where(" NOW() between date_invite_accepted and tournament_end_date and ( player_1 = " . MYID . " or  player_2 = " . MYID . " ) ");

        $rows = DBASE::mysqlRowObjects($query);

        return $rows;
    }
        public function listMyTransactions($phone) {

        $sql = new MYSQL;
        $query = $sql->select(' * ');
        $query .= $sql->from(' stk_payments ');
        $query .= $sql->where(" PhoneNumber = ".$phone." ");
        //echo $query;
        $rows = DBASE::mysqlRowObjects($query);

        return $rows;
    }

    public function inviteToTournament($gid, $url) {
        $dt = date("Y-m-d H:i:s");

        $sql = new MYSQL;
        $query = $sql->insert(' tournament ');
        $query .= $sql->columns(' game_id, player_1, date_created');
        $query .= $sql->values(" " . $gid . ", " . MYID . ",  '" . $dt . "' ");

        $rows = DBASE::mysqlInsert($query);

        echo '<script>self.location="' . $url . '&msg=success"</script>';
    }

    public function acceptTournament($tid, $url) {
        $dt = date("Y-m-d H:i:s");
        $endtime = date("Y-m-d H:i", strtotime($dt) + GAME_DURATION * 60);

        $sql = new MYSQL;
        $query = $sql->update(' tournament ');
        $query .= $sql->set(" player_2 =" . MYID . ", date_invite_accepted='" . $dt . "', tournament_end_date = '" . $endtime . "' ");
        $query .= $sql->where(" id = " . $tid);

        $rows = DBASE::mysqlUpdate($query);

        echo '<script>self.location="' . $url . '&page=accept&msg=success"</script>';
    }

    public function isActiveTournament($tid) {

        $sql = new MYSQL;
        $query = $sql->select(' * ');
        $query .= $sql->from(' tournament ');
        $query .= $sql->where(" id = " . $tid . " and NOW() between date_invite_accepted and tournament_end_date ");

        $count = DBASE::mysqlNumRows($query);

        return $count > 0 ? 1 : 0;
    }

    public function postResults($post) {
        $tid = $_POST['tid'];
        $score = $_POST['score'];
        $url = $_POST['url'];

        $tournament = baseModel::tournamentDetails($tid);

        if ($tournament->player_1 == MYID)
            $field = "player_1_result";
        elseif ($tournament->player_2 == MYID)
            $field = "player_2_result";


        $sql = new MYSQL;
        $query = $sql->update(' tournament ');
        $query .= $sql->set(" " . $field . " =" . $score . " ");
        $query .= $sql->where(" id = " . $tid);

        $rows = DBASE::mysqlUpdate($query);

        echo '<script>self.location="' . $url . '&page=details&tid=' . $tid . '&msg=success"</script>';
    }

    public function insertTransaction($MpesaReceiptNumber, $MerchantRequestID,
            $CheckoutRequestID, $ResultDesc, $Amount, $TransactionDate, $PhoneNumber) {

        $logFile = "stkPushCallbackResponse.log";
        $log = fopen($logFile, "a");
        fwrite($log, " saving");
        fclose($log);
        
        $sql = new MYSQL;
        $query = $sql->insert(' stk_payments ');
        $query .= $sql->columns(' MpesaReceiptNumber, MerchantRequestID, CheckoutRequestID, ResultDesc,'
                . 'Amount, TransactionDate, PhoneNumber ');

        $query .= $sql->values(" '" . $MpesaReceiptNumber . "','" . $MerchantRequestID . "','" . $CheckoutRequestID .
                "','" . $ResultDesc . "','" . $Amount . "','" . $TransactionDate . "','" . $PhoneNumber . "' ");

        //$logFile = "stkPushCallbackResponse.log";
        $log1 = fopen($logFile, "a");
        fwrite($log1, $query . " Yes Tras");
        fclose($log1);
    }
    
    public function automaticPayer2DisputeCreated($player1,$player2, $gameId, $prize) {
    	
    	$winstatus="Yes";
    	$sql = new MYSQL;
    	$query = $sql->update(' game g ');
    	$query .= $sql->set(" g.player_1_result ='". $winstatus ."' , g.player_2_result ='". $winstatus ."'  ");
    	$query .= $sql->where( 'g.id=' . $gameId);
    	$rows = DBASE::mysqlUpdate($query);
    	
    	$sql = new MYSQL;
    	$query = $sql->update(' gaming_player1 gp1, gaming_player2 g ');
    	$query .= $sql->set(" gp1.win_status ='". $winstatus ."',  g.win_status ='". $winstatus ."'");
    	$query .= $sql->where( 'g.gameId = gp1.gameId and gp1.gameId=' . $gameId);
    	$rows = DBASE::mysqlUpdate($query);
    	
    }
    public function automaticPayer1DisputeCreated($player2Id,$player1Id, $gameId, $prize) {
    	
    	$winstatus="Yes";
    	$sql = new MYSQL;
    	$query = $sql->update(' game g ');
    	$query .= $sql->set(" g.player_1_result ='". $winstatus ."' , g.player_2_result ='". $winstatus ."'  ");
    	$query .= $sql->where( 'g.id=' . $gameId);
    	$rows = DBASE::mysqlUpdate($query); 
    	
    	$sql = new MYSQL;
    	$query = $sql->update(' gaming_player1 gp1, gaming_player2 g ');
    	$query .= $sql->set(" gp1.win_status ='". $winstatus ."',  g.win_status ='". $winstatus ."'");
    	$query .= $sql->where( 'g.gameId = gp1.gameId and gp1.gameId=' . $gameId);
    	$rows = DBASE::mysqlUpdate($query);
    	
    	
    	
    }

}

?>