<?php 
$playerId = MYID;

//echo "Player ID :",$playerId;

$status1="Won";
$status2="draw";
$status3="Lose";
$status4="cancelled";

$win = playModel::gameSummaryByWin($playerId, $status1);

$win2 = playModel::gameSummaryByWin2($playerId, $status1);

$draw = playModel::gameSummaryByDraw($playerId, $status2);
$draw2 = playModel::gameSummaryByWin2($playerId, $status2);


$loose = playModel::gameSummaryByLose($playerId, $status3);
$loose2 = playModel::gameSummaryByWin2($playerId, $status3);


//

$win1 = (count($win2) + count($win));

$draw1  =(count($draw2)+count($draw));
$myloose =(count($loose2)+count($loose));



?>

<div class="table-responsive">
  <table class="table">
    <thead>
      <tr>
        <th scope="col">Won</th>
        <th scope="col">Draw</th>
        <th scope="col">Lose</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td><strong><?php echo $win1;?></strong></td>
        <td><strong><?php echo $draw1;?></strong></td>
        <td><strong><?php echo $myloose;?></strong></td>
      </tr>
      
    </tbody>
  </table>
</div>