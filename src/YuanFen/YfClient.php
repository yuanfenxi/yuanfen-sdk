<?php
/**
 * Created by IntelliJ IDEA.
 * User: r
 * Date: 2017/9/18
 * Time: 上午12:41
 */

namespace YuanFen;


use Firebase\JWT\JWT;
use GuzzleHttp\Client;

abstract class YfClient
{
    protected $appKey = "";
    protected $appSecret = "";
    protected $gateway;
    protected $sid = "";

    protected $response;

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

    /**
     * @return mixed
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * @param mixed $response
     */
    public function setResponse($response)
    {
        $this->response = $response;
    }

    /**
     * @param $dataToUpload
     * @param $appSecret
     * @param $urlPrefix
     * @param $appKey
     * @return bool
     */
    protected function uploadDataToYfx($dataToUpload)
    {
        $appKey = $this->getAppKey();
        $appSecret = $this->getAppSecret();
        $urlPrefix = $this->getGateway();


        $encryptedString = JWT::encode($dataToUpload, $appSecret);
        $url = $urlPrefix . "?key=" . $appKey . "&value=" . $encryptedString;

        $client = new Client();
        $res = $client->request('GET', $url);
        $result = $res->getBody();
        $this->setResponse($res);
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


}