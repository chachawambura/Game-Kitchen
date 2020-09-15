<?php

class Mpesa
{
	protected $environment;
    protected $consumer_key;
    protected $consumer_secret;

    public function __construct($environment, $consumer_key, $consumer_secret)
	{
		$this->environment = $environment;
        $this->consumer_key = $consumer_key;
        $this->consumer_secret = $consumer_secret;
	}

    public function b2cRequest($params)
    {    
        $url = "https://{$this->environment}.safaricom.co.ke/mpesa/b2c/v1/paymentrequest";
        $token = $this->generateToken();       

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, ['Content-Type:application/json', 'Authorization:Bearer ' . $token]);        

        $data_string = json_encode($params);

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);

        $curl_response = curl_exec($curl);

        return json_encode($curl_response);
    }

    protected function generateToken()
    {
        $url = "https://{$this->environment}.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials";
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        $credentials = base64_encode($this->consumer_key . ':' . $this->consumer_secret);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization: Basic ' . $credentials)); //setting a custom header
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

        $curl_response = curl_exec($curl);

        return json_decode($curl_response)->access_token;
    }

    public static function b2cCallback()
    {
        $callbackData = self::callBackData();

        return [
            "resultCode" => $callbackData->Result->ResultCode,
            "resultDesc" => $callbackData->Result->ResultDesc,
            "conversationID" => $callbackData->Result->ConversationID,
            "originatorConversationID" => $callbackData->Result->OriginatorConversationID,
            "transactionID" => $callbackData->Result->TransactionID,
            "initiatorAccountCurrentBalance" => $callbackData->Result->ResultParameters->ResultParameter[0]->Value,
            "debitAccountCurrentBalance" => $callbackData->Result->ResultParameters->ResultParameter[1]->Value,
            "amount" => $callbackData->Result->ResultParameters->ResultParameter[2]->Value,
            "debitPartyAffectedAccountBalance" => $callbackData->Result->ResultParameters->ResultParameter[3]->Value,
            "transCompletedTime" => $callbackData->Result->ResultParameters->ResultParameter[4]->Value,
            "debitPartyCharges" => $callbackData->Result->ResultParameters->ResultParameter[5]->Value,
            "receiverPartyPublicName" => $callbackData->Result->ResultParameters->ResultParameter[6]->Value,
            "currency" => $callbackData->Result->ResultParameters->ResultParameter[7]->Value
        ];
    }

	protected static function callBackData()
    {
        return json_decode(file_get_contents('php://input', true));
    }

	public function __destruct()
	{

	}
}
?>
