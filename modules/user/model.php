<?php
class userModel
{

	public function userIndex( $url, $view, $id ) {			
		
		global $myid;
		global $bg_light;
		global $bg_dark;
				
		include $view . EXT;
			
	}	
	
	public function submitEnablePlayer( $playerId ){
		
		$sql = new MYSQL;
		$query = $sql->update( ' users ' );
		$query .= $sql->set("active = 1 ");
		$query .= $sql->where('id=' . $playerId);
		$rows = DBASE::mysqlUpdate( $query );
		
		echo '<script>self.location="index.php?acc=userslist"</script>';
	}
	
    
	public function playerSearchTo ( $input ){
		
		$sql = new MYSQL;
		$query = $sql->select( 'fname, lname' );
		$query .= $sql->from( 'user_details' );
		$query .= $sql->where( 'alais=' . "kelianto1" );
		
		
		$rows = DBASE::mysqlRowObjects( $query );
		
		if(count($rows) < 1 )
			return '<font color="#ff4563">No name set</font>';
			else
			{
				$row = &$rows[0];
				$names = $row->fname . '&nbsp;' . $row->lname;
				
				return $names;
			}
			
           echo $input;
			
		
	}
	
	public function userDetails( $id ) {
	
		$sql = new MYSQL;		
		$query = $sql->select( ' * ' );
		$query .= $sql->from( 'user_details d, users u' );	
		$query .= $sql->where( ' u.id = d.user_id and user_id=' . $id );	
				
		$rows = DBASE::mysqlRowObjects( $query );
	
		$row = &$rows[0];
		
		return $row;
	
	}
	
	public function userName( $uid ) {
		
		
		if( $uid < 1 )
			{
			return '<font color="#ff4563">No name set</font>';
			}
		else
			{
			$sql = new MYSQL;		
			$query = $sql->select( 'fname, lname' );
			$query .= $sql->from( 'user_details' );	
			$query .= $sql->where( 'user_id=' . $uid );	
				
				
			$rows = DBASE::mysqlRowObjects( $query );	
			
			if(count($rows) < 1 )
				return '<font color="#ff4563">No name set</font>';
			else	
				{
				$row = &$rows[0];		
				$names = $row->fname . '&nbsp;' . $row->lname;
				
				return $names;
				}
				
			}

		}
		
		public function player1details( $uid ) {
			
			
			if( $uid < 1 )
			{
				return '<font color="#ff4563">No name set</font>';
			}
			else
			{
				$sql = new MYSQL;
				$query = $sql->select( 'fname, lname' );
				$query .= $sql->from( 'user_details u, game g' );
				$query .= $sql->where( " u.player_1='".$uid."' OR u.player_2='".$uid."' " );
				
				
				$rows = DBASE::mysqlRowObjects( $query );
				
				if(count($rows) < 1 )
					return '<font color="#ff4563">No name set</font>';
					else
					{
						$row = &$rows[0];
						$names = $row->fname . '&nbsp;' . $row->lname;
						
						return $names;
					}
					
			}
			
		}

	public function currentUserId() {
	
		$user_id = $_SESSION['myid'];
		
		return $user_id;
	
	}		
	
