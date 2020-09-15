<div class="col-md-12 login">
 <?php    

if( $_POST['submitThis'] == 'Login' ) {				
	
	
	// username and password sent from form
	$usr = $_POST['emailadd'];
	$pwd = $_POST['passwd'];
	
	// To protect MySQL injection (more detail about MySQL injection)
	$usr = stripslashes( $usr );
	$pwd = stripslashes( $pwd );
	$usr = mysql_real_escape_string( $usr );
	$pwd = mysql_real_escape_string( $pwd );
	
	// encrypt password
	$pwd = md5( $pwd );		
	
	$sql = new MYSQL;		
	$query = $sql->select( '*' );
	$query .= $sql->from( 'users u, user_details d ' );
	$query .= $sql->where( "emailadd='$usr' AND pwd='$pwd' and u.id=d.user_id and active=1 limit 0,1" );
	
	$num = DBASE::mysqlNumRows( $query );	
	
	if( $num == 1 ) {					
	
		$rows = DBASE::mysqlRowObjects( $query );
		$row = &$rows[0];			
		
		// store session data
		$_SESSION['myid'] = $row->user_id;
		$_SESSION['userlevel'] = $row->access_lvl;	
		$_SESSION['login']=time();
		
		//update chat status
		echo defaultModel::updateLogTable($_SESSION['myid'], 'login');
			
		echo '<script>self.location=\'index.php\'</script>';
		
		
		
		// redirect		
		
		//if($row->pwd != $row->pwd_orig)	
			
		//else
			//echo '<script>self.location=\'index.php?act=user&acc=pwd\'</script>';	
		
	}else if($row->active==0){
		$loginError = '<div>Your account has been permanently suspended due to violation of our rules and regulations.</div>';
		echo  '<div class="col-md-12 text-center isa_error" style="width:600px;">'.$loginError.'</div>';
		
	}else if($row->activation_code=="1"){
		$loginError = '<div>Your account has been suspended please contact our admin for more information.</div>';
		echo  '<div class="col-md-12 text-center isa_error" style="width:600px;">'.$loginError.'</div>';
	}
	else {
		$loginError = 'Wrong user details, or inactive account';
		echo '<script>self.location=\'index.php?pg=login&error=' . $loginError . '\'</script>';
	}	
	
	
}

else 
	{				
	$loginError = $_REQUEST['error'];
	
	if(!empty($_REQUEST['error']) && strlen(trim($_REQUEST['error']))>0)
		echo '<div class="col-md-12 text-center isa_error">'.$loginError.'</div>';
	?>	
    
    
    
	<form class="form"  method="post" action=""  id="login-nav">
        <div class="form-group">
            <label class="sr-only" for="exampleInputEmail2">Email address</label>
            <input type="email" class="form-control" name="emailadd" placeholder="Email address" required>
        </div>
        <div class="form-group">
            <label class="sr-only" for="exampleInputPassword2">Password</label>
            <input type="password" class="form-control" name="passwd" placeholder="Password" required>
        </div>
       
        <div class="form-group text-center">
        	<input type="submit" value="Login" name="submitThis" class="btn btn-success" />
        </div>
	</form>
    
    <div class="col-md-12 text-center">
    	<p><a href="index.php?pg=pwd">Forgot Password</a>
        <p><a href="index.php?pg=reg">Not account yet? Register</a>
    </div>
    
    <?php
	}
	?>

</div>