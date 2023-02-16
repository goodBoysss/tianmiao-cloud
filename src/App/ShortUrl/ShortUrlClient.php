<?php
/**
 * ShortUrlClient.php
 * ==============================================
 * Copy right 2015-2023  by https://www.tianmtech.com/
 * ----------------------------------------------
 * This is not a free software, without any authorization is not allowed to use and spread.
 * ==============================================
 * @desc: ${DESC}
 * @author: zhangkang<zhangkang@tianmtech.cn>
 * @date: 2023/02/16
 * @version: v1.0.0
 * @since: 2023/02/16 11:38
 */

namespace Tianmiao\Cloud\App\ShortUrl;

use Tianmiao\Cloud\Client;

class ShortUrlClient extends Client
{
    public $envConfig = [
        'host' => "SHORT_URL_HOST",
        'appId' => "SHORT_URL_APP_ID",
        'appSecret' => "SHORT_URL_APP_SECRET"
    ];
}