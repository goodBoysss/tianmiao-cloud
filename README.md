# excel文件操作
天渺公共项目服务


## 环境要求

* PHP >= 5.6


## 安装（composer包）
```shell
composer require tianmiao/cloud
```



## 功能介绍



### 财务平台-信息认证
```php
require "./vendor/autoload.php";

/**
 * 初始化方式一（环境变量配置，推荐）
 *FINANCIAL_HOST = 
 *FINANCIAL_APP_KEY = 
 *FINANCIAL_APP_SECRET = 
 */
 $financialVerifyClient=FinancialVerifyClient::getInstance();
 
/**
 * 初始化方式二（入参）
 */
 $financialVerifyClient=FinancialVerifyClient::getInstance(array(
   'host'=>'****',
   'app_id'=>'****',
   'app_secret'=>'****',
));

```

#### 示例一
```php

/**
 * 用户信息验证
 * @param array $params 认证信息
 *          truename    真实姓名
 *          id_card     身份证号码
 *          alipay_account     支付宝提现账户
 *          mobile     手机号
 *          user_id     用户ID
 *          user_code     用户编号
 *          nickname     用户呢称
 * @return array
 *          status  状态：1-申请认证提交成功；0-申请认证提交失败；
 *          error   申请认证提交失败错误信息
 * @throws \Tianmiao\Cloud\Utils\TianmiaoCloudException
 */
$result=FinancialVerifyClient::getInstance()->verifyUser(array(
        'truename'=>"***",
        'id_card'=>"***",
        'alipay_account'=>"***",
        'mobile'=>"***",
        'user_id'=>"***",
        'user_code'=>"***",
        'nickname'=>"***",
));

```


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