	public function userSubmit( $post ) {
		
		$user_id = $post['user_id'];
		unset( $post['user_id'] );
		unset( $post['submitThis'] );
		unset( $post['termsandconditions'] );
		
		//$post['dob'] = date("Y-m-d", strtotime(str_replace('/','-',$post['dob'])));
		
		$code = rand(1000, 9999);

		$email = $post['emailadd'];
		
		$post['date_created'] = date("Y-m-d H:i:s");
		$post['activation_code'] = $code;
		
		if( $user_id == 0 ) 
			{				
			if( is_array( $post ) ) :			
				foreach( $post as $key => $value ) :					
					$fields .= trim( $key ) . ", ";
					$values .= "'" . trim( baseModel::cleanContent( $value ) ) . "', ";						
				endforeach;		
			endif;
				
			$fields = substr( trim( $fields ), 0, -1 );		
			$values = substr( trim( $values ), 0, -1 );
			
			$accesslvl = isset($post['access_lvl']) ? $post['access_lvl'] : 0;
			
			//$pass = uniqid(rand());
			$pin = mt_rand(1000, 9999);
			$post['pwd'] = $pin;
			
			$pwd = isset($post['pwd']) ? md5($pin) : '';
				
			$sql = new MYSQL;
			$query = $sql->insert( 'users' );
			$query .= $sql->columns('emailadd, access_lvl, pwd, pwd_orig, activation_code, date_created' );	
			$query .= $sql->values( " '".$email."', ".$accesslvl.", '".$pwd."', '".$pwd."', '".md5($code)."', '".date("Y-m-d H:i:s")."'  "  );
			
			$rows = DBASE::mysqlInsert( $query);
			
			
			
			$userid = userModel::getUseridFromEmail($email);
			
			echo userModel::updateUserDetails($post, $userid);
			
			echo userModel::updateGameAlerts($post, $userid);
			
			echo userModel::generateStrikes($post, $userid);
			
			//update default strikes
			
			
			}
		
		else {
		
			$sql = new MYSQL;
			$query = $sql->update( 'user_details' );
			$query .= $sql->set( baseModel::createSet( $post ) );	
			$query .= $sql->where( 'user_id=' . $user_id );
			
			$rows = DBASE::mysqlUpdate( $query );
			
			
			
			$user_logs = userModel::insertUserActivity( MYID, 'Updated Profile -'.$user_id );
			
			echo '<script>self.location="' . $url . '&msg=success"</script>';	
		}
		
			
	}
	
	
	
	public function getUseridFromEmail($email)
		{
		
		$sql = new MYSQL;		
		$query = $sql->select( ' * ' );
		$query .= $sql->from( 'users' );	
		$query .= $sql->where( "emailadd = '".$email."' " );	
				
		$rows = DBASE::mysqlRowObjects( $query );
	
		$row = &$rows[0];
		
		return $row->id;
		
		}
		
		public function generateStrikes($post, $userid) {
			
		}
		
		public function updateGameAlerts($post, $userid){
	        $amnt="New registration";
	        $status='0';
	        $alerttype='Sign up';
			$sql = new MYSQL;
			$query = $sql->insert( ' gaming_alerts ' );
			$query .= $sql->columns('usr_id, date_created, description, alert_type,  read_status' );
			$query .= $sql->values( " '".$userid."', '".date("Y-m-d H:i:s")."', '".$amnt."' , '".$alerttype."' ,'".$status."'  "  );
			
			$rows = DBASE::mysqlUpdate($query);
			
			
		}
	
	public function updateUserDetails($post, $userid)
		{
		
		$post['user_id'] = $userid;
		
		$email = $post['emailadd'];
		$pwd = $post['pwd'];
		$code = $post['activation_code'];
		
		unset( $post['emailadd'] );
		unset( $post['pwd'] );
		unset( $post['activation_code'] );
		
			if( is_array( $post ) ) :			
				foreach( $post as $key => $value ) :					
					$fields .= trim( $key ) . ", ";
					$values .= "'" . trim( baseModel::cleanContent( $value ) ) . "', ";						
				endforeach;		
			endif;
				
			$fields = substr( trim( $fields ), 0, -1 );		
			$values = substr( trim( $values ), 0, -1 );
				
			//	echo $fields .'<br>' .$values;
				
			$sql = new MYSQL;
			$query = $sql->insert( 'user_details' );
			$query .= $sql->columns( $fields );	
			$query .= $sql->values( $values );
			
			$rows = DBASE::mysqlInsert( $query );
			
			
			
			//update balance table
			echo userModel::updatePlayersBalance($userid,0);
			
			//send email
			$to = $email;
			$cc = SYSTEM_EMAIL;
			//$bcc = "kellyomwaka@gmail.com";
			$from = SYSTEM_EMAIL;
			$subject = SITE_NAME_SHORT .' - User Registration';
			
			$body = '
				<p>Dear '.$post['fname'].' '.$post['lname'].'</p>
				<p>Thank you for registering an account with The Gaming Kitchen this is your one Time password</p>
				<p>To activate your account login using the below email and system generated password:</p>
                <p>===================================================================</p>
				<p>Username   :<strong> '.$email.'</strong></p>
				<p>System Generated Password  : <strong>'.$pwd.'</strong></p>
                <p>====================================================================</p>
				<p>NB: Kindly reset current password to a preffered New Password.</p>
				<p>Regards,<br>'.SITE_NAME_SHORT.'</p>
				
				';
			
			 $sent = baseModel::sendmail( $from, $to, $cc, $subject, $body ) ;
			 
			 $sql = new MYSQL;
			 $amnt="#ffffff";
			 $query = $sql->insert( ' gaming_strikes ' );
			 $query .= $sql->columns('user_id, gaming_green, gaming_orange, gaming_red ' );
			 $query .= $sql->values( " '".$userid."', '".$amnt."', '".$amnt."', '".$amnt."' "  );
			 $rows = DBASE::mysqlInsert( $query );
			
			if($sent ==1)
				echo '<script>self.location="index.php?pg=reg&msg=success"</script>';	
			else
				echo '<script>self.location="index.php?pg=reg&msg=email_error"</script>';				
		}
	
