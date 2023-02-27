<?php
/**
 * TMRobotService.php
 * ==============================================
 * Copy right 2015-2021  by https://www.tianmtech.com/
 * ----------------------------------------------
 * This is not a free software, without any authorization is not allowed to use and spread.
 * ==============================================
 * @desc : 机器人服务(目前仅支持：企业微信，后期会加入：钉钉，华为等)
 * @author: zhanglinxiao<zhanglinxiao@tianmtech.cn>
 * @date: 2022/12/07
 * @version: v1.0.0
 * @since: 2022/12/07 09:11
 */


namespace Tianmiao\Cloud\Service;

use Tianmiao\Cloud\Utils\TianmiaoCloudException;

class TMRobotService
{

    /**
     * @var $this
     */
    private static $instance;

    private $ROBOT_TYPES = array(
        1 => "企业微信",
        2 => "钉钉",
        3 => "飞书",
    );

    /**
     * 实例化
     */
    public static function getInstance()
    {
//        if (isset(self::$instance)) {
//            $instance = self::$instance;
//        } else {
//            $instance = new self();
//            self::$instance = $instance;
//        }

        return new self();
    }

    /**
     * @desc: 获取机器人url
     * @param $option
     * @return string
     * User: zhanglinxiao<zhanglinxiao@tianmtech.cn>
     * DateTime: 2023/02/27 13:09
     */
    private function getRobotUrl($option = array())
    {
        $robotUrl = "";
        if (!empty($option['robot_url'])) {
            $robotUrl = $option['robot_url'];
        } else if (!empty(getenv("QYWX_ROBOT_URL"))) {
            $robotUrl = getenv("QYWX_ROBOT_URL");
        }

        if (empty($robotUrl)) {
            throw new TianmiaoCloudException(990020, '机器人消息发送失败，机器人链接不能为空');
        }

        return $robotUrl;
    }

    /**
     * @desc: 获取机器人类型
     * @param $robotUrl
     * @return int 1-企业微信；
     * @throws TianmiaoCloudException
     * User: zhanglinxiao<zhanglinxiao@tianmtech.cn>
     * DateTime: 2023/02/27 13:31
     */
    private function getRobotType($robotUrl)
    {
        $robotType = 0;

        $urlInfo = parse_url($robotUrl);
        if (!empty($urlInfo['host'])) {
            $host = $urlInfo['host'];
            if ($host === "qyapi.weixin.qq.com") {
                $robotType = 1;
            } elseif ($host === "oapi.dingtalk.com") {
                $robotType = 2;
            } elseif ($host === "open.feishu.cn") {
                $robotType = 3;
            }
        }

        if (empty($this->ROBOT_TYPES[$robotType])) {
            throw new TianmiaoCloudException(990020, '机器人地址不合法或暂不支持该发送通道');
        }

        return $robotType;
    }

    /**
     * @desc: 构建文本消息body
     * @param $text
     * @param $robotType
     * @return array
     * User: zhanglinxiao<zhanglinxiao@tianmtech.cn>
     * DateTime: 2023/02/27 13:27
     */
    private function buildTextMsgBody($text, $robotType)
    {
        $body = array();

        if (is_array($text)) {
            $text = json_encode($text, JSON_UNESCAPED_UNICODE);
        } elseif (is_object($text)) {
            $text = json_encode($text, JSON_UNESCAPED_UNICODE);
        }

        if ($robotType == 1) {//企业微信

            //企业微信机器人文本内容，最长不超过2048个字节，必须是utf8编码
            $text = mb_substr($text, 0, 500);

            $body = array(
                "msgtype" => "text",
                "text" => array(
                    "content" => $text
                ),
            );
        } elseif ($robotType === 2) {//钉钉

            //钉钉机器人文本内容，最长不超过20000个字节
            $text = mb_substr($text, 0, 5000);

            $body = array(
                "msgtype" => "text",
                "text" => array(
                    "content" => $text
                ),
            );
        } elseif ($robotType === 3) {//飞书

            //飞书机器人文本内容，最长不超过30kb
            $text = mb_substr($text, 0, 7000);

            $body = array(
                "msg_type" => "text",
                "content" => array(
                    "text" => $text
                ),
            );
        }
        return $body;
    }


