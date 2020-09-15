<div style="background-color: #ffff !important;">

<table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
  <thead>
    <tr>
     
    </tr>
  </thead>
  <tbody>
  <?php
   $gameslList = dashboardModel::listDirectMessage(MYID);
    foreach($gameslList as $mygameList){
    	
                       	$oppId=$mygameList->invite_id;
                       	$playerId = $mygameList->usr_id;
                       	$gamesList = playModel::showReplyByMessageId($mygameList->id);
                      
                       	
                      
                         $myreply = count($gamesList);
                       	if(MYID==$playerId){
                       		//echo 'player 1 logged in';
                       		$getopp = userModel::userDetails($oppId);
                       		if($mygameList->accept_status=="0"){
                       		$flask = '<a href="#"><strong>No Reply</strong></a>';
                       		}else{
                       		$flask = '<a href="#"><strong>View Reply</strong></a>';
                       		}
                       	}else if(MYID==$oppId){
                       		if($mygameList->accept_status=="0"){
                       		$flask = '<a href="index.php?acc=games&page=reply&gid='.$mygameList->id.'"><strong>Reply</strong></a>';
                       		}else {
                       		 $flask='<a href="index.php?acc=games&page=reply&gid='.$mygameList->id.'"><strong>Reply</strong></a>';
                       		}
                       		//echo 'player 2 logged in';
                       		$getopp = userModel::userDetails($playerId);
                       	}
                       	
                       	$views ='<a href="index.php?acc=games&page=viewreply&gid='.$mygameList->id.'">View Reply<strong>['.$myreply.']</strong></a>';
                       	
                       	//echo "player 1",$playerId, "player 2",$oppId;
                       	
                       	if($mygameList->read_status==0){
                       		$mark ='Unread';	
                       	}else {
                       		$mark ='Read';
                       	}
                       	
                       	$opti = $getopp->nametag;
	                 echo '<tr>';
                   $details = '<h4></h4>
                   
					<p><label>Description</label>'.$mygameList->description.'</p>
                    <p><label>Date Created </label> '.$mygameList->date_created.'</p>
		            <p><label>Opponent Gamer Tag</label> '.$opti.'</p>
                    <p><label>View Reply </label> '.$views.'</p>
					<p class="readmore">'.$flask.'</a>
                    <a href="index.php?acc=directmessage"><strong>Back</strong></a>
                     </p>';

                echo '<div class="col-md-12 game-details">
					<div class="col-md-12">' . $details .'</div>
			  </div>';
                
                foreach($gamesList as $gamev)
                {
                	                	
                	$msess =$gamev->description;
                	echo '<div>'.$msess.'<a href="index.php?acc=games&page=reply&gid='.$mygameList->id.'"><strong>Reply</strong></a></div>';
                }
              
                       echo '</tr>';
       }
    
   ?>
  </tbody>
  </table>	
 <script type="text/javascript">
 function toggler(divId) {
	    $("#" + divId).toggle();
	}
 </script>
</div>