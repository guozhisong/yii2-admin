<?php
return [
    'components' => [

        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=127.0.0.1;dbname=91yxq_manage',
            'username' => 'root',
            'password' => 'root',
            'charset' => 'utf8',
            'tablePrefix'=>'91yxq_'
        ],
        'db2' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=127.0.0.1;dbname=91yxq_admin',
            'username' => 'root',
            'password' => 'root',
            'charset' => 'utf8',
            'tablePrefix'=>''
        ],
        'db3' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=127.0.0.1;dbname=91yxq_publish',
            'username' => 'root',
            'password' => 'root',
            'charset' => 'utf8',
            'tablePrefix'=>'91yxq_'
        ],

        /*
            'db' => [
                    'class' => 'yii\db\Connection',
                    'dsn' => 'mysql:host=203.171.232.240;dbname=test88',
                    'username' => 'jishubu',
                    'password' => '5saxu7pV2Mb8dVDl',
                    'charset' => 'utf8',
                    'tablePrefix'=>'job_'
            ],
        */

    ],
];
