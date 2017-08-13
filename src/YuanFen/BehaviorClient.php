<?php
/**
 * Created by IntelliJ IDEA.
 * User: r
 * Date: 2017/7/14
 * Time: 下午6:38
 */

namespace YuanFen;

use Firebase\JWT\JWT;
use GuzzleHttp\Client;

class BehaviorClient
{
    protected $appKey = "";
    protected $appSecret = "";
    protected $gateway = "https://t.yuanfenxi.com/stat/event.api";
    protected $sid = "";

    /**
     * BehaviorReporter constructor.
     * @param string $appKey
     * @param string $appSecret
     * @param string $sid
     */
    public function __construct($appKey, $appSecret, $sid)
    {
        $this->appKey = $appKey;
        $this->appSecret = $appSecret;
        $this->sid = $sid;
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

    public function reportEvent($activityId, $eventType = "register", $cookie = "")
    {
        $behavior = new UserBehavior($activityId, $eventType, $cookie);
        $behavior->parseAndFillBrowserAndOs();
        return $this->postEvent($behavior);
    }

    public function postEvent(UserBehavior $userBehavior)
    {
        $appKey = $this->getAppKey();
        $appSecret = $this->getAppSecret();
        $urlPrefix = $this->getGateway();

        if (empty($userBehavior->sid)) {
            $userBehavior->sid = $this->getSid();
        }

        $encryptedString = JWT::encode($userBehavior->toArray(), $appSecret);
        $url = $urlPrefix . "?key=" . $appKey . "&value=" . $encryptedString;

        $client = new Client();
        $res = $client->request('GET', $url);
        $result = $res->getBody();
        $jsonArray = json_decode($result, true);
        if (empty($jsonArray)) {
            return false;
        }

        if (isset($jsonArray["code"]) && $jsonArray["code"] == 200) {
            return true;
        } else {
            return false;
        }
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
    public function getGateway()
    {
        return $this->gateway;
    }

    /**
     * @param string $gateway
     */
    public function setGateway($gateway)
    {
        $this->gateway = $gateway;
    }

    /**
     * @return string
     */
    public function getSid()
    {
        return $this->sid;
    }

    /**
     * @param string $sid
     */
    public function setSid($sid)
    {
        $this->sid = $sid;
    }


}