<div class="">
<table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
  <thead>
    <tr>
      <th class="th-sm">Game</th>
      <th class="th-sm">Player 1</th>
      <th class="th-sm">Player 2 </th>
      <th class="th-sm">Total Stake</th>
      <th class="th-sm">Dispute ID</th>
      <th class="th-sm">Prize</th>
      <th class="th-sm">Dispute Date</th>
      <th class="th-sm">Reward Dispute</th>
    </tr>
  </thead>
  <tbody>
 <?php

  $gameslList = dashboardModel::listAllGamesByAdmin();
  if(count($gameslList) < 1 ):
      echo '<div class="col-md-12 isa_warning text-center">There are no games</div>';
      else:
      	
      foreach($gameslList as $mygameList)
      {
      	$gId = $mygameList->id;
      	$getplayerId = $mygameList->player_1;
      	$getplayerId2 = $mygameList->player_2;
      	$totalstake = ($mygameList->player1_stake + $mygameList->player2_stake);
      	$gamingTake = (15/100*$totalstake);
      	$prizze = ($totalstake-$gamingTake);
      	$status1 =$mygameList->player_1_result;
      	$status2 =$mygameList->player_2_result;
      	$winst = $mygameList->win_status;
      	if($player2->emailadd==NULL){
      		$opp=$player1->emailadd;
      	}else{
      		$opp= $player2->emailadd;
      	}
      	
      	//check winner
      	$oneplay = playModel::oneplayer1Details($getplayerId, $gId);
      
      	if($getplayerId ==$oneplay->player_1){
      		//echo  $oneplay->win_status=="Yes" || $twplay->win_status=="No";
      	}
      	$twplay =  playModel::oneplayer2Details($getplayerId2, $gId);
      	
      	if($getplayerId2 ==$twplay->player_2){
      		
      	}
      	if($status1=="No" && $status2=="No" && $oneplay->win_status == "pending" && $twplay->win_status =="pending"){
      		$awardstatus ='<strong><a href="index.php?acc=share_the_award&gameId='.$mygameList->id.'">Share Award</a></strong>';
      	}else if ($status1 == "Yes" && $status2=="Yes" && $winst=="pending" ){
      		$awardstatus = '<strong><a href="index.php?acc=show-dispute&gameId='.$mygameList->id.'">Dispute Award</a></strong>';
      	}else if ($status1 == "Yes" && $status2=="Yes" && $winst=="awarded" ){
      		$awardstatus= "<strong>Dispute Awarded</strong>";
      	} else if ($oneplay->win_status == "draw" && $twplay->win_status=="draw" ){
      		$awardstatus ="<strong><a href='#'>Already Awarded</a></strong>";
      	}
        $userN =	userModel::userDetails($getplayerId);
        $player2 =	userModel::userDetails($getplayerId2);
        $fullnames = $userN->fname. " ".$userN->lname;
        $fullnames2 = $player2->fname. " ".$player2->lname;
        //print_r($userN);
        if($status1=="Yes" && $status2=="Yes"){
      	echo '<tr>
        <td><a href="index.php?acc=gamehistory&gameId='.$mygameList->id.'">'.$mygameList->id.'</a></td>'
      	. '<td>'.$fullnames.'</td>'
      	. '<td>'.$fullnames2.'</td>'
        . '<td>'.$totalstake.'</td>'
        . '<td>'.$gamingTake.'</td>'
      	. '<td>'.$prizze.'</td>'
  	    . '<td>'.$mygameList->date_created.'</td>'
        . '<td>'.$awardstatus.'</td>
         </tr>';
        }else if($status1=="No" && $status2=="No"){
        	echo '
                <tr>
        <td><a href="index.php?acc=gamehistory&gameId='.$mygameList->id.'">'.$mygameList->id.'</a></td>'
  		. '<td>'.$userN->emailadd.'</td>'
      	. '<td>'.$player2->emailadd.'</td>'
        . '<td>'.$totalstake.'</td>'
        . '<td>'.$gamingTake.'</td>'
      	. '<td>'.$prizze.'</td>'
  	    . '<td>'.$mygameList->date_created.'</td>'
        . '<td>'.$awardstatus.'</td>
         </tr>
                ';
        }
      }
      endif;
   ?>
  </tbody>
  </table>	
</div>