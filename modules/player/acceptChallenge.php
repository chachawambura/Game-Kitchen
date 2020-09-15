<?php 
echo $gid;
$row =  dashboardModel::getGamingDetailsById($gid);
$stake1 =  $stake;
//echo "stake  ::: ", $row->player1_stake;
echo  playModel::acceptDirectChallenge($gid, $row->player1_stake, $row->player_2);
//print_r($row);
?>