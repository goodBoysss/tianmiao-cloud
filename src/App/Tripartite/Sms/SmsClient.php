<?php
/**
 * SmsClient.php
 * ==============================================
 * Copy right 2015-2021  by https://www.tianmtech.com/
 * ----------------------------------------------
 * This is not a free software, without any authorization is not allowed to use and spread.
 * ==============================================
 * @desc : 三方管理平台-短信服务
 * @author: zhanglinxiao<zhanglinxiao@tianmtech.cn>
 * @date: 2022/09/02
 * @version: v1.0.0
 * @since: 2022/09/02 09:11
 */


namespace Tianmiao\Cloud\App\Tripartite\Sms;

use Tianmiao\Cloud\App\Tripartite\TripartiteClient;

class SmsClient extends TripartiteClient
{
    /**@var $this */
    static protected $instance;

    public $smsIsOpen;

    public $smsMobileWhiteList;


    protected function init($config)
    {
        if (isset($config['sms_is_open'])) {
            $this->smsIsOpen = $config['sms_is_open'];
        }

        if (isset($config['sms_mobile_white_list'])) {
            $this->smsMobileWhiteList = $config['sms_mobile_white_list'];
        }

        parent::init($config);
    }

    /**
     * 发送短信
     * @param string $mobile 手机号
     * @param int $type 类型：2-登录；3-注册...
     * @param array $params
     *              code  int  验证码
     * @return bool true-发送请求成功
     * @throws \Tianmiao\Cloud\Utils\TianmiaoCloudException
     */
    private function sendSms($mobile, $type, $params)
    {
        $reqParams = array(
            'mobile' => $mobile,
            'type' => $type,
            'params' => json_encode($params),
        );
        return $this->request('/sms/send', 'post', $reqParams, array(
            'return_format' => 'bool'
        ));
    }

    /**
     * 发送验证码短信短信
     * @param string $mobile 手机号
     * @param int $type 类型：2-登录；3-注册...
     * @param int $code 验证码
     * @return bool
     * @throws \Tianmiao\Cloud\Utils\TianmiaoCloudException
     */
    public function sendSmsCode($mobile, $type, $code)
    {
        return $this->sendSms($mobile, $type, array(
            'code' => $code
        ));
    }


    /**
     * 检查短信发送白名单
     * @param $mobile
     * @return bool
     */
    public function checkSendWhite($mobile)
    {
        if (isset($this->smsIsOpen)) {
            if ($this->smsIsOpen == 0) {
                if (!empty($this->smsMobileWhiteList)) {
                    $smsMobileWhiteList = explode(',', $this->smsMobileWhiteList);
                    if (in_array($mobile, $smsMobileWhiteList)) {
                        return true;
                    } else {
                        return false;
                    }
                }
                return false;
            }

        }
        return true;
    }


}