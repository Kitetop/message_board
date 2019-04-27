<?php
/**
 * @author Kitetop <1363215999@qq.com>
 * @version Release: v1.0
 * Date: 2019-04-23
 */

namespace Kite\Commons;


/**
 * Class Response
 * @package Kite\Commons
 * 对Api接口的数据返回设置统一的返回格式
 */
final class Response
{
    private static $status;

    /**
     * @param $message
     * @param null $data
     * @return array
     * 成功的时候的返回格式
     */
    public static function success($message, $data = null)
    {
        self::$status = 0;
        return [
            'status' => self::$status,
            'message' => $message,
            'data' => $data
        ];
    }

    /**
     * @param $status
     * @param $message
     * @param null $data
     * @return array
     * 失败的时候返回的格式
     */
    public static function error($status, $message, $data = null)
    {
        return [
            'status' => $status,
            'message' => $message,
            'data' => $data
        ];
    }
}
