<?php
$serviceIp = gethostbyname($_SERVER["SERVER_ADDR"]);
if ($serviceIp == '127.0.0.1') {
    define('MAIN_DOMAIN', 'demoyii.cc');//本地配的是什么改成什么
} else {
    define('MAIN_DOMAIN', 'demo.com');
}
//define('MOBILE_DOMAIN', 'm.' . DOMAIN);
//define('MOBILE_DOMAIN', '192.168.16.24:9000');
Yii::setAlias('@http_main_domain', 'http://'.MAIN_DOMAIN);

//echo DOMAIN;exit;

Yii::setAlias('common', dirname(__DIR__));
Yii::setAlias('frontend', dirname(dirname(__DIR__)) . '/frontend');
Yii::setAlias('backend', dirname(dirname(__DIR__)) . '/backend');
Yii::setAlias('console', dirname(dirname(__DIR__)) . '/console');
Yii::setAlias('@web_frontend', 'http://'.MAIN_DOMAIN.'/static/frontend');
Yii::setAlias('@web_backend', 'http://'.MAIN_DOMAIN.'/static/backend');
Yii::setAlias('@web_img',dirname(dirname(__DIR__)).'/static/frontend');
//广告图片路径
Yii::setAlias('@ads','/static/frontend/UploadFiles/ad_pic');
define('USER_GROUP_TYPE_ADMIN', 4);

