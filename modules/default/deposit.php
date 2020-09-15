<?php

//include '../../gk_payment_we/model.php';
$str1 = ltrim(playModel::userPhoneNumber(MYID), '0');
$phoneNo = $str1;

//echo $str1;
$depositButtonClicked = false;
if ($_POST['submitDeposit'] == 'Deposit') {
    $amount = $_POST['deposit_amount'];
    $depositButtonClicked = true;
       
    pay_model::stk_push($amount, $phoneNo);
   
}


?>
<form class="form" role="form" method="post" action="<?php $_PHP_SELF ?>" id="signup-nav">
    <div class="col-md-12">

        <h2>Follow this to pay with M-PESA</h2>

        <p> 
            1.) Make sure you funds you want deposited in your M-Pesa number <?php echo '254'.str_replace( ',', '', $phoneNo);?> <br/>
            2.) Make sure your phone screen lock is off <br/>
            3.) Make sure your default SIM is the one you intend to use <br/>
            4.) Enter <b>Amount</b> In Textbox Below and Submit <br/>
            5.) Follow M-Pesa instructions from your phone</p>
         <br/>
           <?php if($depositButtonClicked==false){?>
            <div class="col-md-4">
            <label class="sr-only" for="gkDepositAmount">Amount</label>
            <input type="number" class="form-control" name="deposit_amount" placeholder="Amount" required value=""/>
            </div>
            <?php }?>

    </div>
    <div class="col-md-4 form-group">
        <div class="col-md-12 text-center">
            <?php if($depositButtonClicked==false){?>
            <input type="submit" id="deposit_amount" name="submitDeposit" class="btn btn-success" value="Deposit" />
            <?php } else {?>
            <label id="depo_status">Processing payment</label>
             <?php echo 'AMOUNT :-'+$amount; ?>
            <?php }?>
        </div>
    </div>
</form>