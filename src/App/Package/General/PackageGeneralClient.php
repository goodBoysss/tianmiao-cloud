<?php
/**
 * PackageGeneralClient.php  App托管平台
 * ==============================================
 * Copy right 2015-2022  by https://www.tianmtech.com/
 * ----------------------------------------------
 * This is not a free software, without any authorization is not allowed to use and spread.
 * ==============================================
 * @desc: App托管平台
 * @author: mukunhao <mukunhao@tianmtech.cn>
 * @date: 2022/12/14
 * @version: v1.0.0
 * @since: 2022/12/14 15:03
 */

namespace Tianmiao\Cloud\App\Package\General;

use Tianmiao\Cloud\App\Package\PackageClient;

class PackageGeneralClient extends PackageClient
{
    /**
     * @desc 获取渠道包数量
     * @param $appAlias
     * @return array|bool
     * @throws \Tianmiao\Cloud\Utils\TianmiaoCloudException
     * @author mukunhao<mukunhao@tianmtech.cn>
     * @date 2022/12/14 15:06
     * @apilink
     */
    public function getChannelPackageNum($appAlias)
    {
        return $this->request('/api/channel/package/num', 'get', array(
            'alias' => $appAlias
        ));
    }
}