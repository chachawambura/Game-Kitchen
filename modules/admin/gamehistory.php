<?php 
//echo $gameId;
$row = baseModel::gameDetails($gameId);
$dtz = dashboardModel::getGamingDetailsById($gameId);

$getRewardId = playModel::oneplayer1Details(MYID, $gameId);

$getRewardId2 = playModel::oneplayer2Details(MYID, $gameId);
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
    <div class="col-md-6"><label>Star Level</label> <?php echo $dtz->gmlevel; ?></div>
    <div class="col-md-6"><label>Period</label> <?php echo $dtz->gmperiod; ?></div>
    <div class="col-md-6"><label>Console Type</label> <?php echo $dtz->gmconsole; ?></div>
</div>
<?php 
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
	      
	      
	     
	      
	      
	      <strong>
	      <a href="#" class="btn btn-success"><?php echo "Game ", $row->win_status;?></a>
	      <a href="<?php echo $urls; ?>" class="btn btn-success">Back to Games</a></strong>
	      </form>
	       
         </div>
        
         

</div>