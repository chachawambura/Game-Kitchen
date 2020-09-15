<?php

class defaultModel
	{
    
   

    
	public function updateLogTable($myid, $action)
		{
		
		$dt = date("Y-m-d H:i:s");
						
		$sql = new MYSQL;
		$query = $sql->insert( 'user_logs' );
		$query .= $sql->columns( 'user_id, action, date_action' );	
		$query .= $sql->values( " ".$myid.", '".$action."', '". $dt. "' " );
			
		$rows = DBASE::mysqlInsert( $query );
			
		}	
	
public function logout()
	{
	
	if(isset($_SESSION['myid']))
		echo defaultModel::updateLogTable($_SESSION['myid'], 'logout');
	
	session_unset( $_SESSION['myid'] );
	
	session_destroy();
	
	echo '<script>self.location="index.php"</script>';	
	
	}

        public function validation(){
            
        }
}
?>