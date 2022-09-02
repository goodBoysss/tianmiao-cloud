# excel文件操作
天渺公共项目服务


## 环境要求

* PHP >= 5.6


## 安装（composer包）
```shell
composer require tianmiao/cloud
```



## 示例


### 三方管理-短信
```php

require "./vendor/autoload.php";

/**
 * 初始化方式一（环境变量配置，推荐）
 */
 $smsClient=SmsClient::getInstance();
 
/**
 * 初始化方式二（传参）
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
 * @param int $code 验证码
 * @return bool
 * @throws \Tianmiao\Cloud\Utils\TianmiaoCloudException
 */
$result=$smsClient->sendSmsCode(18888888888,2,1234);


```
