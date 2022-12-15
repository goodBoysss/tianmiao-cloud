<?php
/**
 * MusicClient.php
 * ==============================================
 * Copy right 2015-2022  by https://www.tianmtech.com/
 * ----------------------------------------------
 * This is not a free software, without any authorization is not allowed to use and spread.
 * ==============================================
 * @desc:
 * @author: zhaoyanna <zhaoyanna@tianmtech.cn>
 * @date: 2022/12/08
 * @version: v1.0.0
 * @since: 2022/12/08 18:51
 */


namespace Tianmiao\Cloud\App\Tripartite\Music;


use Tianmiao\Cloud\App\Tripartite\TripartiteClient;

class MusicClient extends TripartiteClient
{
    /**@var $this */
    static protected $instance;


    protected function init($config)
    {
        parent::init($config);
    }

    /**
     * @desc: 获取网易云歌曲列表
     * @param array $params 请求参数
     * @remark 类型 字段名 是否必传 说明
     * @sonParam string keyword 否 搜索关键词
     * @sonParam int limit 否 每页大小
     * @sonParam int offset 否 偏移量
     * @return array|bool
     * @throws \Tianmiao\Cloud\Utils\TianmiaoCloudException
     * User: zhaoyanna <zhaoyanna@tianmtech.cn>
     * DateTime: 2022/12/08 19:32
     */
    public function getWangYiYunSongList($params)
    {
        return $this->request('/music/wangyiyun/songs', 'get', $params);
    }

    /**
     * @desc: 获取网易云歌曲详情
     * @param array $params 请求参数
     * @remark 类型 字段名 是否必传 说明
     * @sonParam string song_id 是 歌曲id
     * @return array|bool
     * @throws \Tianmiao\Cloud\Utils\TianmiaoCloudException
     * User: zhaoyanna <zhaoyanna@tianmtech.cn>
     * DateTime: 2022/12/08 19:33
     */
    public function getWangYiYunSongDetail($params)
    {
        return $this->request('/music/wangyiyun/song', 'get', $params);
    }

    /**
     * @desc: 获取服务商类型
     * @param array $params 请求参数
     * @return array|bool
     * @throws \Tianmiao\Cloud\Utils\TianmiaoCloudException
     * User: zhaoyanna <zhaoyanna@tianmtech.cn>
     * DateTime: 2022/12/09 17:59
     */
    public function getProviderType($params = [])
    {
        return $this->request('/music/provider/type', 'get', $params);
    }

    /**
     * @desc: 上报网易云音乐播放信息
     * @param array $params 请求参数
     * @return array|bool
     * @throws \Tianmiao\Cloud\Utils\TianmiaoCloudException
     * User: zhaoyanna <zhaoyanna@tianmtech.cn>
     * DateTime: 2022/12/15 14:27
     */
    public function reportWangYiYunPlay($params)
    {
        return $this->request('/music/wangyiyun/report/play', 'post', $params);
    }
}