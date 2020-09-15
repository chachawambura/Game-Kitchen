<?php 
$arr_browsers = ["Opera", "Edge", "Chrome", "Safari", "Firefox", "MSIE", "Trident"];
$agent = $_SERVER['HTTP_USER_AGENT'];

$user_browser = '';
foreach ($arr_browsers as $browser) {
    if (strpos($agent, $browser) !== false) {
        $user_browser = $browser;
        break;
    }
}

switch ($user_browser) {
    case 'MSIE':
        $user_browser = 'Internet Explorer';
        break;
        
    case 'Trident':
        $user_browser = 'Internet Explorer';
        break;
        
    case 'Edge':
        $user_browser = 'Microsoft Edge';
        break;
}

?>

<?php 

$talz = playModel::getMyGameIdAward($gameId);
$pl1 = $talz->player_1;
$pl2 = $talz->player_2;
$ply1result = $talz->player_1_result;
$ply2result = $talz->player_2_result;
$prize = ($talz->player1_stake*2);
$gmtake = 15/100 *$prize;
$award= $talz->win_status;


$finzz =$prize - $gmtake;
//echo $finzz;
//echo $gameId;
$sdispute = playModel::showAllDesputedGame($gameId);
$play1 = $sdispute->playerId;
$status = $sdispute->dispute_status;

$tList1 = userModel::userDetails($play1);

//player 2
$sdispute2 = playModel::showAllDesputed2Game($gameId);

$play2 = $sdispute2->playerId;

$status2 = $sdispute2->dispute_status;

$tList2 = userModel::userDetails($play2);


//print_r($sdispute);

$file = GAMES_ICONS_FOLDER . $sdispute->img_icon ;

$img = is_file( $file ) ? $file : NO_IMAGE ;

$file1 = $sdispute->disputeImage;

//echo "File 1 ",$file1;
$allowed = array('.jpg','.jpeg','.gif','.png','.flv');
if (!in_array(strtolower(strrchr($file1, '.')), $allowed)) {
    if($user_browser  != 'Chrome') {
        $image ='use chrome';
    }else {
        
        $image = '
    
<video width="300" height="200" controls>
	<source src="mydispute_1/'.$sdispute->disputeImage.'" type="video/mp4">
	</video>
    
';
        
        
    }
 
}else {
	$image = is_file($img) ? '<img src="mydispute_1/'.$sdispute->disputeImage.'" align="left" >' : '';
}


$file2 = GAMES_ICONS_FOLDER . $sdispute2->img_icon ;

$img = is_file( $file2 ) ? $file2 : NO_IMAGE ;

$file22 = $sdispute2->disputeImage;
$allowed = array('.jpg','.jpeg','.gif','.png','.flv');
if (!in_array(strtolower(strrchr($file22, '.')), $allowed)) {
    
   
	$image2='<video width="320" height="240" controls>
  <source src="mydispute_2/'.$sdispute2->disputeImage.'" type="video/mp4">
  Your browser does not support the video tag.
</video>';
    
}else if($user_browser  == 'Chrome' || $user_browser  == 'Firefox') {
	$image2 = is_file($img) ? '<img src="mydispute_2/'.$sdispute2->disputeImage.'" align="left" >' : '';
}


?>
<h2 class="subhead"><?php echo $tr->title; ?></h2>
<div class="col-md-3"><?php echo $image; ?></div>

<div class="col-md-3"><?php echo $image2; ?></div>
<?php 
if(isset($_POST['awardNow']) && $_POST['awardNow'])
{
		
echo playModel::adminSubmitWinner($_POST);
		
}else if(isset($_POST['awardNow2']) && $_POST['awardNow2'])
{
	
	echo playModel::adminSubmitWinner2($_POST);
}else if (isset($_POST['shareMyAward']) && $_POST['shareMyAward']){
	
	echo playModel::awardAllPlayersNow($_POST);
}
$pl1 = $tList1->alias;
$pl2 = $tList2->alias;

?>

<div class="col-md-6">
 <form class="form" role="form" method="post" action="index.php?acc=show-dispute&gameId" id="signup-nav2">
 <div class="col-md-3 form-group">
    <input type="hidden" name="myGameId" value="<?php echo $gameId;?>">
    
    <input type="hidden" class="form-control" name="prizeId" value="<?php echo $finzz?>"/>
    
    </div>
   <div class="col-md-3">
    <input type="hidden" name="player1Id" value="<?php echo $play1?>">
    
    <input type="hidden" name="player2Id" value="<?php echo $play2?>">
 </div>
 <div class="col-md-4">
  <label class="sr-only" for="exampleInputPassword2">Winner</label>
  <?php 
  if($award=="awarded"){
  	$pl1 = "Awarded";
  	$pl2 = "Awarded";
  }else{
  	$pl1 = $tList1->alias;
  	$pl2 = $tList2->alias;
  	}
  $share = "Share Award";
  ?>
  <?php if($user_browser  == 'Chrome') { ?>
 <input type="submit" name="awardNow" class="btn btn-success"  value="<?php echo "Award ",$pl1;?>"/>
 <input type="submit" name="awardNow2" class="btn btn-success" value="<?php echo "Award ", $pl2;?>"/>
 <input type="submit" name="shareMyAward" class="btn btn-success" value="<?php echo  $share;?>"/>
  <?php }else if($user_browser  == 'Firefox') { ?>
 <input type="submit" name="awardNow" class="btn btn-success"  value="<?php echo "Award ",$pl1;?>"/>
 <input type="submit" name="awardNow2" class="btn btn-success" value="<?php echo "Award ", $pl2;?>"/>
 <input type="submit" name="shareMyAward" class="btn btn-success" value="<?php echo  $share;?>"/>
 <?php } ?>
 </div>
 </form>
</div>