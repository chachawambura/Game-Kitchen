<?php
class adminModel
	{
    
    public function access_token(){

    }
    
    public function adminResetPasswordNow( $post ){
    	$userId = $post['userId'];
    	$password = $post['newpassword'];
    	$confpassword = $post['confirmpassword'];
    	if($password==$confpassword){
    		echo 'password same';
    		$sepass = md5($password);
    		$sql = new MYSQL;
    		$query = $sql->update(' users u ');
    		$query .= $sql->set(" u.pwd ='". $sepass ."',  u.pwd_orig ='". $sepass ."'");
    		$query .= $sql->where( 'u.id=' . $userId);
    		$rows = DBASE::mysqlUpdate($query);
    		
    		echo '<br/> password update successfully ..';
    		
    	}else {
    		echo '<div class="col-md-6">password reset not successful. password not same</div>';
    	}
    	//echo "reset this now ",$userId;
    	
    }
    
    public function shareAward ( $post ){
    	$sta ="draw";
    	$gameId = $post['myGameId'];
    	$player1Id = $post['player1Id'];
    	$player2Id = $post['player2Id'];
    	$prizeId = $post['prizeId'];
    	$rewa = $prizeId;
    	//update all players
    	$sql = new MYSQL;
    	$query = $sql->update(' gaming_player1 gp1, gaming_player2 g ');
    	$query .= $sql->set(" gp1.win_status ='". $sta ."',  g.win_status ='". $sta ."'");
    	$query .= $sql->where( 'g.gameId=' . $gameId);
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
    	
    	echo '<script>self.location="index.php?acc=disputes"</script>';
    }
}

?>