<?php
/**
 * Created by IntelliJ IDEA.
 * User: r
 * Date: 2017/9/18
 * Time: 下午8:15
 */

namespace YuanFen;


use WhichBrowser\Parser;

trait HttpTrait
{
    public $os;
    public $browser;
    public $cookie;
    public $ua;
    public $ip;

    public function parseAndFillRealIP()
    {
        $this->ip = $_SERVER["REMOTE_ADDR"];
    }

    public function parseAndFillBrowserAndOs()
    {
        $browserResult = new Parser(HttpUtil::getAllHeaders(), ['detectBots' => false]);
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
    public function getUa()
    {
        return $this->ua;
    }

    /**
     * @param mixed $ua
     */
    public function setUa($ua)
    {
        $this->ua = $ua;
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


}