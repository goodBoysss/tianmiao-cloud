<?php
require "../vendor/autoload.php";

$result=\Tianmiao\Cloud\App\Tripartite\Sms\SmsClient::getInstance(array())->sendSmsCode(18888888888,2,1234);


//$result=\Tianmiao\Cloud\App\Tripartite\Sms\SmsClient::getInstance()->sendSmsCode(18888888888,2,1234);

//$result=\Tianmiao\Cloud\App\Tripartite\Sms\SmsClient::getInstance()->checkSendWhite(18888888888);
//var_dump($result);