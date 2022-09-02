<?php
require "../vendor/autoload.php";

$result=\Tianmiao\Cloud\App\Tripartite\Sms\SmsClient::getInstance(array(
    'host'=>'http://tripartite-api.tianmcloud.com',
    'app_id'=>'22082215080004',
    'app_secret'=>'87c55b4bbbe72d7e8a69553bf4b76643',
    'sms_is_open'=>'0',
    'sms_mobile_white_list'=>'',
))->checkSendWhite(18888888888);


//$result=\Tianmiao\Cloud\App\Tripartite\Sms\SmsClient::getInstance()->sendSmsCode(18888888888,2,1234);

//$result=\Tianmiao\Cloud\App\Tripartite\Sms\SmsClient::getInstance()->checkSendWhite(18888888888);
var_dump($result);