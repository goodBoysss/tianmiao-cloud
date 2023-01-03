<?php
/**
 * ChannelClient.php  渠道推广系统
 * ==============================================
 * Copy right 2015-2022  by https://www.tianmtech.com/
 * ----------------------------------------------
 * This is not a free software, without any authorization is not allowed to use and spread.
 * ==============================================
 * @desc:
 * @author: yangwenjie <yangwenjie@tianmtech.cn>
 * @date: 2022/11/15
 * @version: v2.0.0
 * @since: 2022/11/15 15:03
 */

namespace Tianmiao\Cloud\App\Channel;

use Tianmiao\Cloud\Client;

class ChannelClient extends Client
{
    public $envConfig = array(
        'host' => "CHANNEL_HOST",
        'appId' => "CHANNEL_APP_ID",
        'appSecret' => "CHANNEL_APP_SECRET"
    );
}