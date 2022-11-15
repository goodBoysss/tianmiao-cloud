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

namespace Tianmiao\Cloud\App\Promotion\General;

use Tianmiao\Cloud\App\Promotion\PromotionClient;

class PromotionGeneralClient extends PromotionClient
{
    /**
     * 通过别名获取应用信息
     * @param string $appAlias 应用别名
     * @return array
     *          status  状态：1-申请认证提交成功；0-申请认证提交失败；
     *          error   申请认证提交失败错误信息
     * @throws \Tianmiao\Cloud\Utils\TianmiaoCloudException
     */
    public function getAppInfoByAlias($appAlias)
    {
        return $this->request('/api/app', 'get', array(
            'alias' => $appAlias
        ));
    }
}