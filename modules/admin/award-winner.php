<?php 
//echo $gameId; 
$talz = playModel::getMyGameIdAward($gameId);

$pl1 = $talz->player_1;
$opp = userModel::userDetails($pl1);
$alias1 = $opp->alias;
$fname1 =$opp->fname;
$pl2 = $talz->player_2;
$opp = userModel::userDetails($pl2);
$alias2 = $opp->alias;
$fname2 =$opp->fname;
$ply1result = $talz->player_1_result;
$ply2result = $talz->player_2_result;
$prize = ($talz->player1_stake*2);
$gmtake = 15/100 *$prize;

$finzz =$prize - $gmtake;
//echo $finzz;

?>
<?php 
if(isset($_POST['submitAward1']) && $_POST['submitAward1'] == "Award Player 1")
{
echo playModel::submitAward1($_POST);
}else if (isset($_POST['submitDispute']) && $_POST['submitDispute'] == "Its a dispute")
{	
	echo playModel::submitDispute($_POST);
}else if (isset($_POST['submitDispute2']) && $_POST['submitDispute2'] == "Its a dispute")
{	
	echo playModel::submitDispute2($_POST);
	
}else if (isset($_POST['submitAward2']) && $_POST['submitAward2'] == "A ward Player 2")
{
	echo playModel::submitAward2($_POST);
}
?>

 <form class="form" role="form" method="post" action="index.php?acc=award-winner" id="signup-nav2">
  <input type="hidden" class="form-control" name="gameId" value="<?php echo $gameId?>"/>
  
   <input type="hidden" class="form-control" name="player1Id" value="<?php echo $pl1?>"/>
   
   <input type="hidden" class="form-control" name="alias1" value="<?php echo $alias1?>"/>
   
   <input type="hidden" class="form-control" name="fname1" value="<?php echo $fname1?>"/>
   
   <input type="hidden" class="form-control" name="fname2" value="<?php echo $fname2?>"/>
   
   <input type="hidden" class="form-control" name="alias2" value="<?php echo $alias2 ?>"/>
   
   
   <input type="hidden" class="form-control" name="player2Id" value="<?php echo $pl2?>"/>
  
  <input type="hidden" class="form-control" name="prizeId" value="<?php echo $finzz?>"/>
  
 
 
 <?php 
 if($ply1result=="Yes" && $ply2result=="No" ){
 	echo '<input type="submit" name="submitAward1" class="btn btn-success" value="Award Player 1" />';
 }else if ($ply1result=='Yes' && $ply2result=='Yes' ){
 	echo "dispute";
 	echo '<input type="submit" name="submitDispute" class="btn btn-success" value="Its a dispute" />';
 }else if($ply1result=='No' && $ply2result=='No' ){
 	
 	echo '<input type="submit" name="submitDispute2" class="btn btn-success" value="Draw" />';
 	
 }else if ($ply1result=='No' && $ply2result=='Yes' ){
 	
 	echo '<input type="submit" name="submitAward2" class="btn btn-success" value="A ward Player 2" />';
 	
 }
 
 
 ?>
 
 </form>
