<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    //'defaultRoute'=>'admin/index/index',
    'modules' => [
        'news'    =>'frontend\modules\news\news',
        'company' =>'frontend\modules\company\company',
        'member'  =>'frontend\modules\member\member',
        'person'  =>'frontend\modules\person\person',
        'mobile'    =>'frontend\modules\mobile\mobile',
     //   'job'    =>'frontend\modules\job\person',
    ],
    'components' => [
        'view' => [
            'class' => 'frontend\base\BaseFrontView'
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
        
        'urlManager'=>[
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                'http://c<id:\w+>.'.DOMAIN => '/com/show',            
                "/"=>"/site/index",
                //'/index.php' => '/site/index',
                //个人
                "jobs<id:\d+>.html" => "/jobs/index",
                "jobs/list-f-<functype:\d+>" => "/jobs/index",
                'jobs/list-c-<job_class:\d+>' => '/jobs/index',
                'jobs/list-s-<sltwork_place:\d+>' => '/jobs/index',
                              
                'jobs/show-<id:\d+>' => '/jobs/show',
                'jobs' => '/jobs/index',
                
                "com"=>"/com/index",
                'com/show-<id:((?!index)\w)+>'=>'/com/show',
                "lietou"=>"/lietou/index",

                'zhiwei/<id:\d+>' => 'zhiwei/other',
                'qiye/<id:\d+>' => 'qiye/other',

                'resume/show-<id:\d+>'=>'/resume/index',
                'r1<zero:[0]+><res_id:\d+>.shtml' => '/resume/index',
                'tags/show-<id:\d+>' => '/tags/show',
				'tags' => '/tags/index',
                //"jobs-type-<functype:\d+>.html"=>"/jobs",
                "jobs-keyword-<keyword:\w+>.html"=>"/jobs/index",            
                'jobs/J1<old_id:\d+>.html' => '/jobs/job',
                
                //'/<pinyin:[a-z]+>' => '/area/index',
                
                'yl' => '/yl/index',
                'qx' => '/qx/index',
                
              
                //qiye
                
                "qiye/p<area:\d+>_s<pro:\d+>_a<page:\d+>"=>"/qiye/index",
                "zhiwei/p<area:\d+>_s<functype:\d+>_j<job_class:\d+>"=>"/zhiwei/index",
                "qiye"=>"/qiye/index",
                'zhiwei' => 'zhiwei/index',
                "zph/<id:\d+>.html" => "/zph/show",
                "zph/<hypy:((?!index)\w)+>" => "/zph/index",
                "zph" => "/zph/index",

                //"qiye/a-<area:\d+>"=>"/qiye",
                //"qiye/p-<pro:\d+>"=>"/qiye",
                //cms
                "news/page<page:\d+>"=>"/news/default/index",
                
                "news/list-<id:\d+>_<page:\d+>"=>"/news/default/list",
                "news/list-<id:\d+>"=>"/news/default/list",
                //"news/list"=>"/news/default/list",
                "news/show-<id:\d+>" => "/news/default/show",
                "news"=>"/news/default/index",
                
                //nginx 301
                'info.aspx' => '/news/default/index',
                "info/<id:\d+>.html"=>"/news/default/show",
                
 
                //地区
                '<pinyin:bj>' => '/area/index',
                '<pinyin:tj>' => '/area/index',
                '<pinyin:sh>' => '/area/index',
                '<pinyin:cq>' => '/area/index',
                '<pinyin:hb>' => '/area/index',
                '<pinyin:sx>' => '/area/index',
                
                '<pinyin:ln>' => '/area/index',
                '<pinyin:jl>' => '/area/index',
                '<pinyin:hlj>' => '/area/index',
                '<pinyin:js>' => '/area/index',
                '<pinyin:zj>' => '/area/index',
                '<pinyin:ah>' => '/area/index',
                '<pinyin:fj>' => '/area/index',
                '<pinyin:jx>' => '/area/index',
                '<pinyin:sd>' => '/area/index',
                '<pinyin:henan>' => '/area/index',
                '<pinyin:hbei>' => '/area/index',
                '<pinyin:hnan>' => '/area/index',
                '<pinyin:gd>' => '/area/index',
                '<pinyin:gs>' => '/area/index',
                '<pinyin:sc>' => '/area/index',
                '<pinyin:gz>' => '/area/index',
                '<pinyin:hn>' => '/area/index',
                '<pinyin:yn>' => '/area/index',
                '<pinyin:qh>' => '/area/index',
                '<pinyin:sxi>' => '/area/index',
                '<pinyin:gx>' => '/area/index',
                '<pinyin:xz>' => '/area/index',
                '<pinyin:nx>' => '/area/index',
                '<pinyin:xj>' => '/area/index',
                '<pinyin:nmg>' => '/area/index',
                
                "<module:\w+>/<controller:\w+>/<action:\w+>/<id:\d+>"=>"<module>/<controller>/<action>",
                "<controller:\w+>/<action:\w+>/<id:\d+>"=>"<controller>/<action>",
                "<controller:\w+>/<action:\w+>"=>"<controller>/<action>",
                
                
                
            ],
        ],
        'assetManager' => [
            'basePath' => '@webroot/static/frontend/assets',
            'baseUrl'=>'@web/static/frontend/assets',
            'bundles' => [
                // you can override AssetBundle configs here
            ],
        ],
    ],
    'params' => $params,
];
