<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);
return [
    'id' => 'app-backend',				//id 属性用来区分其他应用的唯一标识ID
    'basePath' => dirname(__DIR__),		//指定该应用的根目录 backend
    'controllerNamespace' => 'backend\controllers',		//指定控制器类默认的命名空间
    'bootstrap' => ['log'],
    'defaultRoute'=>'/site/index', 	//默认路由，控制器ID：IndexController, 动作ID:actionIndex
    'modules' => [
        'ad'   => 'backend\modules\ad\ad',
        'company'   => 'backend\modules\company\company',
        'member'    => 'backend\modules\member\member',
        'data'   	=> 'backend\modules\data\data',
        'person'    => 'backend\modules\person\person',
        'user'      => 'backend\modules\user\user',
        'cms'       => 'backend\modules\cms\cms',
        'system'    => 'backend\modules\system\system',
        'config'    => 'backend\modules\system\config',
        'journaling'    => 'backend\modules\journaling\journaling',

    ],
    'components' => [
    	'view' => [
    		'class' => 'backend\base\BaseBackView'
    	],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        /*
        'urlManager'=>[
            'enablePrettyUrl' => true,
            'showScriptName' => true,
            'rules' => [
                "<module:\w+>/<controller:\w+>/<action:\w+>/<id:\d+>"=>"<module>/<controller>/<action>",
                "<controller:\w+>/<action:\w+>/<id:\d+>"=>"<controller>/<action>",
                "<controller:\w+>/<action:\w+>"=>"<controller>/<action>",
            ],
         ],*/
        'assetManager' => [
            'basePath' => '@webroot/static/backend/assets',
            'baseUrl'=>'@web/static/backend/assets',
            'bundles' => [
                // you can override AssetBundle configs here
            ],
        ],
    ],
    'params' => $params,
];
