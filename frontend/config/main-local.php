<?php

$mailerConf = ['service@mail.jobuy.net', 'master@mail.jobuy.net', 'hr@mail.jobuy.net', 'allow@mail.jobuy.net', 'webmaster@mail.jobuy.net'];

$mailerTagPath = Yii::getAlias('common').'/mail/tag/'.date('Ymd',time()).'/';
if (!file_exists($mailerTagPath)) {
    mkdir($mailerTagPath, 0777);
}

$mailerKey = 0;
foreach ($mailerConf as $key=>$val) {
    $mailerTagFile = $mailerTagPath . $val;
    if (file_exists($mailerTagFile)) {
        $mailerCount = file_get_contents($mailerTagFile);
    } else {
        file_put_contents($mailerTagFile, 0);
        $mailerCount = 0;
    }
    if ($mailerCount < 900) {
        $mailerKey = $key;
        break;
    }
}

$config = [
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => '7YgH_yM4XgUSbeDrZSJNldT9dOVEgDG9',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            'useFileTransport' => false,
            'transport' => [
               'class' => 'Swift_SmtpTransport',
               'host' => 'smtp.qiye.163.com',
               'username' => $mailerConf[$mailerKey],
               'password' => 'Wwdwd2323##16',//@@Refine##2016
               'port' => '25',
               'encryption' => 'tls',
            ],
           'messageConfig' => [  
               'charset' => 'UTF-8',  
               'from' => [$mailerConf[$mailerKey] => '猎才医药网']
            ],
        ],
    ],
];

if (!YII_ENV_TEST) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = 'yii\debug\Module';

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = 'yii\gii\Module';
}

return $config;
