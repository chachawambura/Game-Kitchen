<?php 

echo  'winning ...';

?>

<div class="">
<table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
  <thead>
    <tr>
      <th class="th-sm">game Id</th>
      <th class="th-sm">Transaction</th>
      
       <th class="th-sm">Amount In</th>
       
       <th class="th-sm">Amount Out</th>
       
       <th class="th-sm">Profit</th>
       
       <th class="th-sm">Loose</th>
       
       
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
      	
      }
      endif;
   ?>
    </tr>
 
</table>            
						</div>
