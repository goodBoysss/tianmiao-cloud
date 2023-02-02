<?php
/**
 * Context.php
 * ==============================================
 * Copy right 2015-2023  by https://www.tianmtech.com/
 * ----------------------------------------------
 * This is not a free software, without any authorization is not allowed to use and spread.
 * ==============================================
 * @desc:全局数据填充器
 * @author: zhanglinxiao<zhanglinxiao@tianmtech.cn>
 * @date: 2023/02/02
 * @version: v1.0.0
 * @since: 2023/02/02 16:15
 */


namespace Tianmiao\Cloud\Libs\LaravelS;


class Context
{
    /**
     * 参数盒
     * @var array
     */
    protected $box = array();

    /**
     * @desc: 获取数据
     * @param $key
     * @return mixed|null
     * User: zhanglinxiao<zhanglinxiao@tianmtech.cn>
     * DateTime: 2023/02/01 15:47
     */
    public function get($key)
    {
        $keyMd5 = $this->keyMd5($key);
        if (isset($this->box[$keyMd5])) {
            return $this->box[$keyMd5]['val'];
        }
        return null;
    }

    /**
     * @desc: 存储数据
     * @param $key
     * @param $val
     * @return bool
     * User: zhanglinxiao<zhanglinxiao@tianmtech.cn>
     * DateTime: 2023/02/01 15:47
     */
    public function set($key, $val)
    {
        $keyMd5 = $this->keyMd5($key);
        if (!empty($keyMd5)) {
            $this->box[$keyMd5] = array(
                'key' => $key,
                'val' => $val,
            );

            return true;
        } else {
            return false;
        }
    }

    /**
     * @desc: 生成key的md5值
     * @param $key
     * @return string|null
     * User: zhanglinxiao<zhanglinxiao@tianmtech.cn>
     * DateTime: 2023/02/01 15:41
     */
    protected function keyMd5($key)
    {
        $keyMd5 = null;
        if (empty($key)) {
            return $keyMd5;
        }

        if (is_int($key) || is_string($key)) {
            //数字和字符串
            $keyMd5 = md5($key);
        } else if (is_object($key)) {
            //对象处理
        }
        return $keyMd5;

    }

    /**
     * @desc: 更新数据时间
     * @param $keyMd5
     * User: zhanglinxiao<zhanglinxiao@tianmtech.cn>
     * DateTime: 2023/02/01 15:48
     */
    protected function updateTime($keyMd5)
    {
        $this->box[$keyMd5]['time'] = time();
    }

}