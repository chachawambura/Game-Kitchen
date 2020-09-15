<?php
class DBASE 
{

	function dbConnect( $db_host, $db_user, $db_pass, $db_name ) {
	
		$db_conn= mysql_connect($db_host, $db_user, $db_pass);
           mysql_select_db($db_name);
	
	}
	
	
	function mysqlNumRows( $query ) {		
			
		$result = mysql_num_rows( mysql_query( "$query" ) );		
		return $result;	
		
	}
	
	function mysqlRowObjects( $query ) {
		
		
		
		$key = '';
		
		$result = mysql_query( "$query" );		
		
		$array = array();
		
		while( $row = mysql_fetch_object( $result ) ) :			
			
			if( $key ) 
				$array[$row->$key] = $row;
			
			else
				$array[] = $row;
			
		endwhile;
		
		mysql_free_result( $result );
		
		return $array;
				
	}
	
	function mysqlInsert( $query ) {
		
		$result = mysql_query("$query") or die( mysql_error() );
		$return = ( $result ) ? mysql_insert_id() : '';
		
		return $return;
			
	}
        
        	function mysqlRInsert( $query ) {
		
		$result = mysql_query("$query") or die( mysql_error() );
		$return = ( $result ) ? mysql_insert_id() : '';
		
		return $return;
			
	}
	
	function mysqlUpdate( $query ) {		
		
		
		$result = mysql_query( "$query" ) or die( mysql_error() );	
		$return = ( $result ) ? 1 : 0;
		
		return $return;	
			
	}
	
	function mysqlDelete( $query ) {		
		
		
		$result = mysql_query( "$query" ) or die( mysql_error() );	
		$return = ( $result ) ? 1 : 0;
		
		return $return;	
			
	}
	
	

}
?>