<?php

$row = baseModel::gameDetails($gid);


$dtz = dashboardModel::getGamingDetailsById($gid);

$getRewardId = playModel::oneplayer1Details(MYID, $gid);

$getRewardId2 = playModel::oneplayer2Details(MYID, $gid);

//print_r($getRewardId);
$playy1 = $getRewardId->player_1;
$playy2 = $getRewardId2->player_2;
$result1 = $getRewardId->player_result;
$result2 = $getRewardId2->player_result;

$getEmail = userModel::userDetails(MYID);
$exactEm = $getEmail->emailadd;
$getfname = $getEmail->fname;
if($playy1==MYID){
	$win_status = $getRewardId->win_status;
	$exactEm;
	$getfname;
	$opp = userModel::userDetails($row->player_2);
	$opname =$opp->fname;
    $gametag = $opp->nametag;
}else if($playy2==MYID){
	$opp = userModel::userDetails($row->player_1);
	$opname = $opp->fname;
	$gametag = $opp->nametag;
	$exactEm;
	$getfname;
	$win_status2 = $getRewardId2->win_status;
	
	
}

if($row->player_2 !="NULL"){
	
	$mygamerTag ="<label>Gamer Tag :</label> <strong>$gametag</strong>";
}else{
	
	$mygamerTag="<strong> No Opponent yet </strong> ";
}

$tr = dashboardModel::getGameByCategoryId($row->gamecategory_id);
//echo $tr;
$file = GAMES_ICONS_FOLDER . $row->img_icon ;

$img = is_file( $file ) ? $file : NO_IMAGE ;

$image = is_file($img) ? '<img src="upload/'.$tr->gameImage.'" align="left" >' : '';
$getplayer1 =($row->player1_stake)*2;
$cal =$getplayer1-(15/100*$getplayer1);
//echo $cal;
//echo "100";
?>
<h2 class="subhead"><?php echo $row->title; ?></h2>
<div class="col-md-3"><?php echo $image; ?></div>

<div class="col-md-9">
	<div class="col-md-6"><label>Category</label> <?php echo $tr->gametitle ?></div>
	<div class="col-md-6"><label>Prize</label> <?php echo $cal; ?></div>
	<div class="col-md-6"><label>Entry Fee</label> <?php echo $row->player1_stake; ?></div>
	<div class="col-md-6"><label>Date</label> <?php echo $row->date_created; ?></div>
	<?php 
	if($dtz->gmlevel=="None") {
	   $league ='League';
	   $lresult= $dtz->game_league;
	}else{
	    $league ='Period'; 
	    $lresult = $dtz->gmperiod;
	    $starl ='Star Level';
	    $startll = $dtz->gmlevel;
	}
	
	?>
    <div class="col-md-6"><label><?php echo $starl;?></label> <?php echo $startll; ?></div>
    <div class="col-md-6">
    <label><?php echo $league; ?></label> <?php echo $lresult; ?>
    
    </div>
    <div class="col-md-6"><label>Console Type</label> <?php echo $dtz->gmconsole; ?></div>
    <div class="col-md-6"><?php echo $mygamerTag?></div>
