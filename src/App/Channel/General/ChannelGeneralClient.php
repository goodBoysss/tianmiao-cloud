<?php
/**
 * ChannelGeneralClient.php
 * ==============================================
 * Copy right 2015-2022  by https://www.tianmtech.com/
 * ----------------------------------------------
 * This is not a free software, without any authorization is not allowed to use and spread.
 * ==============================================
 * @desc:
 * @author: yangwenjie <yangwenjie@tianmtech.cn>
 * @date: 2022/12/30
 * @version: v1.2.0
 * @since: 2022/12/30 18:25
 */
namespace Tianmiao\Cloud\App\Channel\General;

use Tianmiao\Cloud\App\Channel\ChannelClient;
use Tianmiao\Cloud\Utils\TianmiaoCloudException;

class ChannelGeneralClient extends ChannelClient
{
    /**
     * 通过别名获取应用信息
     * @param $appAlias
     * @params alias 应用别名
     * @return array|bool
     * @throws TianmiaoCloudException
     * @author yangwenjie <yangwenjie@tianmtech.cn>
     * @datetime 2022/12/30 18:26
     */
    public function getAppInfoByAlias($appAlias)
    {
        return $this->request('/api/app', 'get', array(
            'alias' => $appAlias
        ));
    }

    /**
     * 通过别名获取当前应用渠道包使用情况
     * @param $appAliases
     * @params aliases 应用别名 例如 'qipao,youmi,qianhuan'
     * @return array|bool 返回示例(正常) {"code":200,"data":[{"app_id":1,"alias":"qipao","package_num":1}],"message":""}
     * @return array|bool 返回示例(异常-应用不存在) {"code":200,"data":[],"message":""}
     * @throws TianmiaoCloudException
     * @author yangwenjie <yangwenjie@tianmtech.cn>
     * @datetime 2023/2/23 17:49
     */
    public function getAppPackageUsedNum($appAliases)
    {
        return $this->request('/api/app/package/used/num', 'get', array(
            'aliases' => $appAliases
        ));
    }
}