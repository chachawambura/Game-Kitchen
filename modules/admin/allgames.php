<div class="table-responsive">
<?php include 'searchbydate.php';?>

  <table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
  <thead>
    <tr>
      <th class="th-sm">title</th>
      <th class="th-sm">Player Email</th>
      <th class="th-sm">Opponent</th>
      <th class="th-sm">Total Stake</th>
      <th class="th-sm">Gaming Amount</th>
      <th class="th-sm">Prize</th>
      <th class="th-sm">play date</th>
      <th class="th-sm">Award</th>
    </tr>
  </thead>
  <tbody>
  <?php 
if(isset($_POST['searchByAliasNow']) && $_POST['searchByAliasNow'] == "Search")
{
    $startDate = $_POST['start_date'];
    $endDate = $_POST['end_date'];
    
    $gameslList = dashboardModel::submitSearchPlayerBetweenDates($startDate, $endDate);
    
}

print_r($gameslList);

?>
  <?php
  if(isset($_POST['searchToday']))
  {
     // echo dashboardModel::searchByToday();
      $gameslList = dashboardModel::searchByToday();
      //print_r(dashboardModel::searchByToday());
  }else if (isset($_POST['searchWeekly'])){
     // echo dashboardModel::searchByWeekly();
      $gameslList = dashboardModel::searchByWeekly();
  }else if(isset($_POST['searchTodayCount'])){
      $gameslList = dashboardModel::searchTodayCount();
  }else if (isset($_POST['searchMonthly'])) {
      $gameslList = dashboardModel::searchByMonthly();
  }
  if(isset($_POST['searchByAliasNow']) && $_POST['searchByAliasNow'] == "Search")
  {
    echo 'custom dates';  
  }else {
 // $gameslList = dashboardModel::listAllGamesByAdmin();
  }
  if(count($gameslList) < 1 ):
      echo '<div class="col-md-12 isa_warning text-center">There are no games</div>';
      else:
      $qty= 0;
      foreach($gameslList as $mygameList)
      {
      	$gid = $mygameList->id;
      	$getplayerId = $mygameList->player_1;
      	$getplayerId2 = $mygameList->player_2;
      	$status1 =$mygameList->player_1_result;
      	$status2 =$mygameList->player_2_result;
      	$totalstake = ($mygameList->player1_stake + $mygameList->player2_stake);
      	if($mygameList->win_status =="cancelled" || $status1=="NULL"){
      	
      		$gamingTake = "0";
      		$prizze = "0";
      	}else{
      		$gamingTake = (15/100*$totalstake);
      		$prizze = ($totalstake-$gamingTake);
      		
      	}
      	//$qty += $num['".$prizze."'];
      	$value = $gamingTake;
      	$qty += $value;
      	$play1Name =	userModel::userDetails($getplayerId);
      	$play2Name =	userModel::userDetails($getplayerId2);
      	$fullnames = $play1Name->fname. " ".$play1Name->lname;
      	if($getplayerId2=="NULL"){
      	$fullnames2 = "<strong>No Opponent</strong>";
      	}else{
      	$fullnames2 = $play2Name->fname. " ".$play2Name->lname;
      	}
      	//echo "ccccccccccccccccccccccc",$mygameList->win_status;
      	
      //	echo "status 1",$status1,"status 2",$status2;
      	
      	if($status1=="Yes" && $status2=="Yes"){
      		if($mygameList->win_status=="pending"){
      			$awardstatus ="<strong>Dispute</strong>";
      		}else{
      			$awardstatus ="<strong>Awarded</strong>";
      		}
      		
      	}else if($status1=="No" && $status2=="No"){
      		$awardstatus ="<strong> Draw </strong>";
      		
      	}else if($status1=="Yes" && $status2=="No"  && $mygameList->win_status!="awarded" ) {
      		$awardstatus ='<a href="index.php?acc=award-winner&gameId='.$mygameList->id.'"><strong>Award Winner</strong></a>';
      	}else if($status1=="No" && $status2=="Yes"  && $mygameList->win_status!="awarded" ) {
      		$awardstatus ='<a href="index.php?acc=award-winner&gameId='.$mygameList->id.'"><strong>Award Winner</strong></a>';
      	}else if($status1=="Yes" && $status2=="No" || $status1=="No" && $status2=="Yes" && $mygameList->win_status =="awarded" ) {
      	
      		$awardstatus = '<a href="#"><strong>Awarded</strong></a>';
      		
      	}else if($status1=="draw" && $status2=="draw" && $mygameList->win_status =="awarded" ) {
      		
      		$awardstatus ="<strong>Awarded</strong>";
      	      		
      	}else if($mygameList->win_status =="awarded" && $status1=="Yes" && $status2=="NULL" ){
      		
      		$awardstatus ="<strong>Awarded</strong>";
      	}else if($mygameList->win_status =="awarded" && $status1=="NULL" && $status2=="Yes"){
      		
      		$awardstatus ="<strong>Awarded</strong>";
      	}else if($mygameList->cancellation_status =="cancelled" && $mygameList->win_status =="cancelled"){
      		$awardstatus ="<strong>cancelled</strong>";
      	}else if($prizze==0){
      		$awardstatus ="<strong>Awarded</strong>";
      	}
      	
      	//winning 
      	
        	echo '<tr>
        <td><a href="index.php?acc=gamehistory&gameId='.$mygameList->id.'">'.$mygameList->id.'</a></td>'
      		. '<td>'.$fullnames.'</td>'
      		. '<td>'.$fullnames2.'</td>'
      		. '<td>'.$totalstake.'</td>'
      		. '<td>'.$gamingTake.'</td>'
      		. '<td>'.$prizze.'</td>'
        		. '<td>'.$mygameList->date_created.'</td>'
        		. '<td>'.$awardstatus.'</td>
         </tr>';
        		
        		
        
        //print_r($userN);
      	
        		
      }
      endif;
   ?>
  </tbody>
     <?php 
     
     echo '<tr>
            <td><strong>Totals</strong></td>'
      		. '<td></td>'
      		. '<td></td>'
      		. '<td></td>'
		    . '<td><strong>Kshs. '.$qty.'</strong></td>'
      		. '<td></td>'
            . '<td></td>'
            . '<td></td>
                  </tr> ';
     
     ?>
  </table>	
  <script type="text/javascript">

  <script type="text/javascript">
  $(function () {
      $('#datetimepicker6').datetimepicker();
      $('#datetimepicker7').datetimepicker({
          useCurrent: false //Important! See issue #1075
      });
      $("#datetimepicker6").on("dp.change", function (e) {
          $('#datetimepicker7').data("DateTimePicker").minDate(e.date);
      });
      $("#datetimepicker7").on("dp.change", function (e) {
          $('#datetimepicker6').data("DateTimePicker").maxDate(e.date);
      });
  });
</script>

</div>