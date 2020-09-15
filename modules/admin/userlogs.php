<div class="">
						<table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
  <thead>
    <tr>
     
      <th class="th-sm">username</th>
      <th class="th-sm">action</th>
      <th class="th-sm">action date</th>
      
    </tr>
  </thead>
  <tbody>
    <tr>
   <?php

   $userLOGSList = dashboardModel::listUserLOGS();
   if(count($userLOGSList) < 1 ):
      echo '<div class="col-md-12 isa_warning text-center">There are no games</div>';
      else:
      	
      foreach($userLOGSList as $userlog)
      {
      	echo '<tr>
        <td>'.$userlog->id.'</td>'
	    . '<td>'.$userlog->action.'</td>'
	    . '<td>'.$userlog->date_action.'</td></tr>';
      }
      endif;
   ?>
    </tr>
    </tbody>
    </table>
</div>