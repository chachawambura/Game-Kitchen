<div class="col-md-12">

<div class="col-md-6"><p><strong>DEPOSITS</strong></p>
<table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
  <thead>
    <tr>
     
    <th class="th-sm">Telephone</th>
    <th class="th-sm">M-Pesa Code</th>
    <th class="th-sm">Receipt Number</th>
    <th class="th-sm">Amount</th>
    <th class="th-sm">Transaction Date</th>
      
    </tr>
  </thead>
  <tbody>
  <?php

  $gameslList = dashboardModel::getAllDeposits();
  if(count($gameslList) < 1 ):
      echo '<div class="col-md-12 isa_warning text-center">There are no deposits </div>';
      else:
      	
      foreach($gameslList as $mygameList)
      {
      	$getplayerId = $mygameList->usr_id;
      	$userN =	userModel::userDetails($getplayerId);
      	//print_r($userN);
      	echo '<tr>
        <td><a href="index.php?acc=gamehistory&gameId='.$mygameList->PhoneNumber.'">'.$mygameList->PhoneNumber.'</a></td>'
      		. '<td>'.$mygameList->MpesaReceiptNumber.'</td>'
      		. '<td>'.$mygameList->ResultDesc.'</td>'
      		. '<td>'.$mygameList->Amount.'</td>'
      		. '<td>'.$mygameList->TransactionDate.'</td></tr>';
      }
      endif;
      ?>
  </tbody>
  
  </table>


</div>

<div class="col-md-6"><p><strong>WITHDRAWALS</strong></p>
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
  </tbody>
  
  </table>
  </div>
</div>