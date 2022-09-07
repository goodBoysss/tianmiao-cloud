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
        $header = $this->getHeader($params, $option);
        $header["Content-Type"] = "application/json";
        try {
            if (strtolower($method) == 'post') {
                $reqResult = $this->sendPost($url, $params, $header);
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
            Throw new TianmiaoCloudException(990010, $e->getMessage());
        }

        if (empty($result)) {
            Throw new TianmiaoCloudException(990010);
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
            Throw new TianmiaoCloudException(990010, $message);
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
            Throw new TianmiaoCloudException(990002);
        }

        if (empty($option['app_secret'])) {
            Throw new TianmiaoCloudException(990003);
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
     * @return bool|string
     */
    private function sendPost($url, $param, $header = [])
    {
        $ch = curl_init();//①：初始化
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        if (!empty($header)) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        }
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $param);
        //连接超时时间
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
        //执行超时时间
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);

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
     * @return bool|string
     */
    private function sendGet($url, $params, $header = [])
    {
        //构造请求参数
        $param = http_build_query($params);
        $url = $url . '?' . $param;
        //初始化
        $ch = curl_init();
        if (!empty($header)) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        }
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        //连接超时时间
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
        //执行超时时间
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        $content = curl_exec($ch);
        $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        if ($code != 200) return false;
        curl_close($ch);
        return $content;
    }
}