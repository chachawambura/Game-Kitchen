<?php

class pay_model {

    public function stk_push($Amount, $phone) {
        
        $access_token = payment_model::access_tkn();
        $PartyA = '254'.$phone; // This is your phone number, 
        $AccountReference = 'Gaming Kitchen';
        $TransactionDesc = 'Topup';
        // $Amount = '1';
        # Get the timestamp, format YYYYmmddhms -> 20181004151020
        $Timestamp = date('YmdHis');


        # define the variales
        # provide the following details, this part is found on your test credentials on the developer account
        $BusinessShortCode = '174379';
        $Passkey = 'bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919';
        # Get the base64 encoded string -> $password. The passkey is the M-PESA Public Key
        $Password = base64_encode($BusinessShortCode . $Passkey . $Timestamp);
        $initiate_url = 'https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest';
        # callback url
        $CallBackURL = 'https://gamingkitchen.co.ke/gk_payment_we/callb_url.php';
        # header for stk push
        $stkheader = ['Content-Type:application/json', 'Authorization:Bearer ' . $access_token];
        # initiating the transaction
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $initiate_url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $stkheader); //setting custom header
        $curl_post_data = array(
            //Fill in the request parameters with valid values
            'BusinessShortCode' => $BusinessShortCode,
            'Password' => $Password,
            'Timestamp' => $Timestamp,
            'TransactionType' => 'CustomerPayBillOnline',
            'Amount' => $Amount,
            'PartyA' => $PartyA,
            'PartyB' => $BusinessShortCode,
            'PhoneNumber' => $PartyA,
            'CallBackURL' => $CallBackURL,
            'AccountReference' => $AccountReference,
            'TransactionDesc' => $TransactionDesc
        );
        $data_string = json_encode($curl_post_data);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
        $curl_response = curl_exec($curl);
       // print_r($curl_response);
       // echo $curl_response;
        header( "refresh:10;url=index.php?pg=balance" );
    }

}

?>
