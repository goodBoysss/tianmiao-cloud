<?php
/**
 * QywxRobotService.php
 * ==============================================
 * Copy right 2015-2021  by https://www.tianmtech.com/
 * ----------------------------------------------
 * This is not a free software, without any authorization is not allowed to use and spread.
 * ==============================================
 * @desc : 企业微信机器人服务
 * @author: zhanglinxiao<zhanglinxiao@tianmtech.cn>
 * @date: 2022/12/07
 * @version: v1.0.0
 * @since: 2022/12/07 09:11
 */


namespace Tianmiao\Cloud\Service;

class QywxRobotService
{

    /**
     * @var $this
     */
    private static $instance;

    /**
     * 实例化
     */
    public static function getInstance()
    {
        if (isset(self::$instance)) {
            $instance = self::$instance;
        } else {
            $instance = new self();
            self::$instance = $instance;
        }

        return $instance;
    }

    /**
     * 发送文本消息
     * @param string|array|int $text
     * @param $robotUrl
     * @return array
     */
    public function sendTextMsg($text, $robotUrl = "")
    {
        try {
            if (empty($robotUrl)) {
                $robotUrl = getenv("QYWX_ROBOT_URL");
            }

            if (!empty($robotUrl)) {
                if (is_array($text)) {
                    $text = json_encode($text, JSON_UNESCAPED_UNICODE);
                } elseif (is_object($text)) {
                    $text = json_encode($text, JSON_UNESCAPED_UNICODE);
                }

                //企业微信机器人文本内容，最长不超过2048个字节，必须是utf8编码
                $text = mb_substr($text, 0, 500);

                $body = array(
                    "msgtype" => "text",
                    "text" => array(
                        "content" => $text
                    ),
                );

                return $this->requestApi($body, $robotUrl);
            }
        } catch (\Throwable $t) {

        }
    }

    /**
     * 请求飞书API
     * @param $body
     * @param $robot_url
     * @return array
     */
    public function requestApi($body, $robot_url)
    {
        $result = true;
        $error = "";

        try {
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => $robot_url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => json_encode($body),
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json'
                ),
            ));

            $req_result = curl_exec($curl);

            curl_close($curl);


            if (is_string($req_result)) {
                $req_result = json_decode($req_result, true);
            }

            if (isset($req_result['StatusCode']) && $req_result['StatusCode'] == 0) {
                $result = true;
            } else {
                $result = false;
                $error = "发送请求失败";
                if (!empty($req_result['StatusMessage'])) {
                    $error = $req_result['StatusMessage'];
                } elseif (!empty($req_result['msg'])) {
                    $error = $req_result['msg'];
                }
            }

        } catch (\Exception $e) {
            $result = false;
            $error = $e->getMessage();
        }

        return array(
            'result' => $result,
            'error' => $error,
        );
    }


}
