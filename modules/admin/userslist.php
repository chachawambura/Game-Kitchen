<div class="table-responsive">
<table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
  <thead>
    <tr>
      <th class="th-sm">id

      </th>
      <th class="th-sm">firstname

      </th>
      <th class="th-sm">lastname 

      </th>
      <th class="th-sm">email

      </th>
      <th class="th-sm">phone No.</th>
      
       <th class="th-sm">status</th>
       
        <th class="th-sm">Activate</th>
      
       <th class="th-sm">suspend</th>
       
       <th class="th-sm">Password Reset</th>
       
       
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
      	$userId = $game->user_id;
      	
      	//echo "user id ",$userId;
      	$onestick = dashboardModel::listUserStrikes( $userId );
      	foreach ($onestick as $stk){
      		$color1 = $stk->gaming_green;
      		if($color1=="#ffffff"){
      			$colz1 = '<a href="index.php?acc=green&playerId='.$game->user_id.'">&star;</a>';
      		}else{
      			$colz1 ='<a href="#">&star;</a>';
      		}
      		$color2 = $stk->gaming_orange;
      		$color3 = $stk->gaming_red;
      	}
      	// "tttttt--------------------",$onestick->user_id;
      	$reset ='<strong><a href="index.php?acc=reset_passw&playerId='.$game->user_id.'">reset</a></strong>';
      	if($game->active==1){
      	$status="Enable";
      	}else if($game->active==0){
      	$status="Disable";
      	}
      	if($game->active==1){
      		$statusr="<strong>Active</strong>";
      	}else if($game->active==0){
      		$statusr='<strong><a href="index.php?acc=enableNow&playerId='.$game->user_id.'">In-Active</a></strong>';
      	}
      	echo '<tr>
        <td>'.$game->id.'</td>'
	    . '<td><a href="index.php?acc=oneuser&playerId='.$game->user_id.'">'.$game->fname.'</a></td>'
	    . '<td>'.$game->lname.'</td>'
      		. '<td>'.$game->emailadd.'</td>'
	    . '<td>'.$game->phoneno.'</td>'
      	. '<td>'.$statusr.'</td>'
        . '<td>'.$status.'</td>'
      	. '<td><a href="index.php?acc=temporary&playerId='.$game->user_id.'">temporary</a>|<a href="index.php?acc=permanent&playerId='.$game->user_id.'">permanent</a></td>'
		. '<td style="text-align:center;">'.$reset.'</td>'
      	. '<td style="text-align:center;&star;&starf;&bigstar;">
<span style="background: ' . $color1 . ';"><a href="index.php?acc=green&playerId='.$game->user_id.'">&star;</a></span>
<span style="background: ' . $color2 . ';"><a href="index.php?acc=orange&playerId='.$game->user_id.'">&starf;</a></span>
<span style="background: ' . $color3 . ';"><a href="index.php?acc=red&playerId='.$game->user_id.'">&bigstar;</a></span>
</td></tr>';
      }
      endif;
   ?>
    </tr>
 
</table>            
						</div>
