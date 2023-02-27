<?php

namespace Tianmiao\Cloud\Utils;

class TianmiaoCloudException extends \Exception
{
    public $codeInfo = array(
        //配置
        990000 => "未知错误",
        990001 => "应用host不能为空",
        990002 => "应用ID不能为空",
        990003 => "应用秘钥不能为空",
        //发起http请求失败
        990010 => "网络请求失败",
        //发起http请求失败
        990020 => "机器人消息发送失败",
        //三方管理-短信
        990101 => "短信类型不能为空",
    );

    public function __construct($code = 990000, $message = "")
    {
        if (empty($message)) {
            $codeInfo = $this->codeInfo;
            if (!empty($codeInfo[$code])) {
                $message = $codeInfo[$code];
            }
        }

        if (empty($message)) {
            $message = "未知错误";
        }
        parent::__construct($message, $code);
    }
}