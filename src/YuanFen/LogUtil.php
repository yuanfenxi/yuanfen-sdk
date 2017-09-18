<?php
/**
 * Created by IntelliJ IDEA.
 * User: r
 * Date: 2017/9/18
 * Time: 下午8:30
 */

namespace YuanFen;


class LogUtil
{
    public static function toSimpleLog(array $data)
    {
        ksort($data);
        $result = [];
        foreach ($data as $k => $value) {
            if (is_array($value) || is_object($value)) {
                $result[] =
                    self::normalize($k) . "=" . self::normalize(json_encode($value));
            } else {
                $result[] = self::normalize($k) . "=" . self::normalize($value);
            }
        }
        return join(";", $result);
    }

    public static function normalize($line)
    {
        return str_replace([";", ":"], "_", $line);
    }

}