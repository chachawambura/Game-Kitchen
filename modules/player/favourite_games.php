<?php 
$gamesList = playModel::showAllMyFavouriteGames($gid);

//print_r($gamesList);
?>
<table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
  <thead>
    <tr>
      <th class="th-sm">Date & Time</th>
      <th class="th-sm">Game</th>
      <th class="th-sm">Status</th>
    </tr>
  </thead>
  <tbody>
  <?php 
  
  if(count($gamesList) < 1 ):
  echo '<div class="col-md-12 isa_warning text-center">There are no games</div>';
  else:
  
  foreach($gamesList as $game)
  {
  	$categId = $game->gamecategory_id;
  	$tes = dashboardModel::getGameByCategoryId($categId);
  	echo '<tr>
            <td>'.$game->date_created.'</td>'
		    . '<td>'.$tes->gametitle.'</td>'
      		. '<td>'.$game->player1_stake.'</td></tr>';
  	}
  
  endif;
  ?>
  </tbody>
  </table>

