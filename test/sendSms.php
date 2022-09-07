<?php
require "../vendor/autoload.php";

$result=\Tianmiao\Cloud\App\Tripartite\Sms\SmsClient::getInstance(array(
    'host'=>'',
    'app_id'=>'',
    'app_secret'=>'',
    'sms_is_open'=>'0',
    'sms_mobile_white_list'=>'',
))->checkSendWhite(18888888888);


//$result=\Tianmiao\Cloud\App\Tripartite\Sms\SmsClient::getInstance()->sendSmsCode(18888888888,2,1234);

//$result=\Tianmiao\Cloud\App\Tripartite\Sms\SmsClient::getInstance()->checkSendWhite(18888888888);
var_dump($result);