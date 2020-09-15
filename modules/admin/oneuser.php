 <?php
 $tList3 = userModel::userDetails($playerId);
 
?>
  
 <div class="col-md-12">
 
 <div class="col-md-12 form-group">
    	<div class="col-md-6">
            <label class="sr-only" for="exampleInputEmail2">First Name</label>
            <input type="text" class="form-control" name="fname" placeholder="First Name" required value="<?php echo $tList3->fname;?>" readonly>
   		</div>
        <div class="col-md-6">
            <label class="sr-only" for="exampleInputEmail2">Last Name</label>
            <input type="text" class="form-control" name="lname" placeholder="Last Name" required value="<?php echo $tList3->lname;?>" readonly>
        </div>   
    </div>
 
    <div class="col-md-12 form-group">
       	<div class="col-md-6">
            <label class="sr-only" for="exampleInputEmail2">Email address</label>
            <input type="email" class="form-control" name="emailadd" placeholder="Valid Email address" value="<?php echo $tList3->emailadd;?>" readonly>
    	</div>
        <div class="col-md-6">
            <label class="sr-only" for="exampleInputPassword2">Phone</label>
            <input type="tel" class="form-control" name="phoneno" placeholder="Phone number 07xx yyy zzzz" value="<?php echo $tList3->phoneno;?>" readonly>
        </div>
    </div>
   
    <div class="col-md-12 form-group">
        <div class="col-md-3">
            <label class="sr-only" for="exampleInputPassword2">Alias</label>
            <input type="text" class="form-control" name="alias" placeholder="Name Alias" value="<?php echo $tList3->alias;?>" readonly>
        </div>
        <div class="col-md-3">
           <label class="sr-only" for="exampleInputPassword2">Console Type</label>
          <input type="text" class="form-control" name="consoleId"  value="<?php echo $tList3->consoleId;  ?>" readonly>
           
        </div>
      <div class="col-md-6" id="ps4" style="display:block;">
     <label class="sr-only" for="exampleInputPassword2">Game Tag</label>
     <input type="text" class="form-control" name="nametag"  value="<?php echo $tList3->nametag; ?>" readonly>
     </div>
     
    </div>
 </div>                      
			    	
			    				
		<div class="col-md-12">

<div class="col-md-6"><p><strong>GAMING HISTORY</strong></p>
<table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
  <thead>
    <tr>
    
      <th class="th-sm">Id</th>
      <th class="th-sm">Category</th>
      <th class="th-sm">Opponent</th>
       <th class="th-sm">Stake</th>
      <th class="th-sm">Date</th>
      <th class="th-sm">status</th>
      
    </tr>
  </thead>
  <tbody>
  <?php 
  $gameslList = dashboardModel::getGameByPlayerId($playerId);
  
  //print_r($getRewardId);
  if(count($gameslList) < 1 ):
  echo '<div class="col-md-12 isa_warning text-center">There are no games</div>';
  else:
  
  foreach($gameslList as $mygameList)
  {
  	$tr = dashboardModel::getGameByCategoryId($mygameList->gamecategory_id);
  	$ctname = $tr->gametitle;
  	$getRewardId = playModel::oneplayer1Details($playerId, $mygameList->id);
  	$getRewardId2 = playModel::oneplayer2Details($playerId , $mygameList->id);
  
  	if($mygameList->player_1==$getRewardId->player_1){
  		
  		$winst=$getRewardId->win_status;
  		$player2 = $mygameList->player_2;
  		$tList4 = userModel::userDetails($player2);
  		$oppt = $tList4->emailadd;
  		if($winst=="cancelled"){
  			$oppt = "<strong>No Opponent</strong>";
  		}
  	}else if($mygameList->player_2==$getRewardId2->player_2){
  		$winst=$getRewardId2->win_status;
  		$player2 = $mygameList->player_1;
  		$tList4 = userModel::userDetails($player2);
  		$oppt = $tList4->emailadd;
  		if($winst=="cancelled"){
  		$oppt = "<strong>No Opponent </strong>";
  		}
  	}else {
  		$oppt = "No Opponent";
  	}
  	echo '<tr>
        <td><a href="index.php?acc=gamehistory&gameId='.$mygameList->id.'">'.$mygameList->id.'</a></td>'
	    . '<td><a href="index.php?acc=gamehistory&gameId='.$mygameList->gamecategory_id.'">'.$ctname.'</a></td>'
            		. '<td>'.$oppt.'</td>'
	    . '<td>'.$mygameList->player1_stake.'</td>'
	    . '<td>'.$mygameList->date_created.'</td>'
	    . '<td><strong>'.$winst.'</strong></td></tr>';
  }
  endif;
  ?>
  </tbody>
  
  </table>


</div>

<div class="col-md-6"><p><strong>TRANSACTIONS HISTORY</strong></p>
<table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
  <thead>
    <tr>
    
      <th class="th-sm"> M-Pesa Code</th>
      <th class="th-sm"> Username</th>
      <th class="th-sm"> Telephone</th>
      <th class="th-sm">Amount</th>
      <th class="th-sm">Transaction Date</th>
      
    </tr>
  </thead>
  <tbody>
  <?php 
  ?>
  </tbody>
  
  </table>
  </div>
</div>	    			
	 