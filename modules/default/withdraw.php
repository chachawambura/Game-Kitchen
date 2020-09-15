<?php
$str1 = ltrim(playModel::userPhoneNumber(MYID), '0');
$phoneNo = $str1;
$tele= '254'.$phoneNo;
$balance = playModel::checkBalance(MYID);
//echo 'My balance :: '+$balance;
//$depositButtonClicked = false;
if ($_POST['submitWithdrawal'] == 'Withdraw') {
    $amount = $_POST['amount'];
   if($amount < $balance){
       echo 'Payment is being processed !!!';
       echo '<br/>';
       #echo 'Amount :'+$amount;
       #playModel::submitWithdrawalNow($amount, $tele);
       echo payment_model::mpesaWithdrawals($amount, $tele);
   }else{
       
     echo '<strong color="red">Insufficent funds in your wallet !!</strong>';
     echo '<br/>';
     echo 'Amount :'+$amount;
   }
}
?>
<form class="form" role="form" method="post" action="<?php $_PHP_SELF ?>" id="signup-nav">
    <div class="col-md-12">

        <h2>Enter Amount to withdraw</h2>
        
         <div class="col-md-4">
            <label class="sr-only" for="gkWithdrawAmount">Amount</label>
            <input type="number" class="form-control" name="amount" placeholder="Amount" required />
        </div>
        
       <div class="col-md-4 form-group">
        <div class="col-md-12 text-center">
           
            <input type="submit" id="submitWithdrawal" name="submitWithdrawal" class="btn btn-success" value="Withdraw" />
           
        </div>
    </div> 
   </div>
</form>