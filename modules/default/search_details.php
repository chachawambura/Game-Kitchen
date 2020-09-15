<?php 
//echo $gid;

$tList3 = userModel::userDetails(MYID);

$tList3->active;

$suspendstatus =$tList3->suspend_Status;

$getEmail = $tList3->emailadd;

$joingameId = $_REQUEST['searchplayerId'];
//print_r($tList3);

$play = playModel::searchPlayerByAlias();

$cuus= $tList3->alias;

$clickSeachButton = false;
if ($_POST['submitSearchPlayerButton'] == 'Search Player') {
	if(preg_match("/[A-Z  | a-z]+/", $_POST['alias'])){ 
	$aliasName = $_POST['alias'];
	$clickSeachButton = true;
	if(!($aliasName==$cuus)){
	echo playModel::searchPlayerByAlias($aliasName);
	}else {
	    $message ='<strong><p>You are not allowed to search yourself </p></strong>';
	}
	}else {
		
		$message ='<strong><p>Please enter a search query</strong></strong>';
	}
	
}
	
//print_r($play);

?>
 
          <?php if($tList3->active==1) {?>
<div class="col-md-2"></div>   
  <div class="col-md-8">
   <form class="form-inline" role="form"  method="post" action="index.php"  id="signup-nav2">
   
   <input type="hidden" name="userId" class="form-control" value="<?php echo MYID?>" />
   <div class="col-md-3">
     <input type="text" name="alias" class="form-control" placeholder="Enter Alias" />
     <?php echo "$message"?>
   </div>
   <div>
   <input type="hidden" name="player_email" class="form-control" value="<?php echo $myemail?>" />
   </div>
   <div class="col-md-4" id="showMe" style="display:block;">
   <?php 
   $getstatus='0';
   $gamesList = playModel::listActiveGames(MYID, $getstatus);
   $gettotal = count($gamesList);
   if($gettotal==0){
	   if($suspendstatus==1) {
		   echo '<input type="submit" name="submitNN" style="width:320px;" class="btn btn-success" value="Search Player" />';
	   }else if($suspendstatus==2) {
		   
	   }else {
	  echo '<input type="submit" name="submitSearchPlayerButton" style="width:320px;" class="btn btn-success" value="Search Player" />'; 
	   }
   }else {
	  echo '<input type="submit" name="submitSearchPlayerButton" class="btn btn-success" value="Active Game Exists" />'; 
   }
    ?>
   
   </div>  
   
   <div  class="col-md-2" id="dvPassport" style="display: none">
   
   
  
    </div> 
     <?php if($clickSeachButton==true){?>   
   <?php // include 'available_games.php'; ?>
    <?php }?>
    <div class="col-md-1"></div>
   
   </form>
   </div>
   <?php }else {?>
    <!-- account suspended -->
   
   <?php }?>
  