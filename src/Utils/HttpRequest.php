<?php

namespace Tianmiao\Cloud\Utils;

class HttpRequest extends \Exception
{

    /**
     * http请求
     * @param $host
     * @param $path
     * @param $method
     * @param $params
     * @param $option
     * @return array
     * @throws TianmiaoCloudException
     */
    public function request($host, $path, $method, array $params, $option = array())
    {
        $result = array();
        $url = $host . $path;
        if (isset($option['is_financial']) && $option['is_financial'] == 1) {
            $header = $this->getFinancialHeader($params, $option);
        } else {
            $header = $this->getHeader($params, $option);
        }

        $header["Content-Type"] = "application/json";
        try {
            if (strtolower($method) == 'post') {
                $reqResult = $this->sendPost($url, $params, $header, $option);
            } else {
                $reqResult = $this->sendGet($url, $params, $header);
            }

            if (!empty($reqResult) && is_string($reqResult)) {
                $reqResult = json_decode($reqResult, true);
                if (!empty($reqResult) && is_array($reqResult)) {
                    $result = $reqResult;
                }
            }

        } catch (\Throwable $e) {
            throw new TianmiaoCloudException(990010, $e->getMessage());
        }

        if (empty($result)) {
            throw new TianmiaoCloudException(990010);
        } else {
            $result = $this->dealReturn($result, $option);
        }

        return $result;
    }

    /**
     * 处理返回结果
     * @param $result
     * @param $option
     * @return bool|array
     * @throws TianmiaoCloudException
     */
    private function dealReturn($result, $option)
    {
        if (!empty($result['code']) && $result['code'] == 200) {

            $returnFormat = "";
            if (!empty($option['return_format'])) {
                $returnFormat = $option['return_format'];
            }

            //成功返回格式类型：bool-布尔值；data-返回data
            if ($returnFormat == "bool") {
                $result = true;
            } else {
                $result = $result['data'];
            }
        } else {
            $message = "";
            if (!empty($result['message'])) {
                $message = $result['message'];
            }
            throw new TianmiaoCloudException(990010, $message);
        }

        return $result;
    }

    /**
     * 获取请求头信息
     * @param $params
     * @param $option
     * @return array
     * @throws TianmiaoCloudException
     */
    private function getHeader($params, $option)
    {
        if (empty($option['app_id'])) {
            throw new TianmiaoCloudException(990002);
        }

        if (empty($option['app_secret'])) {
            throw new TianmiaoCloudException(990003);
        }

        $appId = $option['app_id'];
        $appSecret = $option['app_secret'];

        $timestamp = time();
        $params['timestamp'] = $timestamp;
        $params['appid'] = $appId;
        $sign = $this->generateSign($params, $appSecret);

        $header = array();
        $header[] = "timestamp:" . $timestamp;
        $header[] = "sign:" . $sign;
        $header[] = "appid:" . $appId;
        return $header;
    }

    /**
     * 获取财务请求头信息
     * @param $params
     * @param $option
     * @return array
     * @throws TianmiaoCloudException
     */
    private function getFinancialHeader($params, $option)
    {
        if (empty($option['app_id'])) {
            throw new TianmiaoCloudException(990002);
        }

        if (empty($option['app_secret'])) {
            throw new TianmiaoCloudException(990003);
        }

        $appId = $option['app_id'];
        $appSecret = $option['app_secret'];

        $timestamp = time();
        $params['timestamp'] = $timestamp;
        $params['appkey'] = $appId;
        $sign = $this->generateSign($params, $appSecret);

        $header = array();
        $header[] = "timestamp:" . $timestamp;
        $header[] = "sign:" . $sign;
        $header[] = "appkey:" . $appId;
        return $header;
    }

    /**
     * 生成签名
     * @param $params
     * @param $secret
     * @return string
     */
    public function generateSign($params, $secret)
    {
        $keys = array_keys($params);
        arsort($keys);
        $str = '';
        foreach ($keys as $key) {
            $str .= $key . $params[$key];
        }

        $str .= $secret;
        $sig = md5($str);
        return $sig;
    }

    /**
     * 发送post 请求
     * @param $url
     * @param $param
     * @param array $header
     * @param array $option
     * @return bool|string
     */
    private function sendPost($url, $param, $header = [], array $option = [])
    {
        $ch = curl_init();//①：初始化
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        if (!empty($header)) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        }

        //获取连接超时时间
        $connectTimeOut = $this->getConnectTimeOut($option);

        //获取执行超时时间
        $timeOut = $this->getTimeOut($option);

        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $param);
        //连接超时时间
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $connectTimeOut);
        //执行超时时间
        curl_setopt($ch, CURLOPT_TIMEOUT, $timeOut);

        $content = curl_exec($ch);//③：执行并获取结果
        $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        if ($code != 200) return false;
        curl_close($ch);//④：释放句柄
        return $content;
    }

    /**
     * get 请求
     * @param $url
     * @param $params
     * @param array $header
     * @param array $option
     * @return bool|string
     */
    private function sendGet($url, $params, $header = [], array $option = [])
    {
        //构造请求参数
        $param = http_build_query($params);
        $url = $url . '?' . $param;
        //初始化
        $ch = curl_init();
        if (!empty($header)) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        }

        //获取连接超时时间
        $connectTimeOut = $this->getConnectTimeOut($option);

        //获取执行超时时间
        $timeOut = $this->getTimeOut($option);

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        //连接超时时间
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $connectTimeOut);
        //执行超时时间
        curl_setopt($ch, CURLOPT_TIMEOUT, $timeOut);
        $content = curl_exec($ch);
        $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        if ($code != 200) return false;
        curl_close($ch);
        return $content;
    }

    /**
     * @desc: 获取执行超时时间
     * @param $option
     * @return int
     * User: zhanglinxiao<zhanglinxiao@tianmtech.cn>
     * DateTime: 2023/02/16 18:29
     */
    private function getTimeOut($option)
    {
        $timeOut = 30;
        if (!empty($option['time_out'])) {
            $option['time_out'] = (int)$option['time_out'];
            if ($option['time_out'] > 0) {
                $timeOut = $option['time_out'];
            }
        }
        return $timeOut;
    }

    /**
     * @desc: 获取连接超时时间
     * @param $option
     * @return int
     * User: zhanglinxiao<zhanglinxiao@tianmtech.cn>
     * DateTime: 2023/02/16 18:29
     */
    private function getConnectTimeOut($option)
    {
        $connectTimeOut = 30;
        if (!empty($option['connect_time_out'])) {
            $option['connect_time_out'] = (int)$option['connect_time_out'];
            if ($option['connect_time_out'] > 0) {
                $connectTimeOut = $option['connect_time_out'];
            }
        }
        return $connectTimeOut;
    }
}