<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
        ],
        'session' => [
            'cookieParams' => ['domain' => MAIN_DOMAIN, 'lifetime' => 0],
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
            //'class' => 'yii\redis\Cache',
        ],
        'redis' => [
            'class' => 'yii\redis\Connection',
            'hostname' => 'localhost',//192.168.100.15
            'port' => 6379,
            'database' => 0,
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
            'itemTable' => '91yxq_auth_item',
            'assignmentTable' => '91yxq_auth_assignment',
            'itemChildTable' => '91yxq_auth_item_child',
            'ruleTable'=>'91yxq_auth_rule'
        ],
        'setting' => [
            'class' => 'common\components\Setting',
        ],
        'delegate' => [
            'class' => 'common\components\Delegate',
        ],
        'attributeCache' => [
            'class' => 'common\components\AttributeCache',
        ],
        'areaCache' => [
            'class' => 'common\components\AreaCache',
        ],
        'linkCache' => [
            'class' => 'common\components\LinkCache',
        ],
        'jobCache' => [
            'class' => 'common\components\JobCache',
        ],
        'adCache' => [
            'class' => 'common\components\AdCache',
        ],
    ],
    'timeZone'=>'Asia/Chongqing',
];
