<?php
/**
 * CheckClient.php  内容检测
 * ==============================================
 * Copy right 2015-2022  by https://www.tianmtech.com/
 * ----------------------------------------------
 * This is not a free software, without any authorization is not allowed to use and spread.
 * ==============================================
 * @desc: 内容检测
 * @author: yangwenjie <yangwenjie@tianmtech.cn>
 * @date: 2022/10/22
 * @version: v1.2.0
 * @since: 2022/10/22 15:06
 */

namespace Tianmiao\Cloud\App\Security\Check;

use Tianmiao\Cloud\App\Security\SecurityClient;

class SecurityCheckClient extends SecurityClient
{
    /**@var $this */
    static protected $instance;

    /**
     * 文本检测
     * @param array $params 文本检测参数
     * @remark 类型 字段名 是否必传 说明
     * @sonParam int app_key_id int 否 业务端关联id
     * @sonParam string content 是 文本内容
     * @sonParam string content_origin 否 原始内容
     * @sonParam int channel_id 是 内容渠道id
     * @sonParam int user_id 是 用户id
     * @sonParam int/string user_code 是 用户code
     * @sonParam string nickname 是 用户昵称
     * @sonParam string action_time 是 发生时间
     * @sonParam string ip 是 ip地址
     * @sonParam string device_id  是 设备标识
     * @sonParam int/string room_id  否 房间号
     * @sonParam string(json字符串) params 是 额外的参数如手机号{"mobile":18668463780}
     * @return array|bool
     * @throws \Tianmiao\Cloud\Utils\TianmiaoCloudException
     * @author yangwenjie <yangwenjie@tianmtech.cn>
     * @datetime 2022/10/22 15:19
     */
    public function checkText($params)
    {
        return $this->request('/api/content/check/text', 'post', $params, array(
            'return_format' => 'data'
        ));
    }

    /**
     * 图片检测
     * @param array $params 图片检测参数
     * @remark 类型 字段名 是否必传 说明
     * @sonParam int app_key_id int 否 业务端关联id
     * @sonParam string content 是 图片地址(最好是obs或者oss的地址)
     * @sonParam string content_origin 否 原始图片地址(最好是obs或者oss的地址)
     * @sonParam int channel_id 是 内容渠道id
     * @sonParam int user_id 是 用户id
     * @sonParam int/string user_code 是 用户code
     * @sonParam string nickname 是 用户昵称
     * @sonParam string action_time 是 发生时间
     * @sonParam string ip 是 ip地址
     * @sonParam string device_id  是 设备标识
     * @sonParam int/string room_id  否 房间号
     * @sonParam string(json字符串) params 是 额外的参数如手机号{"mobile":18668463780}
     * @return array|bool
     * @throws \Tianmiao\Cloud\Utils\TianmiaoCloudException
     * @author yangwenjie <yangwenjie@tianmtech.cn>
     * @datetime 2022/10/22 15:19
     */
    public function checkImage($params)
    {
        return $this->request('/api/content/check/image', 'post', $params, array(
            'return_format' => 'data'
        ));
    }

    /**
     * 音频文件检测
     * @param array $params 音频文件检测参数
     * @remark 类型 字段名 是否必传 说明
     * @sonParam int app_key_id int 否 业务端关联id
     * @sonParam string content 是 音频地址(最好是obs或者oss的地址)
     * @sonParam string content_origin 否 原始音频地址(最好是obs或者oss的地址)
     * @sonParam int channel_id 是 内容渠道id
     * @sonParam int user_id 是 用户id
     * @sonParam int/string user_code 是 用户code
     * @sonParam string nickname 是 用户昵称
     * @sonParam string action_time 是 发生时间
     * @sonParam string ip 是 ip地址
     * @sonParam string device_id  是 设备标识
     * @sonParam int/string room_id  否 房间号
     * @sonParam string(json字符串) params 是 额外的参数如手机号{"mobile":18668463780}
     * @return array|bool
     * @throws \Tianmiao\Cloud\Utils\TianmiaoCloudException
     * @author yangwenjie <yangwenjie@tianmtech.cn>
     * @datetime 2022/10/22 15:19
     */
    public function checkAudioFile($params)
    {
        return $this->request('/api/content/check/audio/file', 'post', $params, array(
            'return_format' => 'data'
        ));
    }

