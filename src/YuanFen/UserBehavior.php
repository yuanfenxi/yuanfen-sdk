<?php
/**
 * Created by IntelliJ IDEA.
 * User: r
 * Date: 2017/8/13
 * Time: 下午9:39
 */

namespace YuanFen;


use WhichBrowser\Parser;

class UserBehavior
{

    public $rn;
    public $cookie;
    public $eventType;
    public $eventId;
    public $ts;
    public $os;
    public $browser;
    public $ua;
    public $sid;
    public $otherData;
    public $otherDataType;

    public function __construct($activityId, $eventType = "register", $otherData = "{}", $otherDataType = "", $cookie = null, $rn = null)
    {
        $this->rn = $rn?? ("-" . rand(1000, 9999) . "-" . microtime(true));
        $this->cookie = $cookie??($_COOKIE["_yfx_ga"]??"");
        $this->eventId = $activityId;
        $this->eventType = $eventType;
        $this->ts = time() * 1000;
        $this->ua = isset($_SERVER["HTTP_USER_AGENT"]) ? $_SERVER["HTTP_USER_AGENT"] : "";
        $this->otherData = $otherData;
    }

    public function parseAndFillBrowserAndOs()
    {
        $browserResult = new Parser(BehaviorClient::getAllHeaders(), ['detectBots' => false]);
        try {
            $this->os = $browserResult->os->name;
        } catch (\Exception $ignored) {
        }
        try {
            $this->browser = $browserResult->browser->name;
        } catch (\Exception $ignored) {
        }
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return (array)$this;
    }

    /**
     * @return null|string
     */
    public function getRn()
    {
        return $this->rn;
    }

    /**
     * @param null|string $rn
     */
    public function setRn($rn)
    {
        $this->rn = $rn;
    }

    /**
     * @return null|string
     */
    public function getCookie()
    {
        return $this->cookie;
    }

    /**
     * @param null|string $cookie
     */
    public function setCookie($cookie)
    {
        $this->cookie = $cookie;
    }

    /**
     * @return string
     */
    public function getEventType()
    {
        return $this->eventType;
    }

    /**
     * @param string $eventType
     */
    public function setEventType($eventType)
    {
        $this->eventType = $eventType;
    }

    /**
     * @return mixed
     */
    public function getEventId()
    {
        return $this->eventId;
    }

    /**
     * @param mixed $eventId
     */
    public function setEventId($eventId)
    {
        $this->eventId = $eventId;
    }

    /**
     * @return int
     */
    public function getTs()
    {
        return $this->ts;
    }

    /**
     * @param int $ts
     */
    public function setTs($ts)
    {
        $this->ts = $ts;
    }

    /**
     * @return mixed
     */
    public function getOs()
    {
        return $this->os;
    }

    /**
     * @param mixed $os
     */
    public function setOs($os)
    {
        $this->os = $os;
    }

    /**
     * @return mixed
     */
    public function getBrowser()
    {
        return $this->browser;
    }

    /**
     * @param mixed $browser
     */
    public function setBrowser($browser)
    {
        $this->browser = $browser;
    }

    /**
     * @return string
     */
    public function getUa()
    {
        return $this->ua;
    }

    /**
     * @param string $ua
     */
    public function setUa($ua)
    {
        $this->ua = $ua;
    }

    /**
     * @return mixed
     */
    public function getSid()
    {
        return $this->sid;
    }

    /**
     * @param mixed $sid
     */
    public function setSid($sid)
    {
        $this->sid = $sid;
    }

    /**
     * @return string
     */
    public function getOtherData()
    {
        return $this->otherData;
    }

    /**
     * @param string $otherData
     */
    public function setOtherData($otherData)
    {
        $this->otherData = $otherData;
    }

    /**
     * @return mixed
     */
    public function getOtherDataType()
    {
        return $this->otherDataType;
    }

    /**
     * @param mixed $otherDataType
     */
    public function setOtherDataType($otherDataType)
    {
        $this->otherDataType = $otherDataType;
    }

    
    
}