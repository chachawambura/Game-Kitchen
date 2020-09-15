<?php
class dashboardModel 
	{

	function welcomeNote($userid) 
		{		
		
		$names = userModel::userName( $userid );	
		
		return 'Welcome <b>'.$names.'</b>';		
				
		}	
		public function claimingPrize( $post ){
			$claimNow = $post['claimNow'];
			echo $gameId."",$usrId, "".$claimNow;
		}
		
		public function checkAllAsRead(){
		    
		    echo 'we are';
		    $tagNamic ='1';
		    $sql = new MYSQL;
			$query = $sql->update(' gaming_alerts ');
			$query .= $sql->set(" read_status ='". $tagNamic ."' ");
			$rows = DBASE::mysqlUpdate($query); 
		}
		public function  updateGamerTagNow( $post ) {
			
			$playerId = $post['playerId'];
			$tagNamic = $post['tagNamic'];
			$sql = new MYSQL;
			$query = $sql->update(' user_details ');
			$query .= $sql->set(" nametag ='". $tagNamic ."' ");
			$query .= $sql->where( 'user_id=' . $playerId);
			$rows = DBASE::mysqlUpdate($query); 
			
			echo '<script>self.location="index.php?pg=myprofile"</script>';
			
		}
		
		public function addNewLeague( $post ) {
		    $gameCategoryId = $post['gameCategoryId'];
		    $league = $post['league'];
		    $dt='Active';
		    echo 'Game Category'+$gameCategoryId;
		    echo '<br/>';
		    echo 'League',$league;
		    
		    $sql = new MYSQL;
		    $query = $sql->insert( 'gaming_league' );
		    $query .= $sql->columns( 'category_id, league, status' );
		    $query .= $sql->values( " ".$gameCategoryId.", '".$league."', '". $dt. "' " );
		    
		    $rows = DBASE::mysqlInsert( $query );
		}
		public function submitSearchPlayerBetweenDates($startd, $enddate){
		 		    
		    $now = new DateTime($startd);
		    $startdatez = $now->format('Y-m-d H:i:s');
		    //$startdatez = $now->getTimestamp();  
		    
		    $date2 = new DateTime($enddate);
		    //$date2->add(new DateInterval('PT10H30S'));
		    $enddatez = $date2->format('Y-m-d H:i:s');
		    $late = date("Y-m-d H:i:s", strtotime("+23 hours $enddatez"));
		   // echo 'Start ',$startdatez, "End .............",$enddatez,"New End time",$late;
		    $sql = new MYSQL;
		    $query = $sql->select(' * ');
		    $query .= $sql->from(' game ');
		    $query .= $sql->where(" date_created >= '".$startdatez."' and date_created <= '".$late."' ");
		    $query .= $sql->order(' date_created desc');
		    $rows = DBASE::mysqlRowObjects($query);
		    return $rows; 
		  /*  $start ='2019-11-05 23:26:58';
		   $enddat = '2019-11-05 23:26:58';
		     */
		    
		}
		public function listUserList() {
			
			$sql = new MYSQL;
			$query = $sql->select( ' * ' );
			$query .= $sql->from( 'user_details d, users u' );
			$query .= $sql->where( ' u.id = d.user_id ' );	
			
			$rows = DBASE::mysqlRowObjects($query);
			
			return $rows;
		}
		
		public function showLeagueNow() {
		    
		    $sql = new MYSQL;
		    $query = $sql->select( ' * ' );
		    $query .= $sql->from( 'gaming_league d, game_category u' );
		    $query .= $sql->where( ' u.id = d.category_id ' );
		    
		    $rows = DBASE::mysqlRowObjects($query);
		    
		    return $rows;
		}
		
		public function gamingNotificationList() {
			
			$sql = new MYSQL;
			$query = $sql->select( ' * ' );
			$query .= $sql->from( ' gaming_notifications ' );
			$rows = DBASE::mysqlRowObjects($query);
			return $rows;
		}
		
		public function listNotifications( $userId ){
			
			$sql = new MYSQL;
			$query = $sql->select(' * ');
			$query .= $sql->from(' gaming_alerts g ');
			$query .= $sql->where(" g.usr_id='".$userId."' AND g.read_status='0'");
			$query .= $sql->order(' date_created desc');
			
			$rows = DBASE::mysqlRowObjects($query);
			
			return $rows; 
			
			
		}
		
		//show colors
		public function listUserStrikes( $userId ){
			
			$sql = new MYSQL;
			$query = $sql->select(' * ');
			$query .= $sql->from(' gaming_strikes g ');
			$query .= $sql->where(" g.user_id='".$userId."' ");
			$rows = DBASE::mysqlRowObjects($query);
			
			return $rows;
			
			echo "User Id ",$userId;
			
			
		}
		public function listNotificationx( ){
		
			$sql = new MYSQL;
			$query = $sql->select(' * ');
			$query .= $sql->from(' gaming_alerts g ');
			$query .= $sql->where(" g.read_status='0'");
			$query .= $sql->order(' g.date_created desc');
			
			$rows = DBASE::mysqlRowObjects($query);
			
			return $rows; 
			
		}
		
		public  function countDisputeResolution( $userId ){
		    $mystatus='Yes';
		    $sql = new MYSQL;
		    $query = $sql->select(' * ');
		    $query .= $sql->from(' game g ');
		    $query .= $sql->where( " (g.player_1='".$userId."' or g.player_2='".$userId."') and (g.player_1_result = '".$mystatus."' and g.player_2_result = '".$mystatus."') " );
		    $query .= $sql->order(' g.date_created desc LIMIT 10');
		    $rows = DBASE::mysqlRowObjects($query);
		    
		    return $rows; 
		    
		}
		public function listDirectMessage( $userId ) {
		
		/*	$sql = new MYSQL;
			$query = $sql->select(' * ');
			$query .= $sql->from(' gaming_direct_message g ');
			//$query .= $sql->where(" g.usr_id='".$userId."'");
			$query .= $sql->where(" g.usr_id='".$userId."' OR g.invite_id='".$userId."'");
			$query .= $sql->order(' date_created desc');
			
			$rows = DBASE::mysqlRowObjects($query);
			
			return $rows;*/
			
			
		}
		
		public function userSubmitMyGame2( $post ) {
		    
		    $current_date = date("Y-m-d H:i:s");
		    $userId = $post['userId'];
		    $gameCategoryId = $post['gameCategoryId'];
		    $leagueId = $post['leagueId'];
		    //leagueId
		    $gameConsoleId = $post['gameConsoleId'];
		    $stake = $post['stake'];
		    $starlevel = 'None';
		    $gamerules = 'None';
		    $date = date('Y-m-d H:i:s');
		    $stake2='0';
		    $email = $post['myemail'];
		    $fname = $post['fname'];
		    //calculate game end time
		    $date1 = date('Y-m-d H:i:s');
		    $datez = strtotime($date1);
		    $datey = strtotime("+10 minute", $datez);
		    $final =  date('d-m-Y H:i:s', $datey);
		    $alertt = strtotime("+5 minute", $datez);
		    $alertime =  date('d-m-Y H:i:s', $alertt);
		    $sql = new MYSQL;
		    $query = $sql->insert( 'game' );
		    $query .= $sql->columns('gamecategory_id, player_1, player_2, player1_stake,  player_1_result, player2_stake,  player_2_result, date_created, game_type,  date_invite_accepted, tournament_end_date, alert_time, game_status' );
		    $query .= $sql->values( " '".$gameCategoryId."', '".$userId."','NULL' ,'".$stake."','NULL','0','NULL','$current_date','custom', '$current_date','$final','$alertime','0'");
		    
		    $rows = DBASE::mysqlInsert( $query);
		    
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
		    //$leagueId
		    $query .= $sql->columns('gameId, gmlevel, gmperiod, game_league,  gmconsole, date_created,  gm_status' );
		    $query .= $sql->values( " '".$last_id."', '".$starlevel."', '".$gamerules."', '".$leagueId."', '".$gameConsoleId."', '".date("Y-m-d H:i:s")."', 'pending'");
		    $rows = DBASE::mysqlUpdate($query);
		    
		    //insert into player 2
		    
		    $sql = new MYSQL;
		    $query = $sql->insert(' gaming_player1 ');
		    $query .= $sql->columns('gameId, player_1, player_stake, player_result, date_created, win_status' );
		    $query .= $sql->values( " '".$last_id."', '".$userId."', '".$stake."','NULL', '".date("Y-m-d H:i:s")."', 'pending'");
		    $rows = DBASE::mysqlUpdate($query);
		    
		    //update alert table
		    $usere = $fname." has created new game with a stake : ".$stake." waiting for an opponent to join.";
		    $alertt ="Custom Game";
		    $sql = new MYSQL;
		    $query = $sql->insert(' gaming_alerts ');
		    $query .= $sql->columns(' usr_id, date_created, description, alert_type, read_status  ' );
		    $query .= $sql->values( " '".$userId."', '".date("Y-m-d H:i:s")."', '".$usere."', 'Custom Game', '0'");
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
		    
		    echo '<div class="col-md-12 isa_error text-center">New game created successsfuly.</div>';
		    
		    //submit game
		    echo '<script>self.location="' . $url . 'index.php?acc=games&page=games-all"</script>';
		    
		    
		}
		
		public function userSubmitMyGame( $post ){
			$current_date = date("Y-m-d H:i:s");
			$userId = $post['userId'];
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
			$alertt = strtotime("+5 minute", $datez);
			$alertime =  date('d-m-Y H:i:s', $alertt);
			$sql = new MYSQL;
			$query = $sql->insert( 'game' );
			$query .= $sql->columns('gamecategory_id, player_1, player_2, player1_stake,  player_1_result, player2_stake,  player_2_result, date_created, game_type,  date_invite_accepted, tournament_end_date, alert_time, game_status' );
			$query .= $sql->values( " '".$gameCategoryId."', '".$userId."','NULL' ,'".$stake."','NULL','0','NULL','$current_date','custom', '$current_date','$final','$alertime','0'");
			
			$rows = DBASE::mysqlInsert( $query);
			
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
			$usere = $fname." has created new game with a stake : ".$stake." waiting for an opponent to join.";
			$alertt ="Custom Game";
			$sql = new MYSQL;
			$query = $sql->insert(' gaming_alerts ');
			$query .= $sql->columns(' usr_id, date_created, description, alert_type, read_status  ' );
			$query .= $sql->values( " '".$userId."', '".date("Y-m-d H:i:s")."', '".$usere."', 'Custom Game', '0'");
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
			
			echo '<div class="col-md-12 isa_error text-center">New game created successsfuly.</div>';
			
			//submit game
			echo '<script>self.location="' . $url . 'index.php?acc=games&page=games-all"</script>';	
			
		}
		
		public function listUserLOGS() {
			
			$sql = new MYSQL;
			$query = $sql->select('*');
			$query .= $sql->from(' user_logs ');
			$query .= $sql->order(' date_action desc');
			
			$rows = DBASE::mysqlRowObjects($query);
			
			return $rows;
		}
		
		public function listAllTransactions() {
			
			$sql = new MYSQL;
			$query = $sql->select('*');
			$query .= $sql->from(' stk_payments ');
			$query .= $sql->order(' TransactionDate desc');
			
			$rows = DBASE::mysqlRowObjects($query);
			
			return $rows;
		}
		
		public function listAllGames() {
			
			$sql = new MYSQL;
			$query = $sql->select('*');
			$query .= $sql->from(' game g, game_category c');
			$query .= $sql->where(" g.gamecategory_id=c.id");
			
			$rows = DBASE::mysqlRowObjects($query);
			
			return $rows;
		
		}
		
		public function getAllDeposits() {
			
			$sql = new MYSQL;
			$query = $sql->select(' * ');
			$query .= $sql->from(' stk_payments ');
			$query .= $sql->order(' TransactionDate desc');
			$rows = DBASE::mysqlRowObjects($query);
			
			return $rows;
			
		}
		
		public function listAllGamesByAdmin() {
		
			$sql = new MYSQL;
			$query = $sql->select('*');
			$query .= $sql->from(' game');
			//$query .= $sql->where(" g.gamecategory_id=c.id and g.player_1=u.id");
			
			$rows = DBASE::mysqlRowObjects($query);
			
			return $rows;
			
			
		}
		public function listAllGameCategory() {
			$sql = new MYSQL;
			$query = $sql->select('*');
			$query .= $sql->from(' game_category ');
			//$query .= $sql->order(' date_created desc');
			$rows = DBASE::mysqlRowObjects($query);
			return $rows;
			
		}
		//get games by category
		public function getGameByCategoryId( $catId ) {

			$sql = new MYSQL;
			$query = $sql->select( ' * ' );
			$query .= $sql->from( 'game g, game_category c' );
			$query .= $sql->where( ' c.id = g.gamecategory_id and gamecategory_id=' . $catId );
			
			$rows = DBASE::mysqlRowObjects( $query );
			
			$row = &$rows[0];
			
			return $row;
			
			
		}
		
		public function getGamingDetailsById( $playerId ) {
			
			$sql = new MYSQL;
			$query = $sql->select( ' * ' );
			$query .= $sql->from( 'game g,  gaming_details gd' );
			$query .= $sql->where( ' g.id = gd.gameId and gd.gameId=' . $playerId );
			
			$rows = DBASE::mysqlRowObjects( $query );
			
			$row = &$rows[0];
			
			return $row;
			
		}
		
		public function getGameByPlayerId( $playerId ) {
		
			$sql = new MYSQL;
			$query = $sql->select(' * ');
			$query .= $sql->from(' game g');
			//$query .= $sql->where( ' g.player_1=' . $playerId );
			$query .= $sql->where(" g.player_1='".$playerId."' OR g.player_2='".$playerId."'");
			$query .= $sql->order(' date_created desc');
			$rows = DBASE::mysqlRowObjects($query);
			return $rows;
			
			
		}
	
		public function newGameCategory( $post ){
			
			$gametitle = stripslashes($_POST['gametitle']);
			$gamedesc = stripslashes($_POST['gamedesc']);
			$profileImageName = time() . '-' . $_FILES["gameImage"]["name"];
			// For image upload
			$target_dir = "upload/";
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
					$query = $sql->insert( 'game_category' );
					$query .= $sql->columns('gametitle, gamedesc, gameImage' );
					$query .= $sql->values( " '".$gametitle."', '".$gamedesc."', '".$profileImageName."'"  );
					
					$rows = DBASE::mysqlInsert( $query);
				}
				
				//
				//echo '<div class="col-md-12 isa_error text-center">New game category has been uploaded successfully.</div>';
			}
			
			/* $gametitle = $post['gametitle'];
			$gamedesc = $post['gamedesc'];
			$gameImage = $post['gameImage'];
			
			$sql = new MYSQL;
			$query = $sql->insert( 'game_category' );
			$query .= $sql->columns('gametitle, gamedesc, gameImage' );
			$query .= $sql->values( " '".$gametitle."', '".$gamedesc."', '".$gameImage."'"  );
			
			$rows = DBASE::mysqlInsert( $query);
			
	         */
			
			
			
		}
		public function searchByToday (){
		    $sql = new MYSQL;
		    $query = $sql->select('*');
		    $query .= $sql->from(' game ');
		    $query .= $sql->where(" date_created >= date_sub(now(),interval 1 DAY) ");
		    $query .= $sql->order(' date_created desc');
		    
		    $rows = DBASE::mysqlRowObjects($query);
		    return $rows;
		  
		}
		public function searchTodayCount (){
		    $sql = new MYSQL;
		    $query = $sql->select('*');
		    $query .= $sql->from(' game ');
		    $query .= $sql->where(" date_created >= CURDATE() ");
		    $query .= $sql->order(' date_created desc');
		    
		    $rows = DBASE::mysqlRowObjects($query);
		    return $rows;
		    
		    
		}
		public function searchByWeekly (){
		
		    $sql = new MYSQL;
		    $query = $sql->select('*');
		    $query .= $sql->from(' game ');
		    $query .= $sql->where(" date_created >= date_sub(now(),interval 1 WEEK) ");
		    $query .= $sql->order(' date_created desc');
		    
		    $rows = DBASE::mysqlRowObjects($query);
		    return $rows;
		   
		}
		public function searchByMonthly(){
		 
		    $sql = new MYSQL;
		    $query = $sql->select('*');
		    $query .= $sql->from(' game ');
		    $query .= $sql->where(" date_created >= date_sub(now(),interval 1 MONTH) ");
		    $query .= $sql->order(' date_created desc');
		    
		    $rows = DBASE::mysqlRowObjects($query);
		    //SELECT name, species, birth FROM pet  WHERE species = 'dog' OR species = 'cat'
		    return $rows;
		   
		}
		public function newGameAdded( $post ) {
			
			$gametitle = $post['gametitle'];
			$gamedesc = $post['gamedesc'];
			$gameImage = $post['gameImage'];
			$categoryId = $post['categoryId'];
			$price = $post['price'];
			$entryFee = $post['entryFee'];
			$seats = $post['seats'];
			
			
			$sql = new MYSQL;
			$query = $sql->insert( 'game' );
			$query .= $sql->columns('title, descrip, img_icon, cat_id, prize, entry_fee, seats, date_created' );
			$query .= $sql->values( " '".$gametitle."', '".$gamedesc."', '".$gameImage."', '".$categoryId."','".$price."','".$entryFee."', '".$seats."', '".date("Y-m-d H:i:s")."'  "  );
			
			$rows = DBASE::mysqlInsert( $query);
			
			
		}
		
		public function getAllCategory(){
		
			$sql = new MYSQL;
			$query = $sql->select('*');
			$query .= $sql->from(' category ');
			$query .= $sql->order(' date_created desc');
			
			$rows = DBASE::mysqlRowObjects($query);
			
			return $rows;
		}
		public function getGamingBalance (){
					
			$sql = new MYSQL;
			$query = $sql->select(' SUM(amount_deposited) AS totalsum ');
			$query .= $sql->from(' gaming_balance ');
			
			$rows = DBASE::mysqlRowObjects($query);
			
			$sum = $rows['amount_deposited'];
			
			echo ("This is the sum: $sum");
			
			return $sum;
			//$rows[0]->amount_deposited;
			
		}
		//SELECT SUM(amount_deposited) FROM gaming_balance
	
	}
?>