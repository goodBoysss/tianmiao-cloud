<?php
/**
 * ShortUrl.php
 * ==============================================
 * Copy right 2015-2023  by https://www.tianmtech.com/
 * ----------------------------------------------
 * This is not a free software, without any authorization is not allowed to use and spread.
 * ==============================================
 * @desc:
 * @author: zhangkang<zhangkang@tianmtech.cn>
 * @date: 2023/02/16
 * @version: v1.0.0
 * @since: 2023/02/16 11:45
 */

namespace Tianmiao\Cloud\App\ShortUrl\General;

use Tianmiao\Cloud\App\ShortUrl\ShortUrlClient;
use Tianmiao\Cloud\Utils\TianmiaoCloudException;

class ShortUrlShortenClient extends ShortUrlClient
{
    /**
     * @desc: 生成单个短链接
     * @param $params
     * @remark 类型 字段名 是否必传 说明
     * @sonParam string url 是 url
     * @sonParam string domain 否 域名
     * @sonParam string app_alias 否 别名
     * @sonParam int is_show_cover 否 是否展示封面图（微信、QQ）：1-展示；0-不展示；
     * @sonParam string cover_image_url 否 封面图url
     * @param array $option
     * @return array|bool
     * @throws TianmiaoCloudException
     * User: zhangkang<zhangkang@tianmtech.cn>
     * DateTime: 2023/02/16 13:16
     */
    public function shorten($params, $option = [])
    {
        $option = array_merge($option, [
            'return_format' => 'data',
            'connect_timeout' => 3,
            'timeout' => 3
        ]);
        return $this->request('/api/url/shorten', 'post', $params, $option);
    }

    /**
     * @desc: 批量生成多个短链接
     * @param $params
     * @remark 类型 字段名 是否必传 说明
     * @sonParam array urls 是 url,例如：["http://www.baidu.com","http://www.baidu2.com"]
     * @sonParam string domain 否 域名
     * @sonParam string app_alias 否 别名
     * @sonParam array cover_image_urls 否 封面图url，例如：["https://shorturl.obs.cn-east-3.myhuaweicloud.com/cover/common/bingniao.png"]
     * @param array $option
     * @return array
     * @throws TianmiaoCloudException
     * User: zhangkang<zhangkang@tianmtech.cn>
     * DateTime: 2023/02/16 13:16
     */
    public function batchShorten($params, $option = [])
    {
        $params['urls'] = json_encode($params['urls']);
        if (!empty($params['cover_image_urls'])) {
            $params['cover_image_urls'] = json_encode($params['cover_image_urls']);
        }

        $option = array_merge($option, [
            'return_format' => 'data',
            'connect_timeout' => 3,
            'timeout' => 3
        ]);
        return $this->request('/api/url/shorten', 'post', $params, $option);
    }
}