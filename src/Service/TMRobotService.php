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
     * 发送文本消息
     * @param string|array|int $text
     * @param array $option
     *          string robot_url 机器人地址，默认取env  QYWX_ROBOT_URL
     * @return array
     */
    public function sendTextMsg($text, array $option = array())
    {
        try {
            $robotUrl = "";
            if (!empty($option['robot_url'])) {
                $robotUrl = $option['robot_url'];
            } else if (!empty(getenv("QYWX_ROBOT_URL"))) {
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
            } else {
                throw new TianmiaoCloudException(990020, '机器人消息发送失败，机器人链接不能为空');
            }
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
//     * @param $robot_url
//     * @return array
//     */
//    public function sendInteractiveMsg($data, $robot_url) {
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
//        return $this->requestApi($body, $robot_url);
//    }
//
//    /**
//     * 富文本消息
//     * @param $data
//     * --title 标题
//     * --content 标题
//     * @param $robot_url
//     * @return array
//     */
//    public function sendPostMsg($data, $robot_url) {
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
//        return $this->requestApi($body, $robot_url);
//    }
//
//
//    /**
//     * 发送群名片
//     * @param $data
//     * --share_chat_id 名片ID
//     * @param $robot_url
//     * @return array
//     */
//    public function sendShareChatMsg($data, $robot_url) {
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
//        return $this->requestApi($body, $robot_url);
//    }
//
//
//    /**
//     * 发送图片
//     * @param $data
//     * --image_key 图片key
//     * @param $robot_url
//     * @return array
//     */
//    public function sendImageMsg($data, $robot_url) {
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
//        return $this->requestApi($body, $robot_url);
//    }


    /**
     * 请求飞书API
     * @param $body
     * @param $robot_url
     * @return array
     */
    protected function requestApi($body, $robot_url)
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
