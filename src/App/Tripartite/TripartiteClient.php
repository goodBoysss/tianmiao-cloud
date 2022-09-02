<?php
/**
 * TripartiteClient.php
 * ==============================================
 * Copy right 2015-2021  by https://www.tianmtech.com/
 * ----------------------------------------------
 * This is not a free software, without any authorization is not allowed to use and spread.
 * ==============================================
 * @desc : 三方管理平台
 * @author: zhanglinxiao<zhanglinxiao@tianmtech.cn>
 * @date: 2022/09/02
 * @version: v1.0.0
 * @since: 2022/09/02 09:11
 */


namespace Tianmiao\Cloud\App\Tripartite;

use Tianmiao\Cloud\Client;

class TripartiteClient extends Client
{

    public $envConfig = array(
        'host' => "TRIPARTITE_HOST",
        'appId' => "TRIPARTITE_APP_ID",
        'appSecret' => "TRIPARTITE_APP_SECRET",
        //短信是否开启
        'smsIsOpen' => "TRIPARTITE_SMS_IS_OPEN",
        //短信白名单，当短信关闭时使用
        'smsMobileWhiteList' => "TRIPARTITE_SMS_MOBILE_WHITE_LIST",
    );


}