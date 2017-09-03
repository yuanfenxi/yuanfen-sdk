# Yuanfen-sdk

Yuanfenxi PHP SDK

## 简介

本代码包是[猿分析](http://www.yuanfenxi.com/)的PHP SDK。

可以用以实现行为数据的汇报功能，将站点的各种用户行为推送到猿分析后台。

## 什么是用户行为

做为商业站点，您可以把很多关键的行为都定义为用户行为，比如，用户注册了帐号，用户登陆了，甚至用户在站内停留时间达到了5分钟，都可以定义为发生了一个用户行为。

收集这些数据，产生相关报表，对于了解您的运营数据，非常有好处。尤其是当您有多个来源的广告投放时，或是做了促销类活动时，要分析活动效果，是非常有用的。

## 具体使用

1. 安装:

```  composer require yuanfenxi/yuanfen-sdk ```

2. 使用:

假定我们已经有一段用户注册的代码:

```
$user = new User;
$user->phone = 13255801983;
$user->password = md5("HelloWorld");
if($user->save()){
	echo "OK";
}else{
	echo "failed";
}
```
我们把注册行为命名为"register-succ";应该在注册成功后，添加汇报用户注册行为的代码。

```
/** 请将{YFX_KEY} {YFX_SECRET},{YFX_SID}替换成您自己的。 */
$user = new User;
$user->phone = 13255801983;
$user->password = md5("HelloWorld");
if($user->save()){
	try{
		 $userBehavior = new UserBehavior($UserModel->uid,"register-succ");
		 $userBehavior->parseAndFillBrowserAndOs();
		 $behaviorClient = new BehaviorClient("{YFX_KEY}","{YFX_SECRET}","{YFX_SID}");
		 $behaviorClient->postEvent($userBehavior);		  
	}catch(\Exception $e){
	}
	echo "OK";
}else{
	echo "failed";
}

```

其中，汇报相关的代码为:

```
		 $userBehavior = new UserBehavior($UserModel->uid,"register-succ");
		 $userBehavior->parseAndFillBrowserAndOs();
		 $behaviorClient = new BehaviorClient("{YFX_KEY}","{YFX_SECRET}","{YFX_SID}");
		 $behaviorClient->postEvent($userBehavior);
```

注意，YFX_KEY,YFX_SECRET,YFX_SID 可以从[猿分析](http://www.yuanfenxi.com/)的[配置页面](https://yuanfenxi.com/site/view)查询到。