</div>
<?php 
if($row->player1_stake > $balance){
	$joinNow ='<a href="index.php?pg=deposit" class="btn btn-success">Top Up </a></strong>';
}else{
	$joinNow = '<input type="submit" name="submitJoinGame" class="btn btn-success" value="Join Now" /></strong>';
}
if(isset($_POST['submitJoinGame']) && $_POST['submitJoinGame'] == "Join Now")
{
	echo playModel::joinMyGame($_POST);	
}
if(isset($_POST['submitCancelGame']) && $_POST['submitCancelGame'] == "Cancel Game"){
	
	//echo playModel::cancelMyGame($_POST);	
	
	return;
	
}
//$cancel = playModel::cancelMyGame( $gid );
include_once 'automatic.php';
include_once 'win_by_time.php';
include_once 'alert_by_time.php';
?>
<div class="col-md-12 text-center">
       
	      <div id="tohide">
	      <form class="form" role="form" method="post" action="index.php?acc=games&page=details&gid" id="signup-nav2">
	     
	      <input type="hidden" class="form-control" name="gameTag" value="<?php echo $gametag?>"/>
	      
	      <input type="hidden" class="form-control" name="opponentName" value="<?php echo $opname?>"/>
	      <input type="hidden" class="form-control" name="player_email" value="<?php echo $exactEm?>"/>
	      <input type="hidden" class="form-control" name="playername" value="<?php echo $getfname?>"/>
	      
	      <input type="hidden" class="form-control" name="gameId" value="<?php echo $gid?>"/>
	      
	      <input type="hidden" class="form-control" name="mystakeId" value="<?php echo $row->player1_stake;?>"/>
	      
	      <input type="hidden" class="form-control" name="playerId" value="<?php echo MYID?>"/>
	      
	      <input type="hidden" class="form-control" name="creatorId" value="<?php echo $dtz->player_1?>"/>
	      
	      
	      <?php 
	      $tf = $row->game_status;
	      $play1 = $row->player_1;
	     
	      $play2 = $row->player_2;
	      $shdis = playModel::showDesputedGameByPlayerId(MYID, $gid);
	      $shdis1= playModel::showDesputed1GameByPlayerId(MYID, $gid);
	      $pl1dis = $shdis->playerId;
	      $pl2dis = $shdis1->playerId;
	      if($play2==$pl1dis && MYID==$play2){
	      $bla= $shdis->dispute_status;
	      }else if($play1==$pl2dis && MYID==$play1){
	      $bla= $shdis1->dispute_status;
	      }
	     
	      //print_r($shdis);
	      $cancelled = $row->cancellation_status;
	      //echo $cancelled;
	      $play1_result= $row->player_1_result;
	      $play2_result= $row->player_2_result;
	      if(MYID==$play1 && $play1_result=="No" && $play2_result=="No" && $bla !="dispute" && $bla !="Lose" ){
	      	//echo "dispute 1";
	      	echo '<strong><a href="#" class="btn btn-success">Draw</a></strong>';
	      }else if(MYID==$play2 && $play1_result=="No" && $play2_result=="No" && $bla !="dispute" && $bla !="Won"){
	      	//echo "dispute 2 no no";
	      	echo '<strong><a href="#" class="btn btn-success">Draw</a></strong>';
	      }else if(MYID==$play1 && $play1_result=="Yes" && $play2_result=="Yes" && $bla !="dispute" && $bla !="Won" ){
	      	//echo "dispute 1 yes yes ";
	      	echo '<strong><a href="'.$urls.'&page=player1_dispute2&currentgameId='.$row->id.'" class="btn btn-success">Dispute</a></strong>';
	      }else if(MYID==$play2 && $play1_result=="Yes" && $play2_result=="Yes" && $bla!="dispute" && $bla !="Lose" ){
	      	//echo "dispute 2 yes yes ";
	      	echo '<strong><a href="'.$urls.'&page=player2_dispute2&currentgameId='.$row->id.'" class="btn btn-success">Dispute</a></strong>';
	      }else if(MYID==$play2 && $play1_result=="Yes" && $play2_result=="Yes" && $bla =="dispute" ){
	      	echo '<strong><a href="#" class="btn btn-success">Evidence Submitted</a></strong>';
	      }else if(MYID==$play1 && $play1_result=="Yes" && $play2_result=="Yes" && $bla =="dispute"){
	      	echo '<strong><a href="#" class="btn btn-success">Evidence Submitted</a></strong>';
	      }else if (MYID==$play1 && $play1_result=="No" && $play2_result=="No" && $bla =="dispute"){
	      	echo '<strong><a href="#" class="btn btn-success">Evidence Submitted</a></strong>';
	      }else if(MYID==$play2 && $play1_result=="No" && $play2_result=="No" && $bla =="dispute"){
	      	echo '<strong><a href="#" class="btn btn-success">Evidence Submitted</a></strong>';
	      }else if(MYID==$play1 && $play1_result=="NULL" && $row->win_status=="awarded"){
	      	echo '<strong><a href="#" class="btn btn-success">Game Cancelled</a></strong>';
	      
	      }else if(MYID==$play2 && $row->player2_stake==0){
	      	echo '<strong><a href="#" class="btn btn-success">Waiting direct Acceptance</a></strong>';
	      }
	      //echo MYID;
	      if(MYID==$play1 && MYID !=$play2 && $tf==0){
	      	//echo 'cancel game';
	      }else if(MYID !=$play1 && MYID !=$play2 && $tf==0){
	      	
	      	//echo 'join game';
	      }else if(MYID==$play1 && $play2 != NULL && $tf==1 && $play1_result == "NULL" ){
	      	//echo 'claim now player 1 ';
	      }else if(MYID==$play2 && $play1 !=NULL && $tf==1 && $play2_result == "NULL"){
	      	//echo "claim by player 2";
	      }else if(MYID==$play1 && $play2 != NULL && $tf==1 && $play1_result != "NULL" ){
	      	//echo 'claim now player 1 already claimed ';
	      }else if(MYID==$play2 && $play1 !=NULL && $tf==1 && $play2_result != "NULL"){
	      	//echo "claim by player 2 already claimed";
	      } else if(MYID==$play1 && $play1_result=='Yes'){
	      	echo "Won 1";
	      }else if(MYID==$play2 && $play2_result=="No"){
	      	
	      	echo "Won 2";
	      }
	      
	      
	      //echo "<br/>";
	     // echo "player II", $play2;
	    // echo $tf;
	      if($balance < MIN_BALANCE_FEE || $balance < $row->entry_fee ){
	      	echo '<strong><div class="text-center isa_error">Your current balance is low. Please top up to play</div></strong>';
	      }else if(MYID==$play1 && MYID !=$play2 && $tf==0 && $cancelled !="cancelled"){
	      	echo '<strong><a href="'.$urls.'&page=cancel_mygame&currentgameId='.$row->id.'" class="btn btn-success">Cancel Game</a></strong>';
	      	//echo '<a href="'.$cancel.'">Cancel Game</a>';
	      }else if(MYID==$play1 && MYID !=$play2 && $tf==0 && $cancelled =="cancelled"){
	      	echo '<strong><a href="#" class="btn btn-success">Game Cancelled</a></strong>';
	      }else if(MYID !=$play1 && MYID !=$play2 && $tf==0 && $cancelled !="cancelled"){
	      	echo $joinNow;
	      }else if(MYID !=$play1 && MYID !=$play2 && $tf==0 && $cancelled == "cancelled"){
	      	echo '<strong><a href="#" class="btn btn-success">Game Cancelled</a></strong>';
	      }else if(MYID==$play1 && $play2 != NULL && $tf==1 && $play1_result == "NULL" && $row->win_status=="pending" ){
	      	echo '<strong><a href="'.$urls.'&page=player1_prize&currentgameId='.$row->id.'" class="btn btn-success">Claim Prize</a></strong>';
	      }else if(MYID==$play2 && $play1 !=NULL && $tf==1 && $play2_result == "NULL" && $row->win_status=="pending"){
	      	echo '<strong><a href="'.$urls.'&page=player2_prize&currentgameId='.$row->id.'" class="btn btn-success">Claim Prize</a></strong>';
	      
	      }else if(MYID==$play1 && $play2 != NULL && $tf==1 && $play1_result == "Yes" 
	      		&& $win_status=="pending"  ){
	      	//echo '<strong><a href="#" class="btn btn-success">Waiting Outcome 6</a></strong>';
	      }else if(MYID==$play1 && $play2 != NULL && $tf==1 && $play1_result == "Yes" && $play2_result == "No" && $win_status=="pending"){
	      	echo '<strong><a href="#" class="btn btn-success">Waiting Outcome </a></strong>';
	      }else if(MYID==$play1 && $play2 != NULL && $tf==1 && $play1_result == "No" && $win_status=="pending"){
	      	echo '<strong><a href="#" class="btn btn-success">Waiting Outcome </a></strong>';
	      }else if(MYID==$play2 && $play1 != NULL && $tf==1 && $play2_result == "Yes" && $play1_result=="No" && $win_status2=="pending"){
	      	echo '<strong><a href="#" class="btn btn-success">Waiting Outcome</a></strong>';
	      }else if(MYID==$play2 && $play1 != NULL && $tf==1 && $play2_result == "Yes" && $play1_result=="No" && $win_status2=="Won"){
	      	echo '<strong><a href="#" class="btn btn-success">Won</a></strong>';
	      }else if(MYID==$play2 && $play1 != NULL && $tf==1 && $play2_result == "No" && $play1_result=="No" && $bla =="dispute"){
	      	echo '<strong><a href="#" class="btn btn-success">Waiting Outcome  </a></strong>';
	      }else if(MYID==$play2 && $play1 != NULL && $tf==1 && $play2_result == "Yes" && $play1_result == "NULL"  && $win_status2=="pending"){
	      	echo '<strong><a href="#" class="btn btn-success">Waiting Outcome </a></strong>';
	      }else if(MYID==$play2 && $play1 != NULL && $tf==1  &&  $play1_result == "NULL" && $result2=="No"){
	      	echo '<strong><a href="#" class="btn btn-success">Waiting Outcome</a></strong>';
	      }else if($playy1==MYID && $result1=="Yes" && $play1_result=="Yes" && $play2_result == "No" && $win_status !="pending"){
	      	echo '<strong><a href="#" class="btn btn-success">Won </a></strong>';
	      }else if($playy1==MYID && $result1=="No" && $play1_result == "No" && $win_status !="draw"){
	      	echo '<strong><a href="#" class="btn btn-success">Lose </a></strong>';
	      }else if(MYID==$play2 && $play1 != NULL && $tf==1 && $play2_result == "Yes" && $play1_result == "No"  && $win_status2=="Won"){
	      	echo '<strong><a href="#" class="btn btn-success">Won</a></strong>';
	      }else if(MYID==$play2 && $play1 !=NULL && $playy2==MYID && $win_status2=="Lose"){
	      	echo '<strong><a href="#" class="btn btn-success">Lose </a></strong>';
	      }else if($playy1==MYID && $win_status=="Won"){
	      	echo '<strong><a href="#" class="btn btn-success">Won</a></strong>';
	      }else if($row->player_1_result=="draw" || $row->player_2_result=="draw" ){
	      	echo '<strong><a href="#" class="btn btn-success">Draw</a></strong>';
	      }else if(MYID==$play2 && $row->win_status=="awarded" && $row->player_2_result=="Yes" && $row->player_1_result=="NULL"){
	      	echo '<strong><a href="#" class="btn btn-success">Won Automatic</a></strong>';
	      }else if(MYID==$play2 && $row->win_status=="awarded" && $row->player_2_result=="NULL" && $row->player_1_result=="Yes"){
	      	echo '<strong><a href="#" class="btn btn-success">Lose</a></strong>';
	      }else if(MYID==$play1 && $row->win_status=="awarded" && $row->player_1_result=="Yes" && $row->player_2_result=="NULL"){
	      	echo '<strong><a href="#" class="btn btn-success">Won Automatic</a></strong>';
	      }else if(MYID==$play1 && $row->win_status=="awarded" && $row->player_1_result=="NULL" && $row->player_2_result=="Yes"){
	      	echo '<strong><a href="#" class="btn btn-success">Lose</a></strong>';
	      }
	      ?>
	      
	      <strong><a href="<?php echo $urls; ?>" class="btn btn-success">Back to Games</a></strong>
	      </form>
	       
         </div>
        
         

</div>