<?php
//require_once '../modules/payment/model.php';
require_once  '../modules/player/model.php';
  $stkCallbackResponse = file_get_contents('php://input');
  $logFile = "stkPushCallbackResponse.log";
  $log = fopen($logFile, "a");
  fwrite($log, $stkCallbackResponse);
  fclose($log);

$json = json_decode($stkCallbackResponse."", TRUE);
$resultCode = $json['Body']['stkCallback']['ResultCode'];
error_log($resultCode." what is this now");

$count = 0;
  
if ($resultCode == '0') {

    $MerchantRequestID = $json['Body']['stkCallback']['MerchantRequestID'];
    $CheckoutRequestID = $json['Body']['stkCallback']['CheckoutRequestID'];
    $ResultDesc = $json['Body']['stkCallback']['ResultDesc'];

    $meta = $json['Body']['stkCallback']['CallbackMetadata']['Item'];
    $Amount = $meta[0]['Value'];
    $MpesaReceiptNumber = $meta[1]['Value'];
    $TransactionDate = $meta[3]['Value'];
    $PhoneNumber = $meta[4]['Value'];
   // $count++;
    

//    payment_model::insertTransaction($MpesaReceiptNumber, $MerchantRequestID, 
//            $CheckoutRequestID, $ResultDesc, strval($Amount), 
//            strval($TransactionDate), strval($PhoneNumber));
    insertTransaction($MpesaReceiptNumber, $MerchantRequestID, 
            $CheckoutRequestID, $ResultDesc, strval($Amount), 
            strval($TransactionDate), strval($PhoneNumber));
} else {
    echo 'G-Error!';
}

function insertTransaction($MpesaReceiptNumber, $MerchantRequestID,
            $CheckoutRequestID, $ResultDesc, $Amount, $TransactionDate, $PhoneNumber){
    
           try {

            $servername = "localhost";
            $username = "gamingki_yoke1";
            $password = "4gWVRTpGMFGD!";
            $dbname = "gamingki_main_";
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO stk_payments (MpesaReceiptNumber, MerchantRequestID, "
                    . "CheckoutRequestID, ResultDesc, Amount, TransactionDate, PhoneNumber) VALUES ('" . $MpesaReceiptNumber . "','" . $MerchantRequestID . "','" . $CheckoutRequestID .
                    "','" . $ResultDesc . "','" . $Amount . "','" . $TransactionDate . "','" . $PhoneNumber . "')";
            $conn->exec($sql);
//update
             update_balance($PhoneNumber, $Amount);
        } catch (PDOException $e) {
            echo $sql . "<br>" . $e->getMessage();
            error_log($e->getMessage());
        }

}

  function update_balance($phone, $amount) {
        
  	    $servername = "localhost";
  	    $username = "gamingki_yoke1";
  	    $password = "4gWVRTpGMFGD!";
  	    $dbname = "gamingki_main_";
        $conn = mysqli_connect($servername, $username, $password, $dbname);
        if (!$conn) {
            error_log("faliled");
        }
        $phone2 = "0".ltrim($phone,"254");
        $sqlUser = "SELECT id, user_id FROM user_details WHERE phoneno='$phone2'";
  
        $resultUser = mysqli_query($conn, $sqlUser);

        while ($rowUser = mysqli_fetch_assoc($resultUser)) {
            $user_id = $rowUser["user_id"];
            $sqlBal = "SELECT balance FROM balance WHERE uid=$user_id";
            $resultBal = mysqli_query($conn, $sqlBal);
            while ($rowBal = mysqli_fetch_assoc($resultBal)) {
                $user_bal = $rowBal["balance"];
                $topupAmount = (int) $amount;
                $final_balance = $user_bal + $topupAmount;
                $sqlUpadateBal = "UPDATE balance SET balance=$final_balance WHERE uid = $user_id";
                error_log($sqlUpadateBal);
                mysqli_query($conn, $sqlUpadateBal);
            }
        }
         header("Location: https://gamingkitchen.co.ke/");
  }


