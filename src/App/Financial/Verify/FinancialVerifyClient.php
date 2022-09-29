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
     * 用户信息验证
     * @param array $params 认证信息
     *          truename    真实姓名
     *          id_card     身份证号码
     *          alipay_account     支付宝提现账户
     *          mobile     手机号
     *          user_id     用户ID
     *          user_code     用户编号
     *          nickname     用户呢称
     * @return array
     *          status  状态：1-申请认证提交成功；0-申请认证提交失败；
     *          error   申请认证提交失败错误信息
     * @throws \Tianmiao\Cloud\Utils\TianmiaoCloudException
     */
    public function verifyUser($params)
    {
        return $this->request('/verify/user', 'post', $params, array(
            'return_format' => 'bool'
        ));
    }


}