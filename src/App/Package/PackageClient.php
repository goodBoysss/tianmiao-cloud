<?php
/**
 * PackageClient.php  App托管平台
 * ==============================================
 * Copy right 2015-2022  by https://www.tianmtech.com/
 * ----------------------------------------------
 * This is not a free software, without any authorization is not allowed to use and spread.
 * ==============================================
 * @desc: App托管平台
 * @author: mukunhao <mukunhao@tianmtech.cn>
 * @date: 2022/12/14
 * @version: v1.0.0
 * @since: 2022/12/14 14:50
 */

namespace Tianmiao\Cloud\App\Package;

use Tianmiao\Cloud\Client;

class PackageClient extends Client
{
    public $envConfig = array(
        'host' => "PACKAGE_HOST",
        'appId' => "PACKAGE_APP_ID",
        'appSecret' => "PACKAGE_APP_SECRET"
    );
}