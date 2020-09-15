<?php
class baseModel
{	
	
	public function categoryDetails($id)
		{
		
		$sql = new MYSQL;		
		$query = $sql->select( ' * ' );
		$query .= $sql->from( ' category ' );	
		$query .= $sql->where( 'id=' . $id );	
				
		$rows = @DBASE::mysqlRowObjects( $query );
	
		$row = &$rows[0];
		
		return $row;
	
		}
		
	public function gameDetails($id)
		{
		
		$sql = new MYSQL;		
		$query = $sql->select( ' * ' );
		$query .= $sql->from( ' game ' );	
		$query .= $sql->where( 'id=' . $id );	
				
		$rows = DBASE::mysqlRowObjects( $query );
	
		$row = &$rows[0];
		
		return $row;
	
		}	
		
	public function tournamentDetails($id)
		{
		
		$sql = new MYSQL;		
		$query = $sql->select( ' * ' );
		$query .= $sql->from( ' tournament ' );	
		$query .= $sql->where( 'id=' . $id );	
				
		$rows = DBASE::mysqlRowObjects( $query );
	
		$row = &$rows[0];
		
		return $row;
	
		}
		
        public function stkTransactionDetails($id)
		{
		
		$sql = new MYSQL;		
		$query = $sql->select( ' * ' );
		$query .= $sql->from( ' stk_payments ' );	
		$query .= $sql->where( 'id=' . $id );	
				
		$rows = DBASE::mysqlRowObjects( $query );
	
		$row = &$rows[0];
		
		return $row;
	
		}
                
	function createSet( $array ) {
		
		if( is_array( $array ) ) :
				
			foreach( $array as $key => $value ) :
					
				if( $key != 'submit' && strlen(trim($value)) > 0 ) :
						
					$string .= $key . "='" . baseModel::cleanContent($value) . "', ";
				
				endif;
				
			endforeach;
				
			$string = trim( substr( $string, 0, -2 ) );			
				
		endif;
			
		return $string;
	
	}
	

	public function session_checker($session)
		{
		$now = time();
	
		$session_end = $session + SESSION_DURATION * 60;
		
		if($now > $session_end )
			echo defaultModel::logout();
		else
			$_SESSION['login'] = time();
		
		}
	
	public function ordinalNumber($num)
		{
	
			switch($num % 10)
				{
				case 1: return $num.'st';
				case 2: return $num.'nd';
				case 3: return $num.'rd';
				default: return $num.'th';
				}			

		}

	public function numberFormat($num)
		{
	
		return number_format($num,2,'.',',');

		}
		
	function cleanContent($str)
		{
		
		$newstr = str_replace("'","\'",$str);
		//$newstr = htmlspecialchars($str, ENT_COMPAT)
		
		return $newstr;
		
		}
		
	public function formatDate( $originalDate ) {
		
		$year = date("Y", strtotime($originalDate));
		
		if(strlen($originalDate) > 10) ///if it has time element
			$newDate = date( "M jS, Y H:i", strtotime( $originalDate ) );
		else
			$newDate = date( "M jS, Y", strtotime( $originalDate ) );
			
		return $newDate;
	
	}
	
	function sendmail( $from, $to, $cc, $bcc, $subject, $body ) {
		
		$mime_boundary = "==Multipart_Boundary_x" . md5( mt_rand() ) . "x";
        // now we'll build the message headers
        $headers = "From: $from\r\n" .
        "CC: $cc\r\n" .
		"BCC: $bcc\r\n" .
        "MIME-Version: 1.0\r\n" .
        "Content-Type: multipart/mixed;\r\n" .
        " boundary=\"{$mime_boundary}\"";

        //$message = $body;
        $message = "This is a multi-part message in MIME format.\n\n" .
        "--{$mime_boundary}\n" .
        "Content-Type: text/html; charset=\"iso-8859-1\"\n" .
        "Content-Transfer-Encoding: 7bit\n\n" .
        $body . "\n\n";

        $message .= "--{$mime_boundary}--\n";

        if( @mail( $to, $subject, $message, $headers ) ) :                               
        	return 1;
     	else :
			return 0;
		endif;
	
	}
	
}
?>