    /**
     * 视频文件检测
     * @param array $params 视频文件检测参数
     * @remark 类型 字段名 是否必传 说明
     * @sonParam int app_key_id int 否 业务端关联id
     * @sonParam string content 是 视频地址(最好是obs或者oss的地址)
     * @sonParam string content_origin 否 原始视频地址(最好是obs或者oss的地址)
     * @sonParam int channel_id 是 内容渠道id
     * @sonParam int user_id 是 用户id
     * @sonParam int/string user_code 是 用户code
     * @sonParam string nickname 是 用户昵称
     * @sonParam string action_time 是 发生时间
     * @sonParam string ip 是 ip地址
     * @sonParam string device_id  是 设备标识
     * @sonParam int/string room_id  否 房间号
     * @sonParam string(json字符串) params 是 额外的参数如手机号{"mobile":18668463780}
     * @return array|bool
     * @throws \Tianmiao\Cloud\Utils\TianmiaoCloudException
     * @author yangwenjie <yangwenjie@tianmtech.cn>
     * @datetime 2022/10/22 15:19
     */
    public function checkVideoFile($params)
    {
        return $this->request('/api/content/check/video/file', 'post', $params, array(
            'return_format' => 'data'
        ));
    }

    /**
     * 组合内容检测
     * @param array $params 组合内容检测参数
     * @remark 类型 字段名 是否必传 说明
     * @sonParam int app_key_id int 否 业务端关联id
     * @sonParam string text 否 组合内容中的文本
     * @sonParam string image_url_json 否 组合内容中的多张图片地址例如["obs地址","obs地址"]
     * @sonParam string video_url 否 组合内容中的视频地址
     * @sonParam int channel_id 是 内容渠道id
     * @sonParam int user_id 是 用户id
     * @sonParam int/string user_code 是 用户code
     * @sonParam string nickname 是 用户昵称
     * @sonParam string action_time 是 发生时间
     * @sonParam string ip 是 ip地址
     * @sonParam string device_id  是 设备标识
     * @sonParam int/string room_id  否 房间号
     * @sonParam string(json字符串) params 是 额外的参数如手机号{"mobile":18668463780}
     * @return array|bool
     * @throws \Tianmiao\Cloud\Utils\TianmiaoCloudException
     * @author yangwenjie <yangwenjie@tianmtech.cn>
     * @datetime 2022/10/22 15:19
     */
    public function checkMultiple($params)
    {
        return $this->request('/api/content/check/multiple', 'post', $params, array(
            'return_format' => 'data'
        ));
    }

    /**
     * 聊天检测
     * @param array $params 聊天内容检测参数
     * @remark 类型 字段名 是否必传 说明
     * @sonParam int app_key_id int 否 业务端关联id
     * @sonParam string content 是 可以是文本内容/图片地址/音频文件地址
     * @sonParam int content_type 是 1是文本 2是图片 3是音频文件
     * @sonParam int channel_id 是 内容渠道id
     * @sonParam int user_id 是 用户id
     * @sonParam int/string user_code 是 用户code
     * @sonParam int user_id_to 否 接收人用户id
     * @sonParam int/string user_code_to 否 接收人用户code
     * @sonParam string nickname 是 用户昵称
     * @sonParam string action_time 是 发生时间
     * @sonParam string ip 是 ip地址
     * @sonParam string device_id  是 设备标识
     * @sonParam int/string room_id  否 房间号
     * @sonParam string(json字符串) params 是 额外的参数如手机号{"mobile":18668463780}
     * @return array|bool
     * @throws \Tianmiao\Cloud\Utils\TianmiaoCloudException
     * @author yangwenjie <yangwenjie@tianmtech.cn>
     * @datetime 2022/10/22 15:19
     */
    public function checkChat($params)
    {
        return $this->request('/api/content/check/chat', 'post', $params, array(
            'return_format' => 'data'
        ));
    }

