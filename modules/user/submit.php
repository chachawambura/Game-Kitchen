<?php	
	$post = $_POST;	
	
	$user_id = $post['user_id'];
	unset( $post['user_id'] );
	unset( $post['submit'] );
	
	if( $user_id == 0 ) {	
		
		if( is_array( $post ) ) :			
			foreach( $post as $key => $value ) :					
				$fields .= trim( $key ) . ", ";
				$values .= "'" . trim( $value ) . "', ";					
			endforeach;		
		endif;
			
		$fields = substr( trim( $fields ), 0, -1 );		
		$values = substr( trim( $values ), 0, -1 );
			
		$query = new MYSQL;
		$query->insert( 'user_details' );
		$query->columns( $fields );	
		$query->values( $values );
		
		$rows = DBASE::mysqlInsert( $query );
		
	}
	
	else {
	
		$sql = new MYSQL;
		$query = $sql->update( 'user_details' );
		$query .= $sql->set( createSet( $post ) );	
		$query .= $sql->where( 'user_id=' . $user_id );
		
		$rows = DBASE::mysqlUpdate( $query );
	}
	
	echo '<script>self.location="' . $url . '&msg=' . $rows . '"</script>';	
?>