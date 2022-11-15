<?php
/**
 * Client.php
 * ==============================================
 * Copy right 2015-2021  by https://www.tianmtech.com/
 * ----------------------------------------------
 * This is not a free software, without any authorization is not allowed to use and spread.
 * ==============================================
 * @desc : 公共服务客户端
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

    //环境变量配置项（通用参数）
    protected $envGeneralConfig = array(
        'appId' => "GENERAL_APP_ID",
        'appSecret' => "GENERAL_APP_SECRET"
    );

    /**
     * @var $this
     */
    static protected $instance;

    /**
     * 初始化（单例）
     * @param array $config 应用配置
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

    /**
     * 初始化（每次都重新初始化）
     * @param array $config 应用配置
     * @return $this
     */
    static function newInstance($config = array())
    {
        $instance = new static();
        $instance->init($config);
        return $instance;
    }


    protected function init($config)
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
                    if ($value !== false && !empty($key)) {
                        $this->$key = $value;
                    }
                }
            }
        }

        //兼容公共服务间通用配置项
        $envGeneralConfig = $this->envGeneralConfig;
        if (!empty($envGeneralConfig)) {
            foreach ($envGeneralConfig as $key => $envKey) {
                if (empty($this->$key)) {
                    $value = getenv($envKey);
                    if ($value !== false && !empty($key)) {
                        $this->$key = $value;
                    }
                }
            }
        }
    }

    /**
     * 检查配置项参数
     * @throws TianmiaoCloudException
     * @return null
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
    protected function request($path, $method, $params, $option = array())
    {
        $httpRequest = new HttpRequest();
        $option['app_id'] = $this->appId;
        $option['app_secret'] = $this->appSecret;
        $result = $httpRequest->request($this->host, $path, $method, $params, $option);
        return $result;
    }

    /**
     * 获取客户端真实IP
     * @return string
     */
    protected function getClientIp()
    {
        $ip = "";

        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } elseif (!empty($_SERVER['REMOTE_ADDR'])) {
            $ip = $_SERVER['REMOTE_ADDR'];
        }

        return $ip;
    }


}