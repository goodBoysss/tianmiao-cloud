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
     * @desc: 获取歌曲列表
     * @param string $keyword 搜索关键词
     * @param int $limit 每页大小
     * @param int $offset 偏移量
     * @return array|bool
     * @throws \Tianmiao\Cloud\Utils\TianmiaoCloudException
     * User: zhaoyanna <zhaoyanna@tianmtech.cn>
     * DateTime: 2022/12/08 19:32
     */
    public function getWangYiYunSongList($keyword, $limit, $offset)
    {
        $reqParams = [
            'keyword' => $keyword,
            'limit'   => $limit,
            'offset'  => $offset,
        ];
        return $this->request('/music/wangyiyun/songs', 'get', $reqParams);
    }

    /**
     * @desc: 获取歌曲详情
     * @param string $songId 歌曲id
     * @return array|bool
     * @throws \Tianmiao\Cloud\Utils\TianmiaoCloudException
     * User: zhaoyanna <zhaoyanna@tianmtech.cn>
     * DateTime: 2022/12/08 19:33
     */
    public function getWangYiYunSongDetail($songId)
    {
        $reqParams = [
            'song_id' => $songId,
        ];
        return $this->request('/music/wangyiyun/song', 'get', $reqParams);
    }
}