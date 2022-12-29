<?php
/**
 * FinancialClient.php
 * ==============================================
 * Copy right 2015-2021  by https://www.tianmtech.com/
 * ----------------------------------------------
 * This is not a free software, without any authorization is not allowed to use and spread.
 * ==============================================
 * @desc : 财务平台
 * @author: zhanglinxiao<zhanglinxiao@tianmtech.cn>
 * @date: 2022/09/29
 * @version: v1.0.0
 * @since: 2022/09/29 09:11
 */


namespace Tianmiao\Cloud\App\Financial;

use Tianmiao\Cloud\Client;
use Tianmiao\Cloud\Utils\HttpRequest;

class FinancialClient extends Client
{
    public $envConfig = array(
        'host' => "FINANCIAL_HOST",
        'appId' => "FINANCIAL_APP_KEY",
        'appSecret' => "FINANCIAL_APP_SECRET",
    );

    /**
     * http请求-财务请求特殊处理
     * @param $path
     * @param $method
     * @param $params
     * @param $option
     * @return array|bool
     * @throws \Tianmiao\Cloud\Utils\TianmiaoCloudException
     */
    protected function request($path, $method, $params, $option = array())
    {
        $httpRequest = new HttpRequest();
        $option['app_id'] = $this->appId;
        $option['app_secret'] = $this->appSecret;
        $option['is_financial'] = 1;
        $result = $httpRequest->request($this->host, $path, $method, $params, $option);
        return $result;
    }


}