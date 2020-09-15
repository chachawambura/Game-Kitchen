<?php
$userdetails = userModel::userDetails(MYID);
include_once 'alert_by_time.php';
include_once 'refreshme.php';
include '../../../search_details.php';
$status1="direct";
$balance = playModel::checkBalance(MYID);
//$myActiveGames = count(playModel::listMyCurrentActiveTournaments());
$directGameList = playModel::showDirectChallengesByStatus(MYID, $status1);
$disputeRCountList = dashboardModel::countDisputeResolution(MYID);
?>
<?php 
$getstatus='0';
$gamesList = playModel::listActiveGames(MYID, $getstatus);

$directmList = dashboardModel::listDirectMessage(MYID);
$getdirem = count($directmList);
$gettotal = count($gamesList);
if($gettotal==0){
	if($userdetails->suspend_Status==1) {
		$joinmatch ='<a href="#"><strong>Join Match</strong></a>';
		$creategame ='<a href="#"><strong>Create Match</strong></a>';
	}else {
	$joinmatch ='<a href="index.php?acc=games&page=matchmaking"><strong>Join Match</strong></a>';
	$creategame ='<a href="index.php?acc=games&page=creatematch"><strong>Create Match</strong></a>';
	}
}else {	
	$creategame ='<strong>Active Game Exists</strong>';
	$joinmatch='<strong>Game Exists</strong>';
}

?>
<?php if($userdetails->active==1) { ?>
<div class="col-md-12 console text-center">
	<div class="col-md-3">My Balance :<strong><?php echo $balance; ?></strong></div>
	<div class="col-md-3"><?php echo $joinmatch;?></div>
    <div class="col-md-3"><?php echo $creategame; ?></div>
    <div class="col-md-3"></div>
</div>


<div class="col-md-2 player-menu">
	<ul>
	<?php if($userdetails->suspend_Status==0) { ?>
    	<li><a href="index.php?acc=games&page=games-all">Previous Games</a></li>
    	<li><a href="index.php?acc=gamesactive">Active Games</a></li>
        <li><a href="index.php?acc=games&page=games-mine">Game History</a></li>
        <li><a href="index.php?acc=directgames">Direct Challenge[<?php echo count($directGameList)?>]</a></li>
        <li><a href="index.php?acc=favourites-all">My Favourites</a></li>
        <li><a href="index.php?acc=tournaments">Transaction History</a></li>
        <li><a href="index.php?acc=gamesummary">Game Summary</a></li>
        <li><a href="index.php?acc=disputeresolution">Dispute Resolution[<?php echo count($disputeRCountList)?>]</a></li>
        
        <?php }else{ ?>
        
        <li><a href="#">Previous Games</a></li>
    	<li><a href="#">Active Games</a></li>
        <li><a href="#">Game History</a></li>
        <li><a href="#">Direct Challenge[<?php echo count($directGameList)?>]</a></li>
        <li><a href="#">My Favourites</a></li>
        <li><a href="#">Transaction History</a></li>
        <li><a href="#">Game Summary</a></li>
        <li><a href="#">Dispute Resolution[<?php echo count($disputeRCountList)?>]</a></li>
       <?php } ?>
        
    </ul>
    
</div>
<?php }else{ echo 'Account Temporarily Suspended';}?>

<div class="col-md-10">

<?php
$acc = $_REQUEST['acc'];

switch($acc)
	{
	case "tournaments":
		include "tournaments" . EXT;
		break;	
	case "games":
		include "games" . EXT;
		break;
		
	case "balance":
		include "balance" . EXT;
		break;
		
	case "matchmaking":
		include "matchmaking" . EXT;
		break;
		
	case "gamesactive":
		include "gamesactive" . EXT;
		break;
		
		
	case "direct":
		include "direct" . EXT;
		break;
		
	case "directm":
		include "directm" . EXT;
		break;
		
		
	case "favourite":
		include "favourite" . EXT;
		break;
		
		
	case "favourites-all":
		include "favourites-all" . EXT;
		break;
		
	case "favouritedirectm":
		include "favouritedirectm" . EXT;
		break;
		
	 case "favouritedirectc":
		include "favouritedirectc" . EXT;
		break;
		
	 case "gamesummary":
	 	include "gamesummary" . EXT;
	 	break;
	
	
	case "favourite-games":
		include "favourite-games" . EXT;
		break;
		
	case "read":
		include "read" . EXT;
		break;
		
	case "acceptChallenge":
		include "acceptChallenge" . EXT;
		break;

	case "claim-prize":
		include "claim-prize" . EXT;
		break;
		
	case "directgames":
		include "directgames" . EXT;
		break;
		
	case "directmessage":
		include "directmessage" . EXT;
		break;
		
	 case "disputeresolution":
	    include "disputeresolution" . EXT;
	    break;
		
	
	 default:
		include "massages" . EXT;
		break;
	
	}
	
	
	


?>

</div>

