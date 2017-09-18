<?php
/**
 * Created by IntelliJ IDEA.
 * User: r
 * Date: 2017/7/14
 * Time: 下午6:38
 */

namespace YuanFen;


class BehaviorClient extends YfClient
{
    protected $gateway = "https://t.yuanfenxi.com/stat/event.api";
    
    public function reportEvent($activityId, $eventType = "register", $cookie = "")
    {
        $behavior = new UserBehavior($activityId, $eventType, $cookie);
        $behavior->parseAndFillBrowserAndOs();
        return $this->postEvent($behavior);
    }

    public function postEvent(UserBehavior $userBehavior)
    {

        if (empty($userBehavior->sid)) {
            $userBehavior->sid = $this->getSid();
        }

        $dataToUpload = $userBehavior->toArray();
        return $this->uploadDataToYfx($dataToUpload);
    }


}