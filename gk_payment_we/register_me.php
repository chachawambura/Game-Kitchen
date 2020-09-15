<?php

require_once '../modules/payment/model.php';

$access_token = payment_model::access_tkn();
reg_url($access_token);

function reg_url($access_token) {
    $url = 'https://sandbox.safaricom.co.ke/mpesa/c2b/v1/registerurl';

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json',
        'Authorization:Bearer ' . $access_token)); //setting custom header


    $curl_post_data = array(
        //Fill in the request parameters with valid values
        'ShortCode' => '603012',
        'ResponseType' => 'Canceled',
        'ConfirmationURL' => 'https://gamingkitchen.co.ke/gk_payment_we/confirmation.php',
        'ValidationURL' => 'https://gamingkitchen.co.ke/gk_payment_we/validation.php'
    );

    $data_string = json_encode($curl_post_data);

    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);

    $curl_response = curl_exec($curl);
    print_r($curl_response);

    echo $curl_response;
}

?>