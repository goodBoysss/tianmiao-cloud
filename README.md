# excel文件操作
天渺公共项目服务


## 环境要求

* PHP >= 5.6


## 安装（composer包）
```shell
composer require tianmiao/cloud
```



## 功能介绍


### 三方管理-短信
```php

require "./vendor/autoload.php";

/**
 * 初始化方式一（环境变量配置，推荐）
 *TRIPARTITE_HOST = 
 *TRIPARTITE_APP_ID = 
 *TRIPARTITE_APP_SECRET = 
 *TRIPARTITE_SMS_IS_OPEN = 0
 *TRIPARTITE_SMS_MOBILE_WHITE_LIST = 18888888888
 */
 $smsClient=SmsClient::getInstance();
 
/**
 * 初始化方式二（入参）
 */
 $smsClient=SmsClient::getInstance(array(
   'host'=>'****',
   'app_id'=>'****',
   'app_secret'=>'****',
   'sms_is_open'=>'0',
   'sms_mobile_white_list'=>'18888888888',
));


/**
 * 发送验证码短信
 * @param string $mobile 手机号
 * @param int $type 类型：2-登录；3-注册...
 * @param int $code 短信验证码
 * @return bool true-发送请求成功
 * @throws \Tianmiao\Cloud\Utils\TianmiaoCloudException
 */
$result=$smsClient->sendSmsCode(18888888888,2,1234);

```

#### 示例一
```php

/**
 * 发送验证码短信
 * @param string $mobile 手机号
 * @param int $type 类型：2-登录；3-注册...
 * @param int $code 短信验证码
 * @return bool true-发送请求成功
 * @throws \Tianmiao\Cloud\Utils\TianmiaoCloudException
 */
$result=SmsClient::getInstance()->sendSmsCode(18888888888,2,1234);

```

#### 示例二
```php

/**
 * 检查短信发送白名单
 * @param string $mobile 手机号
 * @return bool true-通道全量开启或在白名单中
 * @throws \Tianmiao\Cloud\Utils\TianmiaoCloudException
 */
$result=SmsClient::getInstance()->checkSendWhite(18888888888);

```

