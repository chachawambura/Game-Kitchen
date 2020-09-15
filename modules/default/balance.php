<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
</style>
<h2>Balance: <?php 
echo 'Ksh '.playModel::checkBalance(MYID);?></h2>
<table>
  <tr>
    <th>M-Pesa Code</th>
    <th>Amount</th>
    <th>Transaction Date</th>
  </tr>
  <?php 
  $phoneNo =  playModel::userPhoneNumber(MYID);
  //echo '1'+$phoneNo;
 $str = ltrim($phoneNo, '0'); 
// echo '2'+$str;
  $tList = playModel::listMyTransactions("254".$str);
 // $tList = playModel::listMyTransactions($phoneNo);
        //print_r($tList);
        foreach ($tList as $transaction) {
            $oTransaction = baseModel::stkTransactionDetails($transaction->id);
            $time = strtotime($oTransaction->TransactionDate);

              $newformat = date('Y-M-d h:i:s a',$time);
            
           // echo $oTransaction->Amount;
            echo '<tr><td>'.$oTransaction->MpesaReceiptNumber.'</td>'
                    . '<td>'.$oTransaction->Amount.'</td>'
                    . '<td>'.$newformat.'</td></tr>';
            

        }
      
        

        
  ?>
 

</table>