	public function updatePlayersBalance($uid, $bal)
		{
		
		$sql = new MYSQL;		
		$query = $sql->select( ' * ' );
		$query .= $sql->from( ' balance ' );	
		$query .= $sql->where( " uid = '".$uid."' " );	
				
		$count = DBASE::mysqlNumRows( $query );

		$date = date("Y-m-d H:i");
		
		if($count == 0 ):
			
			$sql = new MYSQL;
			$query = $sql->insert( ' balance ' );
			$query .= $sql->columns( "uid, last_updated, date_created" );	
			$query .= $sql->values( " ".$uid.", '".$date."', '".$date."' " );
			
			$rows = DBASE::mysqlInsert( $query );
			
		else:
		
			$sql = new MYSQL;
			$query = $sql->update( ' balance ' );
			$query .= $sql->set( " balance = ".$bal.", last_updated = '".$date."' " );	
			$query .= $sql->where( " uid = ".$uid );
			
			$rows = DBASE::mysqlInsert( $query );
			
		endif;
		
		}
	
	public function userExists($post)
		{
		$email = $post['emailadd'];
		$phone = $post['phoneno'];

		$sql = new MYSQL;		
		$query = $sql->select( ' * ' );
		$query .= $sql->from( 'users u, user_details d' );	
		$query .= $sql->where( " u.id=d.user_id and (phoneno = '" . $phone ."' or emailadd ='" . $email ."') ");	
			
		$count = DBASE::mysqlNumRows( $query );
		
		return ( $count > 0) ? 1 : 0 ;
		
		}	
	
	
	public function activateUser($post)
		{
		
		$code = $post['activation_code'];
		$email = $post['emailadd'];
		
		$sql = new MYSQL;		
		$query = $sql->select( ' * ' );
		$query .= $sql->from( 'users u, user_details d' );	
		$query .= $sql->where( " u.id=d.user_id and emailadd ='" . $email ."' and activation_code = '".md5($code)."' ");	
				
		$count = DBASE::mysqlNumRows( $query );
	
		if($count > 0 ):
		
			$rows = DBASE::mysqlRowObjects($query);
			$uid = $rows[0]->user_id;
		
			$newcode = $code .'_'.$code;
			$date = date("Y-m-d H:i:s");
			
			$sql2 = new MYSQL;		
			$query2 = $sql2->update( 'user_details' );
			$query2 .= $sql2->set( "active = 1, activation_code='".md5($newcode)."', date_activated='".$date."' " );	
			$query2 .= $sql2->where( 'user_id=' . $uid );
			
			$rows2 = DBASE::mysqlUpdate( $query2 );
			
			$to = $email;
			$cc ="";
			$bcc = SYSTEM_EMAIL.',kellyomwaka@gmail.com';
			$from = NOREPLY_EMAIL;
			$subject = SITE_NAME_SHORT." - Email activation and pass";
			$body = '<p>
					Dear '.userModel::userName($uid).',<br>You have successfully activated your account. </p>
					<p>You are advised to change the password after login, through the system.</p>
					
					<br>
					<p>Regards,<br>
					'.SITE_NAME_SHORT.'
					</p>';				
			
			$sent = baseModel::sendmail( $from, $to, $cc, $bcc, $subject, $body ) ;
			
			if($sent ==1)
				{ echo '<p class="isa_success">Email successfully sent</p>'; }
			else
				{echo '<p class="isa_error">Email not sent. Contact the web admin.</p>';}
			
			echo '<script>self.location="index.php?pg=activate&msg=success"</script>';
			
		else:			
			echo '<div class="col-md-12 isa_error text-center">Activation Failed. The details provided for activation are not correct.</div>';
						
		endif;
		
		}
	