    /**
     * 发送文本消息
     * @param string|array|int $text
     * @param array $option
     *          string robot_url 机器人地址，默认取env  QYWX_ROBOT_URL
     * @return array
     */
    public function sendTextMsg($text, array $option = array())
    {
        try {
            //获取机器人url
            $robotUrl = $this->getRobotUrl($option);
            //获取机器人类型
            $robotType = $this->getRobotType($robotUrl);
            //构建文本消息body
            $body = $this->buildTextMsgBody($text, $robotType);

            return $this->requestApi($body, $robotUrl, $robotType);
        } catch (\Throwable $t) {
            return array(
                'result' => false,
                'error' => $t->getMessage(),
            );
        }
    }
//
//    /**
//     * 发送消息卡片
//     * @param $data
//     * --title 消息标题
//     * --content 消息内容
//     * --button_url 按钮url
//     * --button_text 按钮文字
//     * @param $robotUrl
//     * @return array
//     */
//    public function sendInteractiveMsg($data, $robotUrl) {
//
//        $title = "";
//        if (!empty($data['title'])) {
//            $title = $data['title'];
//        }
//
//        $content = "";
//        if (!empty($data['content'])) {
//            $content = $data['content'];
//        }
//
//        $button_url = "";
//        if (!empty($data['button_url'])) {
//            $button_url = $data['button_url'];
//        }
//
//        $button_text = "查看明细";
//        if (!empty($data['button_text'])) {
//            $button_text = $data['button_text'];
//        }
//
//        $body = array(
//            "msg_type" => "interactive",
//            "card" => array(
//                "config" => array(
//                    "wide_screen_mode" => true,
//                    "enable_forward" => true,
//                ),
//
//                "elements" => array(
//                    array(
//                        "tag" => "div",
//                        "text" => array(
//                            "content" => $content,
//                            "tag" => "lark_md"
//                        )
//                    ),
//
////                    array(
////                        "actions" => array(
////                            array(
////                                "tag" => "button",
////                                "text" => array(
////                                    "content" => $button_text,
////                                    "tag" => "lark_md",
////                                ),
////                                "url" => $button_url,
////                                "type" => "default",
////                                "value" => (object)array()
////                            )
////                        ),
////
////                        "tag" => "action"
////                    )
//                ),
//
//
////                "header" => array(
////                    "title" => array(
////                        "content" => $title,
////                        "tag" => "plain_text",
////                    )
////                )
//            ),
//        );
//
//
//        if (!empty($button_url)) {
//            $body['card']['elements'][] = array(
//                "actions" => array(
//                    array(
//                        "tag" => "button",
//                        "text" => array(
//                            "content" => $button_text,
//                            "tag" => "lark_md",
//                        ),
//                        "url" => $button_url,
//                        "type" => "default",
//                        "value" => (object)array()
//                    )
//                ),
//
//                "tag" => "action"
//            );
//        }
//
//
//        if (!empty($title)) {
//            $body['card']['header'] = array(
//                "title" => array(
//                    "content" => $title,
//                    "tag" => "plain_text",
//                )
//            );
//        }
//
//        return $this->requestApi($body, $robotUrl);
//    }
//
//    /**
//     * 富文本消息
//     * @param $data
//     * --title 标题
//     * --content 标题
//     * @param $robotUrl
//     * @return array
//     */
//    public function sendPostMsg($data, $robotUrl) {
//        $title = "";
//        if (!empty($data['title'])) {
//            $title = $data['title'];
//        }
//
//        $content = "";
//        if (!empty($data['content'])) {
//            $content = $data['content'];
//        }
//
//        $body = array(
//            "msg_type" => "post",
//            "content" => array(
//                "post" => array(
//                    "zh_cn" => array(
//                        "title" => $title,
//                        "content" => array($content)
//                    )
//                )
//            ),
//        );
//
//        return $this->requestApi($body, $robotUrl);
//    }
//
//
//    /**
//     * 发送群名片
//     * @param $data
//     * --share_chat_id 名片ID
//     * @param $robotUrl
//     * @return array
//     */
//    public function sendShareChatMsg($data, $robotUrl) {
//        $share_chat_id = "";
//        if (!empty($data['share_chat_id'])) {
//            $share_chat_id = $data['share_chat_id'];
//        }
//
//        $body = array(
//            "msg_type" => "share_chat",
//            "content" => array(
//                "share_chat_id" => $share_chat_id
//            ),
//        );
//
//        return $this->requestApi($body, $robotUrl);
//    }
//
//
//    /**
//     * 发送图片
//     * @param $data
//     * --image_key 图片key
//     * @param $robotUrl
//     * @return array
//     */
//    public function sendImageMsg($data, $robotUrl) {
//        $image_key = "";
//        if (!empty($data['image_key'])) {
//            $image_key = $data['image_key'];
//        }
//
//        $body = array(
//            "msg_type" => "image",
//            "content" => array(
//                "image_key" => $image_key
//            ),
//        );
//
//        return $this->requestApi($body, $robotUrl);
//    }


    /**
     * 请求飞书API
     * @param $body
     * @param $robotUrl
     * @param $robotType
     * @return array
     */
    protected function requestApi($body, $robotUrl, $robotType)
    {
        $result = true;
        $error = "";

        try {
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => $robotUrl,
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

            if ($robotType === 1){ //企业微信
                if (isset($req_result['errcode']) && $req_result['errcode'] == 0) {
                    $result = true;
                } else {
                    $result = false;
                    $error = "发送请求失败";
                    if (!empty($req_result['errmsg'])) {
                        $error = $req_result['errmsg'];
                    } elseif (!empty($req_result['msg'])) {
                        $error = $req_result['msg'];
                    }
                }
            } elseif ($robotType === 2){
                if (isset($req_result['errcode']) && $req_result['errcode'] == 0) {
                    $result = true;
                } else {
                    $result = false;
                    $error = "发送请求失败";
                    if (!empty($req_result['errmsg'])) {
                        $error = $req_result['errmsg'];
                    }
                }
            } elseif ($robotType === 3){
                if (isset($req_result['code']) && $req_result['code'] === 0) {
                    $result = true;
                } else {
                    $result = false;
                    $error = "发送请求失败";
                    if (!empty($req_result['msg'])) {
                        $error = $req_result['msg'];
                    }
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