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
        $now = date('Y-m-d');
        $year = $this->getYear($times);
        $day = $this->getDay($times);
        $hours = $this->getHours($times);
        if($this->getYear($now) != $year) {
            return $times;
        } elseif ($this->getDay($now) != $day) {
            return $day . ' '.$hours;
        } else {
            return $this->getHours($times, true);
        }
    }

    /**
     * @param $time
     * @return bool|string
     * 获得时间的年
     */
    private function getYear($time)
    {
        return substr($time, 0, 4);
    }

    /**
     * @param $time
     * @return bool|string
     * 获得时间的天
     */
    private function getDay($time)
    {
        return substr($time, 5, 5);
    }

    /**
     * @param $time
     * @param bool $second
     * @return bool|string
     * 获得时间的小时
     */
    private function getHours($time, $second = false)
    {
        $seconds = 5;
        if($second) {
            $second = null;
        }
        return substr($time, 11, $seconds);
    }
}
