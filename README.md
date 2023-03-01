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

### 机器人服务-预警 机器人服务(目前仅支持：企业微信、钉钉、飞书)
 
#### 文本
```php
//webhooks地址
$option['robot_url'] = "https://";
//手机号列表，提醒手机号对应的群成员(@某个成员) 飞书暂不支持手机号@
$option['at_mobile_list'] = ['138****8**'];
//是否@all表示提醒所有人
$option['at_all_mobile'] = true;

$text = "测试1";

$service = new Tianmiao\Cloud\Service\TMRobotService;

/**
 * 发送文本消息
 * @param string|array|int $text
 * @param array $option
 *          string robot_url 机器人地址，默认取env  QYWX_ROBOT_URL
 *          array at_mobile_list at用户手机号列表
 *          bool at_all_mobile 是否@all表示提醒所有人
 * @return array
 */
$service->sendTextMsg($text, $option);
```

#### 图文
```php
$option['robot_url'] = "https://";
//不支持
$option['at_mobile_list'] = ['138****8**'];
//不支持
$option['at_all_mobile'] = true;

$content = [
    "title" => "中秋节礼品领取",
    "description" => "今年中秋节公司有豪礼相送",
    "url" => "www.qq.com",
    "pic_url" => "http://res.mail.qq.com/node/ww/wwopenmng/images/independent/doc/test_pic_msg1.png"
//    "pic_url" => "img_7ea74629-9191-4176-998c-2e603c9c5e8g"  // 飞书 要把图片上传获取到image_key
];

$service = new Tianmiao\Cloud\Service\TMRobotService;

/**
 * 发送图文消息
 * @param array $data
 *          string title 标题
 *          string description 描述
 *          string url 跳转链接
 *          string pic_url 图片url 飞书要传图片上传后的key
 * @param array $option
 *          string robot_url 机器人地址，默认取env  QYWX_ROBOT_URL
 *          array at_mobile_list at用户手机号列表
 *          bool at_all_mobile 是否@all表示提醒所有人
 * @return array
 */
$service->sendImageTextMsg($content, $option);
```

#### Markdown
```php
$option['robot_url'] = "https://";
//手机号列表，提醒手机号对应的群成员(@某个成员) 企业微信、飞书不支持
$option['at_mobile_list'] = ['138****8**'];
//是否@all表示提醒所有人 企业微信、飞书不支持
$option['at_all_mobile'] = true;

$text = "#### 杭州天气 \n > 9度，西北风1级，空气良89，相对温度73%\n > ![screenshot](img_7ea74629-9191-4176-998c-2e603c9c5e8g)\n > ###### 10点20分发布 [天气](https://www.dingtalk.com) \n";

$service = new Tianmiao\Cloud\Service\TMRobotService;

/**
 * 发送markdown消息
 * @param string $content #### 杭州天气 \n > 9度，西北风1级，空气良89，相对温度73%\n > ![screenshot](https://img.alicdn.com/tfs/TB1NwmBEL9TBuNjy1zbXXXpepXa-2400-1218.png)\n > ###### 10点20分发布 [天气](https://www.dingtalk.com) \n
 * @param array $option
 *          string robot_url 机器人地址，默认取env  QYWX_ROBOT_URL
 *          array at_mobile_list at用户手机号列表
 *          bool at_all_mobile 是否@all表示提醒所有人
 * @return array
 */
$service->sendMarkdownMsg($text, $option);
```