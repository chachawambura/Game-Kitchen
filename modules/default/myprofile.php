<?php 
$win="Won";
$loose ='No';
$resultc1 ='No';
$resultc2 ='No';
$games = userModel::userDetails(MYID);
//print_r($games);



$winn = playModel::listMyGameHistoryByWin(MYID , $win);

//echo "Latest ::: ",count($winn);
$looseList = playModel::listMyGameHistoryByWin(MYID , $loose);

$draw =  playModel::listMyGameHistoryByWin(MYID , $resultc1, $resultc2);

$gamesList = playModel::listMyGameHistoryByPlayerID(MYID);

echo 'Size',sizeof($gamesList);

foreach ($gamesList as $game){
	
	
}

$totalgames = count($gamesList);

if(isset($_POST['submitUpdate']) && $_POST['submitUpdate'] == "Update Now")
{
	
	echo dashboardModel::updateGamerTagNow( $_POST );
}

?>
<h3 class="sub-title text-center">My Profile Details</h3>
<form class="form" role="form" method="post" action="index.php?pg=myprofile"  id="signup-nav">
    <div class="col-md-12 form-group">
    	<div class="col-md-6">
            <label class="sr-only" for="exampleInputEmail2">First Name</label>
            <input type="text" class="form-control" name="fname" placeholder="First Name" required value="<?php echo $games->fname; ?>" readonly>
            
            <input type="text" class="form-control" name="playerId" required value="<?php echo MYID?>" readonly>
   		</div>
        <div class="col-md-6">
            <label class="sr-only" for="exampleInputEmail2">Last Name</label>
            <input type="text" class="form-control" name="lname" placeholder="Last Name" required value="<?php echo $games->lname;  ?>" readonly>
        </div>   
    </div>
 
    <div class="col-md-12 form-group">
       	<div class="col-md-6">
            <label class="sr-only" for="exampleInputEmail2">Email address</label>
            <input type="email" class="form-control" name="emailadd" placeholder="Valid Email address" required value="<?php echo $games->emailadd; ?>" readonly>
    	</div>
        <div class="col-md-6">
            <label class="sr-only" for="exampleInputPassword2">Phone</label>
            <input type="tel" class="form-control" name="phoneno" placeholder="Phone number 07xx yyy zzzz" required value="<?php  echo $games->phoneno;  ?>" readonly>
        </div>
    </div>
   
      <div class="col-md-12 form-group">
        <div class="col-md-4">
            <label class="sr-only" for="exampleInputPassword2">Alias</label>
            <input type="text" class="form-control" name="alias" placeholder="Name Alias" value="<?php echo $games->alias; ?>" >
        </div>
        <div class="col-md-4">
            <label class="sr-only" for="exampleInputPassword2">Console</label>
        <select class="mdb-select md-form" name="consoleId">
       <option value="" disabled selected><?php echo $games->consoleId;?></option>
       
        </select>
        </div>
        <div class="col-md-4">
            <label class="sr-only" for="exampleInputPassword2">Game Tag</label>
            <input type="text" class="form-control" name="tagNamic" placeholder="Gamer Tag" value="<?php echo $games->nametag; ?>" >
            
        </div>
        
      
    </div>
    
    <div class="col-md-12 form-group">
    	<div class="col-md-12 text-center">
       		<input type="submit" name="submitUpdate"  class="btn btn-success" value="Update Now"/>
            
    	</div>
    </div>
    
  
</form>