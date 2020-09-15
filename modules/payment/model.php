<?php

class payment_model {

    public function access_tkn() {
        $consumerKey = 'OCdVedb9204SGZ595rGouBLhyuvYGGCz'; //Fill with your app Consumer Key
        $consumerSecret = 'Z1UpE5sA7NO5lcr8'; // Fill with your app Secret
        $headers = ['Content-Type:application/json; charset=utf8'];
        $url = 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($curl, CURLOPT_HEADER, FALSE);
        curl_setopt($curl, CURLOPT_USERPWD, $consumerKey . ':' . $consumerSecret);
        $result = curl_exec($curl);
        $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        $result = json_decode($result);
        $access_token = $result->access_token;

        curl_close($curl);
        return $access_token;
    }
    

    public function insertTransaction($MpesaReceiptNumber, $MerchantRequestID,
            $CheckoutRequestID, $ResultDesc, $Amount, $TransactionDate, $PhoneNumber) {

               $logFile = "stkPushCallbackResponse.log";

        
        $sql = new MYSQL;
        $query = $sql->insert('stk_payments');
        $query .= $sql->columns('MpesaReceiptNumber, MerchantRequestID, CheckoutRequestID, ResultDesc,'
                . 'Amount, TransactionDate, PhoneNumber');

        $query .=$sql->values("'".$MpesaReceiptNumber."','". $MerchantRequestID."','".$CheckoutRequestID.
                "','".$ResultDesc."','".$Amount."','".$TransactionDate."','".$PhoneNumber."'");

  $logFile = "stkPushCallbackResponse.log";
  $log = fopen($logFile, "a");
  fwrite($log, $query." Yes Kelvin");
  fclose($log);

 
    }
    
    
    
    
    
    
    
    
    public function mpesaWithdrawals($amount, $phone)
    {
        $transcost = ($amount < 1001) ? 15.00 : 22.00;
        $withdrawal = $amount + $transcost;
        
        $params = [
            'InitiatorName' => 'TestInit611',
            'SecurityCredential' => 'ZkKbAwLslPOwItsxQpZdfLc/L+JSqPkZzy7jynnkxWLMyux2TL1DG2E469KRo5YEGfoDkf64EdjzbGg7lDDMnNbpnZnJKsSN2hZ2M03LzdtWOFH3B2dtUCDMh9Bu4IAVytiOfJ66BQibKgqh2WNSFJsRwh4rc00ZRzTeIrbXAVj8cJF6f9Jxez/YPbDsy0q7K0pkWrr6P071UIUduxBTxPgk1ch4gnxbnepRrHGcGARsXqjPzexJ5B46PeA86nf7HpRIm0LjnA053JS60iEFOxEpzcYDr6uEpp1Ml7AUF1axq8drkz/AfeGaGFJ51y+UmPEQCUEDtRwrSOEICfyYug==',
            'CommandID' => "BusinessPayment",
            'Amount' => $amount,
            'PartyA' => 600611,
            'PartyB' => $phone,
            'Remarks' => "Payment",                    
            'QueueTimeOutURL' => 'http://gamingkitchen.co.ke/3p4Sa/b2c-time-out.php',
            'ResultURL' => 'http://gamingkitchen.co.ke/3p4Sa/b2c-call-back.php',
            'Occassion' => "Withdraw",
        ];

        $mpesa = new Mpesa('sandbox', 'OCdVedb9204SGZ595rGouBLhyuvYGGCz', 'Z1UpE5sA7NO5lcr8');
                    
        $request = $mpesa->b2cRequest($params);

        return $response = (object) $request;
        
        if (isset($response->ResponseCode))
        {
            if ($response->ResponseCode == 0)
            {
                #Success
                //Write your code
    		}                      
            else
            {    
                #Failure
                //Write your code
            }
        }
        else
        {
            #Request Failed
        } 

    }

}



