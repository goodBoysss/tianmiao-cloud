<?php
/**
 * SecurityClient.php  风控管理平台
 * ==============================================
 * Copy right 2015-2022  by https://www.tianmtech.com/
 * ----------------------------------------------
 * This is not a free software, without any authorization is not allowed to use and spread.
 * ==============================================
 * @desc: 风控管理平台
 * @author: yangwenjie <yangwenjie@tianmtech.cn>
 * @date: 2022/10/22
 * @version: v1.2.0
 * @since: 2022/10/22 15:03
 */

namespace Tianmiao\Cloud\App\Security;

use Tianmiao\Cloud\Client;

class SecurityClient extends Client
{
    public $envConfig = array(
        'host' => "SECURITY_HOST",
        'appId' => "SECURITY_APP_ID",
        'appSecret' => "SECURITY_APP_SECRET"
    );
}