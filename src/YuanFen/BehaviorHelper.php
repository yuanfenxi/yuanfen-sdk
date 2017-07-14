<?php
/**
 * Created by IntelliJ IDEA.
 * User: r
 * Date: 2017/7/14
 * Time: 下午6:38
 */

namespace YuanFen;


use Firebase\JWT\JWT;
use Snoopy\Snoopy;
use WhichBrowser\Parser;

class BehaviorHelper
{
    protected $appKey = "";
    protected $appSecret = "";
    protected $urlPrefix = "https://t.yuanfenxi.com/stat/event.api";

    public function reportEvent($activityId, $eventType = "ActivityReport")
    {
        $appKey = $this->getAppKey();
        $appSecret = $this->getAppSecret();
        $urlPrefix = $this->getUrlPrefix();
        $browserResult = new Parser(self::getAllHeaders(), ['detectBots' => false]);
        $data = array(
            "sid" => "da34d2f2b68fe4fb038acc520c0daf5b",
            "rn" => "-" . rand(1000, 9999) . "-" . microtime(true),
            "cookie" => $_COOKIE["_yfx_ga"]??"",
            "eventType" => $eventType,
            "eventId" => $activityId,
            "ts" => time() * 1000,
            "os" => $browserResult->os->name,
            "browser" => $browserResult->browser->name
        );
        $encryptedString = JWT::encode($data, $appSecret);
        $snoopyObject = new Snoopy();
        $url = $urlPrefix . "?key=" . $appKey . "&value=" . $encryptedString;
        $snoopyObject->fetch($url);
        $result = $snoopyObject->results;

        $jsonArray = json_decode($result, true);
//        if ($jsonArray["code"] != 200) {
//            Log::error("report event failed,url:" . $url);
//        }
        return $jsonArray;
    }

    /**
     * @return string
     */
    public function getAppKey()
    {
        return $this->appKey;
    }

    /**
     * @param string $appKey
     */
    public function setAppKey($appKey)
    {
        $this->appKey = $appKey;
    }

    /**
     * @return string
     */
    public function getAppSecret()
    {
        return $this->appSecret;
    }

    /**
     * @param string $appSecret
     */
    public function setAppSecret($appSecret)
    {
        $this->appSecret = $appSecret;
    }

    /**
     * @return string
     */
    public function getUrlPrefix()
    {
        return $this->urlPrefix;
    }

    /**
     * @param string $urlPrefix
     */
    public function setUrlPrefix($urlPrefix)
    {
        $this->urlPrefix = $urlPrefix;
    }

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