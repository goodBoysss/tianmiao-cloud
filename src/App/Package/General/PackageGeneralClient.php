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
     * @desc 获取渠道系统渠道包数量
     * @param $appAlias
     * @return array|bool
     * @throws \Tianmiao\Cloud\Utils\TianmiaoCloudException
     * @author mukunhao<mukunhao@tianmtech.cn>
     * @date 2022/12/14 15:06
     * @apilink
     */
    public function getChannelPackageNum($appAlias, $option = array())
    {
        $option = array_merge([
            'return_format' => 'data',
            'connect_timeout' => 3,
            'timeout' => 3
        ], $option);

        return $this->request('/api/channel/package/num', 'get', array(
            'alias' => $appAlias
        ), $option);
    }

    /**
     * @desc  获取推广系统渠道包数量
     * @param $appAlias
     * @return array|bool
     * @throws \Tianmiao\Cloud\Utils\TianmiaoCloudException
     * @author mukunhao<mukunhao@tianmtech.cn>
     * @date 2023/2/16 16:31
     */
    public function getPromotionPackageNum($appAlias, $option = [])
    {
        $option = array_merge([
            'return_format' => 'data',
            'connect_timeout' => 3,
            'timeout' => 3
        ], $option);

        return $this->request('/api/promotion/package/num', 'get', array(
            'alias' => $appAlias
        ), $option);
    }

    /**
     * @desc: 推广分析系统打包
     * @param string $appAlias 应用别名
     * @param string $channelCode 渠道CODE
     * @param array $option
     * @return array
     * @throws \Tianmiao\Cloud\Utils\TianmiaoCloudException
     * User: mukunhao<mukunhao@tianmtech.cn>
     * DateTime: 2023/03/07 11:43
     */
    public function promotionPack($appAlias, $channelCode, $option = [])
    {
        $option = array_merge($option, [
            'return_format'    => 'data',
            'connect_time_out' => 3,
            'time_out'         => 3,
        ]);
        $reqParams = [
            'app_alias'    => $appAlias,
            'channel_code' => $channelCode,
        ];

        return $this->request('/api/promotion/pack', 'post', $reqParams, $option);
    }
}