<?php
/**
 * Created by IntelliJ IDEA.
 * User: r
 * Date: 2017/9/18
 * Time: 上午12:46
 */

namespace YuanFen;


class PvLog
{

    use HttpTrait;

    public $sid;
    public $ts;
    public $rn;
    public $zone;


    /**
     * @var $ids array
     */
    public $ids;

    /**
     * PvLog constructor.
     * @param $rn
     * @param $zone
     * @param array $ids
     * @param $sid
     */
    public function __construct($sid, $rn, $zone, array $ids, $cookie = null)
    {
        $this->rn = $rn;
        $this->zone = $zone;
        $this->ids = $ids;
        $this->sid = $sid;
        $this->ts = time();
        $this->cookie = $cookie??($_COOKIE["_yfx_ga"]??"");
    }

    public function toLogLine()
    {
        return LogUtil::toSimpleLog($this->toArray());
        //return "sid:".$this->getSid().";ts:".$this->getTs().";rn:".$this->getRn().";zone:".$this->getZone().";ids:".trim(join(",",$this->getIds()),",").";cookie:".$this->getCookie().";ip:".$this->getIp().";os:".$this->getOs().";browser:".$this->getBrowser();
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return (array)$this;
    }

    /**
     * @return mixed
     */
    public function getCookie()
    {
        return $this->cookie;
    }

    /**
     * @param mixed $cookie
     */
    public function setCookie($cookie)
    {
        $this->cookie = $cookie;
    }

    /**
     * @return mixed
     */
    public function getIp()
    {
        return $this->ip;
    }

    /**
     * @param mixed $ip
     */
    public function setIp($ip)
    {
        $this->ip = $ip;
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
     * @return mixed
     */
    public function getTs()
    {
        return $this->ts;
    }

    /**
     * @param mixed $ts
     */
    public function setTs($ts)
    {
        $this->ts = $ts;
    }


    /**
     * @return mixed
     */
    public function getRn()
    {
        return $this->rn;
    }

    /**
     * @param mixed $rn
     */
    public function setRn($rn)
    {
        $this->rn = $rn;
    }

    /**
     * @return mixed
     */
    public function getZone()
    {
        return $this->zone;
    }

    /**
     * @param mixed $zone
     */
    public function setZone($zone)
    {
        $this->zone = $zone;
    }

    /**
     * @return array
     */
    public function getIds()
    {
        return $this->ids;
    }

    /**
     * @param array $ids
     */
    public function setIds($ids)
    {
        $this->ids = $ids;
    }

}