<?php
/**
 * Created by IntelliJ IDEA.
 * User: r
 * Date: 2017/8/13
 * Time: 下午9:39
 */

namespace YuanFen;



class UserBehavior
{
    use HttpTrait;
    
    public $rn;

    public $eventType;
    public $eventId;
    public $ts;

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