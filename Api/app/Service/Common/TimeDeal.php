<?php
/**
 * @author Kitetop <1363215999@qq.com>
 * @version Release: v1.0
 * Date: 2019-04-24
 */

namespace App\Service\Common;

/**
 * Class TimeDeal
 * @package App\Service\Common
 * 处理时间的统一的功能函数
 * 传递时间格式
 */
final class TimeDeal
{
    /**
     * @param string $format
     * @return false|string
     * 获得发起请求的时间
     */
    public static function  getTime($format = 'Y-m-d')
    {
        return date($format, time());
    }

    /**
     * @param $times
     * @return string
     * 根据现在的时间决定返回时间的格式
     */
    public function formatTime($times)
    {
        $year = substr($times, 0, 4);
        $day = substr($times, 5, 5);
        $time = substr($times, 11);
        return $times;
    }
}