    /**
     * 音频流检测
     * @param array $params 音频流检测参数
     * @remark 类型 字段名 是否必传 说明
     * @sonParam int app_key_id int 否 业务端关联id
     * @sonParam int channel_id 是 内容渠道id
     * @sonParam int user_id 是 用户id
     * @sonParam int/string user_code 是 用户code
     * @sonParam int user_id_to 否 接收人用户id
     * @sonParam int/string user_code_to 否 接收人用户code
     * @sonParam string nickname 是 用户昵称
     * @sonParam string action_time 是 发生时间
     * @sonParam string ip 是 ip地址
     * @sonParam string device_id  是 设备标识
     * @sonParam int/string room_id  否 房间号
     * @sonParam string stream_audio_url  是 音频流链接
     * @sonParam string stream_type  是 音频流类型 现在支持 NORMAL(普通) ZEGO(即构)
     * @sonParam string(json字符串) params 是 额外的参数如手机号{"mobile":18668463780}
     * @otherRemark 如果是即构流 最后params参数中需要传入{"zego":{"token_id":"xxx","stream_id":"xxx","room_id":"xxx","test_env":"xxx"},"mobile":18668463780}
     * @return array|bool
     * @throws \Tianmiao\Cloud\Utils\TianmiaoCloudException
     * @author yangwenjie <yangwenjie@tianmtech.cn>
     * @datetime 2022/10/22 15:19
     */
    public function checkStreamAudio($params)
    {
        return $this->request('/api/content/check/stream/audio', 'post', $params, array(
            'return_format' => 'data'
        ));
    }

    /**
     * 音频流检测关闭（待定）
     * @param array $params 音频流检测参数
     * @remark 类型 字段名 是否必传 说明
     * @sonParam int app_key_id int 否 业务端关联id
     * @sonParam int channel_id 是 内容渠道id
     * @sonParam string stream_audio_url  是 音频流链接
     * @sonParam string stream_type  是 音频流类型 现在支持 NORMAL(普通) ZEGO(即构)
     * @return array|bool
     * @throws \Tianmiao\Cloud\Utils\TianmiaoCloudException
     * @author yangwenjie <yangwenjie@tianmtech.cn>
     * @datetime 2022/10/22 15:19
     */
    public function finishStreamAudio($params)
    {
        return $this->request('/api/content/finish/stream/audio', 'post', $params, array(
            'return_format' => 'data'
        ));
    }

    /**
     * FunctionName: verifyFraudUsers
     * Description: 验证诈骗信息接口
     * @remark 类型 字段名 是否必传 说明
     * @sonParam int user_id 是 用户id
     * @sonParam int user_code 是 用户编号
     * @sonParam string mobile 是 手机号
     * @sonParam string truename 是 真实姓名
     * @sonParam string identity_card 是 身份证号
     * @sonParam string device_id 是 设备编号
     * @sonParam string ip 是 ip
     * @sonParam int source 是 数据来源： 2登录触发 3注册触发 4认证触发
     *
     * @param $params
     * @return array|bool
     * @throws \Tianmiao\Cloud\Utils\TianmiaoCloudException
     */
    public function verifyFraudUsers($params)
    {
        return $this->request('/api/fraud/user/verify', 'post', $params, array(
            'return_format' => 'data'
        ));
    }

    /**
     * FunctionName: reportRiskUsers
     * Description: 上报诈骗信息接口
     * @remark 类型 字段名 是否必传 说明
     * @sonParam int user_id 是 用户id
     * @sonParam int user_code 是 用户编号
     * @sonParam string mobile 是 手机号
     * @sonParam string truename 是 真实姓名
     * @sonParam string identity_card 是 身份证号
     * @sonParam string device_id 是 设备编号
     * @sonParam string ip 是 ip
     * @sonParam int source 是 数据来源：1 业务上报
     *
     * @param $params
     * @return array|bool
     * @throws \Tianmiao\Cloud\Utils\TianmiaoCloudException
     */
    public function reportFraudUsers($params)
    {
        return $this->request('/api/fraud/user/report', 'post', $params, array(
            'return_format' => 'data'
        ));
    }
}