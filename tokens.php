<?php
    setlocale(LC_MONETARY, 'en_US');
    date_default_timezone_set('Europe/Istanbul');


function curl_post($url){
        $curl_handle=curl_init();
        curl_setopt($curl_handle,CURLOPT_URL,$url);
        curl_setopt($curl_handle,CURLOPT_CONNECTTIMEOUT,3);
        curl_setopt($curl_handle,CURLOPT_RETURNTRANSFER,1);
        $buffer = curl_exec($curl_handle);
        curl_close($curl_handle);
        if (empty($buffer))
            $response = array();
        else
            $response = json_decode($buffer,true);

        return $response;
    }

    $api_url = "https://api.pancakeswap.info/api/v2/tokens/";
    $tokens = array();

    /* BTC */
    $tokens["0x7130d2A12B9BCbFAe4f2634d864A1Ee1Ce3Ead9c"] = array();
    $tokens["0x7130d2A12B9BCbFAe4f2634d864A1Ee1Ce3Ead9c"]["count"] = 1;
    $tokens["0x7130d2A12B9BCbFAe4f2634d864A1Ee1Ce3Ead9c"]["buy_price"] = 32.3000;

    /* ETH */
    $tokens["0x2170Ed0880ac9A755fd29B2688956BD959F933F8"] = array();
    $tokens["0x2170Ed0880ac9A755fd29B2688956BD959F933F8"]["count"] = 5;
    $tokens["0x2170Ed0880ac9A755fd29B2688956BD959F933F8"]["buy_price"] = 456;

    /* LEAD */
    $tokens["0x2ed9e96edd11a1ff5163599a66fb6f1c77fa9c66"] = array();
    $tokens["0x2ed9e96edd11a1ff5163599a66fb6f1c77fa9c66"]["count"] = 920000;
    $tokens["0x2ed9e96edd11a1ff5163599a66fb6f1c77fa9c66"]["buy_price"] = 0.006;

    /* BNB */
    $tokens["0xbb4CdB9CBd36B01bD1cBaEBF2De08d9173bc095c"] = array();
    $tokens["0xbb4CdB9CBd36B01bD1cBaEBF2De08d9173bc095c"]["count"] = 0;
    $tokens["0xbb4CdB9CBd36B01bD1cBaEBF2De08d9173bc095c"]["buy_price"] = 0;

    /* CAKE */
    $tokens["0x0E09FaBB73Bd3Ade0a17ECC321fD13a19e81cE82"] = array();
    $tokens["0x0E09FaBB73Bd3Ade0a17ECC321fD13a19e81cE82"]["count"] = 0;
    $tokens["0x0E09FaBB73Bd3Ade0a17ECC321fD13a19e81cE82"]["buy_price"] = 0;

    /* JULD */
    $tokens["0x5a41f637c3f7553dba6ddc2d3ca92641096577ea"] = array();
    $tokens["0x5a41f637c3f7553dba6ddc2d3ca92641096577ea"]["count"] = 0;
    $tokens["0x5a41f637c3f7553dba6ddc2d3ca92641096577ea"]["buy_price"] = 0;

    /* AFEN */
    $tokens["0xd0840d5f67206f865aee7cce075bd4484cd3cc81"] = array();
    $tokens["0xd0840d5f67206f865aee7cce075bd4484cd3cc81"]["count"] = 0;
    $tokens["0xd0840d5f67206f865aee7cce075bd4484cd3cc81"]["buy_price"] = 0;

    /* BUSD */
    $tokens["0xe9e7CEA3DedcA5984780Bafc599bD69ADd087D56"] = array();
    $tokens["0xe9e7CEA3DedcA5984780Bafc599bD69ADd087D56"]["count"] = 436;
    $tokens["0xe9e7CEA3DedcA5984780Bafc599bD69ADd087D56"]["buy_price"] = 0.9;



    foreach ($tokens as $token_key => $token_value){
        $url = $api_url.$token_key;
        $token_response = curl_post($url);

        if(isset($token_response["updated_at"])){
            $tokens[$token_key]["updated_at"] = date("d-m-Y H:i:s", (int)($token_response["updated_at"]/1000));
            $tokens[$token_key]["name"] = $token_response["data"]["name"];
            $tokens[$token_key]["symbol"] = $token_response["data"]["symbol"];
            $tokens[$token_key]["price"] = number_format((double)$token_response["data"]["price"],4,".","");
            $tokens[$token_key]["total_price"] = number_format(( $tokens[$token_key]["price"]*(double)$tokens[$token_key]["count"]),2);
            $tokens[$token_key]["token"] = $token_key;
        }
    }
?>