	public function changePassword( $post ) 
		{
		
		if( userModel::userAuthentic( MYID )->pwd != md5( $post['opw'] ) ) :
		
			echo '<script>self.location="' . $post['url'] . '&err=1"</script>';
			
		else :			
			
			$sql = new MYSQL;
			$query = $sql->update( 'users' );
			$query .= $sql->set( "pwd='" . md5( $post['npw'] ) . "'" );	
			$query .= $sql->where( 'id=' . MYID );				
			
			$rows = DBASE::mysqlUpdate( $query );	
		
			echo '<script>self.location="' . $post['url'] . '&msg=success"</script>';
			
		endif;
	
	}
	
	public function userAuthentic( $id ) {
	
		$sql = new MYSQL;		
		$query = $sql->select( ' * ' );
		$query .= $sql->from( 'users' );	
		$query .= $sql->where( 'id=' . $id );	
				
		$rows = DBASE::mysqlRowObjects( $query );
	
		$row = &$rows[0];
		
		return $row;
	
	}
	
	public function remindPassword( $post ) 
		{
		
		$email = $post['emailadd'];
		$idno = $post['idno'];
		
		$sql = new MYSQL;		
		$query = $sql->select( ' * ' );
		$query .= $sql->from( 'users u, user_details d' );	
		$query .= $sql->where( " u.id = d.user_id and emailadd = '".$email."' and idno = '".$idno."' " );	
				
		$count = DBASE::mysqlNumRows( $query );
	
		if($count > 0 ):
			
			$rows = DBASE::mysqlRowObjects( $query );	
			$row = &$rows[0];
			$uid = $row->user_id;
			
			$pass = uniqid(rand());
			$pwd = md5($pass);
			
			$code = rand(1000, 9999);
						
			$sql2 = new MYSQL;
			$query2 = $sql2->update( 'users' );
			$query2 .= $sql2->set( " pwd = '" . $pwd . "', pwd_orig = '".$pwd."' " );	
			$query2 .= $sql2->where( " emailadd = '" . $email ."' " );				
			
			$rows2 = DBASE::mysqlUpdate( $query2 );	
			
			$sql3 = new MYSQL;
			$query3 = $sql3->update( 'user_details' );
			$query3 .= $sql3->set( " activation_code = '" . md5($code) . "' " );	
			$query3 .= $sql3->where( " user_id = ".$uid );				
			
			$rows3 = DBASE::mysqlUpdate( $query3 );				
			
			
			///send email
			$to = $email;
			$cc ="";
			//$bcc = SYSTEM_EMAIL;
			$from = SYSTEM_EMAIL;
			$subject = SITE_NAME_SHORT." - Password Reminder ";
			$body = '<p>
					Dear '.userModel::userName($uid).',</p>
					<p>This is an email after you requested for a new password through '.SITE_NAME_SHORT.'</p>
					<p>Your new password is <b>'.$pass.'</b></p>
					<p>Your activation code is <b>'.$code.'</b></p>
					<p>You are advised to change the password after you login</p>
					<br>
					<p>Regards,<br>
					'.SITE_NAME_SHORT.'
					</p>';				
			
			$sent = baseModel::sendmail( $from, $to, $cc, $subject, $body ) ;
			
			if($sent ==1)
				echo '<script>self.location="index.php?pg=pwd&msg=success"</script>';
			else
				echo '<script>self.location="index.php?pg=pwd&msg=em"</script>';
		else:
			echo '<script>self.location="index.php?pg=pwd&msg=error"</script>';	
			
		endif;
		
		}
	
	public function insertUserActivity(  $user_id, $action ) {
	
		$date = date( 'Y-m-d H:i:s' );
		
		$sql = new MYSQL;
		$query = $sql->insert( 'user_logs' );
		$query .= $sql->columns( 'user_id, action, date_action' );	
		$query .= $sql->values( " '$user_id', '$action', '$date' " );
		
		$rows = DBASE::mysqlUpdate( $query );		
	
	}
	
	public function listActivities( $user_id ) {
	
		$sql = new MYSQL;		
		$query = $sql->select( ' * ' );
		$query .= $sql->from( 'user_logs' );	
		$query .= $sql->where( 'user_id=' . $user_id );	
				
		$rows = DBASE::mysqlRowObjects( $query );
		
		return $rows;
		
	}


}
?>
