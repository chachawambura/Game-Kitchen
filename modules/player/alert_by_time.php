<?php 
$gameslList = dashboardModel::gamingNotificationList();

//print_r($gameslList);

foreach($gameslList as $mygameList)
{
    $gameId = $mygameList->game_id;
    $currentgameId = baseModel::gameDetails($gameId);
    $status = $mygameList->game_status;
    $alertme = date("H:i:s",strtotime($mygameList->alert_time));
    $endtime = date("H:i:s",strtotime($mygameList->end_time));
    $currenttime = date("H:i:s");
    $player1 = $currentgameId->player_1;
    $player2 = $currentgameId->player_2;
    $award = $currentgameId->win_status;
    if($currenttime > $alertme && $currenttime< $endtime){
        if($player1!=NULL && $player2=="NULL" && $status==0){
            echo playModel::alertPlayer1($player1, $gameId, $status);
        }else if($status==0) {
            echo playModel::alertBothPlayers($player1, $player2,  $gameId, $status);
       }
    // echo 'past time alert now';
    }else if($currenttime < $alertme  && $currenttime< $endtime && $status==0){
       
       // echo 'before alert time ....';
        
    }else if($currenttime > $alertme && $currenttime > $endtime && $status==0){
      // echo 'cannot send alert coz time is past.';
    }
    
	
}

?>