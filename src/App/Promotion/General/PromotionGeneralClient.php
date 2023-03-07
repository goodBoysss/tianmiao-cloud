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
use Tianmiao\Cloud\Utils\TianmiaoCloudException;

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

    /**
     * 批量获取渠道的包状态信息
     * @param $appAlias
     * @param $channelCodes
     * @return array
     * @throws TianmiaoCloudException
     * @author chengjiangang <chengjiangang@tianmtech.cn>
     * @datetime 2023/3/3 17:49
     */
    public function getAppPackagesStatus($appAlias, $channelCodes)
    {
        return $this->request('/api/app/packages/status', 'get', array(
            'app_alias' => $appAlias,
            'channel_codes' => $channelCodes,
        ));
    }

    /**
     * 通过别名和渠道包code回传打包状态
     * @params $appAlias 应用别名 例如 'qipao,youmi,qianhuan'
     * @params $channelCode 渠道code 例如 '100058'
     * @params $status 打包状态 例如 0=失败，1=成功
     * @params $packageUpdateTime 打包状态 例如 0=失败，1=成功
     * @params $msg 错误信息 例如 '服务器故障'
     * @return array|bool 返回示例(正常) {"code":200,"data":[],"message":"状态变更成功"}
     * @return array|bool 返回示例(异常-应用不存在) {"code":10001,"message":"与原状态一致，状态变更失败"}
     * @throws TianmiaoCloudException
     * @author chengjiangang <chengjiangang@tianmtech.cn>
     * @datetime 2023/3/3 17:49
     */
    public function callbackAppPackageStatus($appAlias, $channelCode, $status, $packageUpdateTime, $msg)
    {
        return $this->request('/api/app/package/callback/status', 'post', array(
            'app_alias' => $appAlias,
            'channel_code' => $channelCode,
            'status' => $status,
            'package_update_time' => $packageUpdateTime,
            'msg' => $msg,
        ));
    }

}