<?php
/**
 * TripartiteClient.php
 * ==============================================
 * Copy right 2015-2021  by https://www.tianmtech.com/
 * ----------------------------------------------
 * This is not a free software, without any authorization is not allowed to use and spread.
 * ==============================================
 * @desc : 三方管理平台
 * @author: zhanglinxiao<zhanglinxiao@tianmtech.cn>
 * @date: 2022/09/02
 * @version: v1.0.0
 * @since: 2022/09/02 09:11
 */

namespace Tianmiao\Cloud;


use Tianmiao\Cloud\Utils\HttpRequest;
use Tianmiao\Cloud\Utils\TianmiaoCloudException;

abstract class Client
{
    public $host;

    public $appId;

    public $appSecret;

    //环境变量配置项
    public $envConfig = array();
    /**
     * @var $this
     */
    static protected $instance;

    /**
     * 初始化
     * @param array $config 应用配置
     * @param array $option 额外选项
     * @return $this
     */
    static function getInstance($config = array())
    {
        if (is_null(self::$instance)) {
            $instance = new static();
            $instance->init($config);

            self::$instance = $instance;
        }

        return self::$instance;
    }


    private function init($config)
    {
        if (!empty($config['host'])) {
            $this->host = $config['host'];
        }

        if (!empty($config['app_id'])) {
            $this->appId = $config['app_id'];
        }

        if (!empty($config['app_secret'])) {
            $this->appSecret = $config['app_secret'];
        }

        //通过环境变量取值
        $this->initConfigByEnv();

        //检查初始化配置参数
        $this->checkConfig();
    }

    /**
     * 通过环境变量取值
     */
    private function initConfigByEnv()
    {
        $envConfig = $this->envConfig;
        if (!empty($envConfig)) {
            foreach ($envConfig as $key => $envKey) {
                if (empty($this->$key)) {
                    $value = getenv($envKey);
                    if (isset($value) && !empty($key)) {
                        $this->$key = $value;
                    }
                }
            }
        }
    }

    /**
     * 检查配置项参数
     * @throws TianmiaoCloudException
     */
    private function checkConfig()
    {
        if (empty($this->host)) {
            Throw new TianmiaoCloudException(990001);
        }

        if (empty($this->appId)) {
            Throw new TianmiaoCloudException(990002);
        }

        if (empty($this->appSecret)) {
            Throw new TianmiaoCloudException(990003);
        }

    }

    /**
     * http请求
     * @param $path
     * @param $method
     * @param $params
     * @param $option
     * @return array|bool
     * @throws TianmiaoCloudException
     */
    protected function request($path, $method, $params, $option)
    {
        $httpRequest = new HttpRequest();
        $option = array(
            'app_id' => $this->appId,
            'app_secret' => $this->appSecret,
        );
        $result = $httpRequest->request($this->host, $path, $method, $params, $option);
        return $result;
    }


}