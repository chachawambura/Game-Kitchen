<div class="table-responsive">
<?php 
$gameslList = dashboardModel::showLeagueNow();

//print_r($gameslList);
?>
  <table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
  <thead>
    <tr>
      <th class="th-sm">League Id</th>
      <th class="th-sm">Category</th>
      <th class="th-sm">League</th>
      <th class="th-sm">Status</th>
    </tr>
  </thead>
  <tbody>
  <?php

  if(count($gameslList) < 1 ):
      echo '<div class="col-md-12 isa_warning text-center">There are no league</div>';
      else:
      $qty= 0;
      foreach($gameslList as $mygameList)
      {
      	$gid = $mygameList->id;
      	$getleague = $mygameList->league;
      	$getplayerId2 = $mygameList->gametitle;
      	$status1 =$mygameList->status;
      	
       echo '<tr>
        <td><a href="index.php?acc=gamehistory&gameId='.$gid.'">'.$gid.'</a></td>'
          . '<td>'.$getplayerId2.'</td>'
          . '<td>'.$getleague.'</td>'
          . '<td>'.$status1.'</td>
         </tr>';
        		
        		
        
        //print_r($userN);
      	
        		
      }
      endif;
   ?>
  </tbody>
    
  </table>	
  </table>
  </div>