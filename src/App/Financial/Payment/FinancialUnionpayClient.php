<?php
/**
 * FinancialVerifyClient.php
 * ==============================================
 * Copy right 2015-2021  by https://www.tianmtech.com/
 * ----------------------------------------------
 * This is not a free software, without any authorization is not allowed to use and spread.
 * ==============================================
 * @desc : 财务平台-要素认证
 * @author: zhanglinxiao<zhanglinxiao@tianmtech.cn>
 * @date: 2022/09/29
 * @version: v1.0.0
 * @since: 2022/09/29 09:11
 */


namespace Tianmiao\Cloud\App\Financial\Verify;

use Tianmiao\Cloud\App\Financial\FinancialClient;

class FinancialVerifyClient extends FinancialClient
{
    /**@var $this */
    static protected $instance;

    /**
     * 银联支付宝h5支付
     * @param array $params 认证信息
     *          user_id    用户ID           必填
     *          nickname     用户昵称       必填
     *          user_code     用户code        必填
     *          money     充值金额，分        必填
     *          order_sn     订单号           必填
     *          subject     主题              必填
     *          order_create_time     订单创建时间       必填
     *          return_url     支付成功返回地址       非必填
     *          passback_params     额外参数       非必填
     *          expire_time     过期时间，例如"2022-11-03 13:00:00"       非必填
     * @return array
     *          merchant_uuid  商户uuid
     *          merchant_name   商户名称
     *          pay_result   支付结果参数，用于唤起支付平台
     * @throws \Tianmiao\Cloud\Utils\TianmiaoCloudException
     */
    public function aliH5Pay($params)
    {
        return $this->request('/pay/union/ali/h5', 'post', $params, array(
            'return_format' => 'data'
        ));
    }

    /**
     * 银联支付宝APP支付
     * @param array $params 认证信息
     *          user_id    用户ID           必填
     *          nickname     用户昵称       必填
     *          user_code     用户code        必填
     *          money     充值金额，分        必填
     *          order_sn     订单号           必填
     *          subject     主题              必填
     *          order_create_time     订单创建时间       必填
     *          passback_params     额外参数       非必填
     *          expire_time     过期时间，例如"2022-11-03 13:00:00"       非必填
     * @return array
     *          merchant_uuid  商户uuid
     *          merchant_name   商户名称
     *          pay_result   支付结果参数，用于唤起支付平台
     * @throws \Tianmiao\Cloud\Utils\TianmiaoCloudException
     */
    public function aliAppPay($params)
    {
        return $this->request('/pay/union/ali/app', 'post', $params, array(
            'return_format' => 'data'
        ));
    }

    /**
     * 银联微信h5支付
     * @param array $params 认证信息
     *          user_id    用户ID           必填
     *          nickname     用户昵称       必填
     *          user_code     用户code        必填
     *          money     充值金额，分        必填
     *          order_sn     订单号           必填
     *          subject     主题              必填
     *          order_create_time     订单创建时间       必填
     *          return_url     支付成功返回地址       非必填
     *          passback_params     额外参数       非必填
     *          expire_time     过期时间，例如"2022-11-03 13:00:00"       非必填
     * @return array
     *          merchant_uuid  商户uuid
     *          merchant_name   商户名称
     *          pay_result   支付结果参数，用于唤起支付平台
     * @throws \Tianmiao\Cloud\Utils\TianmiaoCloudException
     */
    public function wxH5Pay($params)
    {
        return $this->request('/pay/union/wx/h5', 'post', $params, array(
            'return_format' => 'data'
        ));
    }

    /**
     * 银联微信APP支付
     * @param array $params 认证信息
     *          user_id    用户ID           必填
     *          nickname     用户昵称       必填
     *          user_code     用户code        必填
     *          money     充值金额，分        必填
     *          order_sn     订单号           必填
     *          subject     主题              必填
     *          order_create_time     订单创建时间       必填
     *          passback_params     额外参数       非必填
     *          expire_time     过期时间，例如"2022-11-03 13:00:00"       非必填
     * @return array
     *          merchant_uuid  商户uuid
     *          merchant_name   商户名称
     *          pay_result   支付结果参数，用于唤起支付平台
     * @throws \Tianmiao\Cloud\Utils\TianmiaoCloudException
     */
    public function wxAppPay($params)
    {
        return $this->request('/pay/union/wx/app', 'post', $params, array(
            'return_format' => 'data'
        ));
    }


}