<?php
/**
 * PromotionClient.php  风控管理平台
 * ==============================================
 * Copy right 2015-2022  by https://www.tianmtech.com/
 * ----------------------------------------------
 * This is not a free software, without any authorization is not allowed to use and spread.
 * ==============================================
 * @desc: 推广平台
 * @author: zhanglinxiao <zhanglinxiao@tianmtech.cn>
 * @date: 2022/11/15
 * @version: v2.0.0
 * @since: 2022/11/15 15:03
 */

namespace Tianmiao\Cloud\App\Promotion;

use Tianmiao\Cloud\Client;

class PromotionClient extends Client
{
    public $envConfig = array(
        'host' => "PROMOTION_HOST",
        'appId' => "PROMOTION_APP_ID",
        'appSecret' => "PROMOTION_APP_SECRET"
    );
}