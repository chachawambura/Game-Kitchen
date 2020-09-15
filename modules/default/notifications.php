<div style="background-color: #ffff !important;">
    
    
<form action="#" method="post">
    Select all Notifications as read ?
    <input type="checkbox" name="formWheelchair" value="Yes" />
    <input type="submit" name="formSubmit" value="Submit" />
</form>



    <?php
if(isset($_POST['formWheelchair']) && 
   $_POST['formWheelchair'] == 'Yes') 
{
   echo dashboardModel::checkAllAsRead();
}


?>
<table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
  <thead>
    <tr>
     
    </tr>
  </thead>
  <tbody>
  <?php
  $notificationId = $_REQUEST['&page=read&gid'];
  $userdetails = userModel::userDetails(MYID);
  if($userdetails->access_lvl==0){
  	$gameslList = dashboardModel::listNotifications(MYID);
  }else {
  	$gameslList = dashboardModel::listNotificationx();
  }
          foreach($gameslList as $mygameList)
                       {
                       	
                       	if($mygameList->read_status==0){
                       	
                       	if($mygameList->read_status==0){
                       		$mark ='Unread';	
                       	}else {
                       		$mark ='Read';
                       	}
	                 echo '<tr>';
                   $details = '<h4>'.$mygameList->id.'</h4>
                   
					<p><label>Description</label><strong>'.$mygameList->description.'</strong></p>
                    <p><label>Date Created </label> '.$mygameList->date_created.'</p>
		            <p><label>Message Type</label> '.$mygameList->alert_type.'</p>
					<p class="readmore"><a href="index.php?acc=games&page=read&gid='.$mygameList->id.'"><strong>'.$mark.'</strong></a></p>';

//echo $file;

                echo '<div class="col-md-5 game-details">
					<div class="col-md-6">' .$image . '</div><div class="col-md-6">' . $details .'</div>
			  </div>';
                       echo '</tr>';
                       
                       	}
                       }
   ?>
  </tbody>
  </table>	
</div>