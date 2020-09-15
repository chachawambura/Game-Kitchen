<div class="">
							<table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
  <thead>
    <tr>
      <th class="th-sm">id</th>
      <th class="th-sm">firstname</th>
      <th class="th-sm">lastname </th>
  
      <th class="th-sm">phone No.</th>
      
      <th class="th-sm">Balance.</th>
      
       <th class="th-sm">Top Up</th>
       
       
       
    </tr>
  </thead>
  <tbody>
    <tr>
      <?php

      $gamesList = dashboardModel::listUserList();
      if(count($gamesList) < 1 ):
      echo '<div class="col-md-12 isa_warning text-center">There are no games</div>';
      else:
      	
      foreach($gamesList as $game)
      {
      	$balance = playModel::checkBalance($game->user_id);
      	$topup ='<strong><a href="index.php?acc=topup&playerId='.$game->user_id.'">top up</a></strong>';
      	$topup1='<strong><a href="#">disabled</a></strong>';
      	echo '<tr>
        <td>'.$game->id.'</td>'
	    . '<td><a href="index.php?acc=oneuser&playerId='.$game->user_id.'">'.$game->fname.'</a></td>'
	    . '<td>'.$game->lname.'</td>'
	    . '<td>'.$game->phoneno.'</td>'
      		. '<td>'.$balance.'</td>'
      	    . '<td style="text-align:center;">'.$topup1.'</td></tr>';
      }
      endif;
   ?>
    </tr>
 
</table>            
</div>
