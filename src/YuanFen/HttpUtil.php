<?php
/**
 * Created by IntelliJ IDEA.
 * User: r
 * Date: 2017/9/18
 * Time: 下午7:43
 */

namespace YuanFen;


class HttpUtil
{
    public static function getAllHeaders()
    {

        $headers = [];
        foreach ($_SERVER as $name => $value) {
            if (substr($name, 0, 5) == 'HTTP_') {
                $headers[str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', substr($name, 5)))))] = $value;
            }
        }
        return $headers;
    }
}