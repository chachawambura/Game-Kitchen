<?php

$gamesList = playModel::showMyFavourites(MYID);

//print_r($gamesList);
$urls = 'index.php?acc=games';

?>
<table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
  <thead>
    <tr>
    <th class="th-sm">Full Name</th>
     <th class="th-sm">Date & Time</th>
     <th class="th-sm">Direct Challenge</th>
    </tr>
  </thead>
  <tbody>
  <?php 
  
  if(count($gamesList) < 1 ):
  echo '<div class="col-md-12 isa_warning text-center">There are no games</div>';
  else:
  
  foreach($gamesList as $game)
  {
  	//$views ='<a href="index.php?acc=games&page=favouritedirectm&gid='.$game->invite_id.'">Direct Message</strong></a>';
  	$viewschallenge ='<a href="index.php?acc=games&page=favouritedirectc&gid='.$game->invite_id.'">Direct Challenge</strong></a>';
  	if(MYID==$game->invite_id){
  		//echo 'player 2';
  		$getopp = userModel::userDetails($game->usr_id);
  	}else if(MYID==$game->usr_id){
  		$getopp = userModel::userDetails($game->invite_id);
  		//echo 'player 1 logged in';
  	}
  	$opti = $getopp->fname." ".$getopp->lname ;
  	//
  	echo '<tr>
            <td><a href="index.php?acc=games&page=favourite_games&gid='.$game->invite_id.'"><strong>'.$opti.'</strong></a></td>'
  			. '<td><strong>'.$game->date_created.'</strong></td>'
  			. '<td><strong>'.$viewschallenge.'</strong></td>'
      		. '<td><strong>'.$views.'</strong></td></tr>';
  	}
  
  endif;
  ?>
  </tbody>
  </table>

