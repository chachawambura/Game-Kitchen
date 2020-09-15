<?php 
echo $gameId;
$talz = playModel::getMyGameIdAward($gameId);
$pl1 = $talz->player_1;
$pl2 = $talz->player_2;
$ply1result = $talz->player_1_result;
$ply2result = $talz->player_2_result;
$prize = ($talz->player1_stake*2);
$gmtake = 15/100 *$prize;

$finzz =$prize - $gmtake;

$sharec = ($finzz/2);

if(isset($_POST['awardBothPlayers']) && $_POST['awardBothPlayers'])
{
	echo  adminModel::shareAward( $_POST );
}
?>
<form class="form" role="form" method="post" action="index.php?acc=share_the_award" id="signup-nav2">
<input type="hidden" name="player1Id" class="form-control" value="<?php echo $pl1;?>">
<input type="hidden" name="player2Id" class="form-control" value="<?php echo $pl2;?>">
<input type="hidden" name="myGameId" class="form-control" value="<?php echo $gameId;?>">
<input type="hidden" class="form-control" name="prizeId" value="<?php echo $sharec?>"/>

<input type="submit" name="awardBothPlayers" class="btn btn-success" value="Award Now"/>
</form>