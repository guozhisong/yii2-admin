<?php

namespace backend\controllers;
use Yii;
use yii\web\Controller;
use yii\web\session;
use common\models\User;
use yii\filters\AccessControl;
use backend\modules\user\models\UserForm;

class SiteController extends controller{
    public $enableCsrfValidation = false;//yii默认表单csrf验证，如果post不带改参数会报错！
    //public $layout  = '/notlayout';
    /**
     * @用户授权规则
     */

    public function behaviors()
    {
        return [
//            'access' => [
//                'class' => AccessControl::className(),
//                'rules' => [
//                    [
//                        'actions' => ['login','captcha'],
//                        'allow' => true,
//                        'roles' => ['?'],
//                    ],
//                    [
//                        'actions' => ['logout','edit','add','del','index','users','thumb','upload','cutpic'],
//                        'allow' => true,
//                        'roles' => ['@'],
//                    ],
//                ],
//            ],
        ];
    }

    public function actions(){
        return [
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'minLength' => 4,
                'maxLength' => 4,
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
            'error'=>[
                'class' => 'yii\web\ErrorAction',
            ],
            'Kupload' => [
            'class' => 'pjkui\kindeditor\KindEditorAction',

            ]
        ];
    }
//21232f297a57a5a743894a0e4a801fc3
//$model->load(Yii::$app->request->post()) && $model->login()
    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->redirect(['/site/index']);
        }

        $model = new UserForm();
        $model->setScenario('login');
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            \backend\controllers\BackendBaseController::_adminiLogger([
                'catalog' => 'login' ,
                'intro' => '成功登录:'.$model -> username.'(id:'.Yii::$app->user->getId().')',
            ]);
            return $this->redirect(['/site/index']);
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }


    /**
     * @return string 后台默认页面
     */
    public function actionIndex()
    {
        
        if (empty(Yii::$app->user->getId())) {
            Yii::$app->controller->redirect(['/site/login']);
            return false;
        }
        if (Yii::$app->user->identity->group_type != USER_GROUP_TYPE_ADMIN) {
            throw new \yii\web\NotFoundHttpException('账号类型不是管理员帐号');
            return false;
        }
        $this->layout = '/notlayout';
        return $this->render('index');
    }
    
    public function actionLogout()
    {
        $userId = Yii::$app->user->getId();
		$uname = Yii::$app->user->identity->username;
        if(Yii::$app->user->logout()) 
            \backend\controllers\BackendBaseController::_adminiLogger([
                'catalog' => 'logout' ,
                'user_id' => $userId,
                'intro' => '成功登出:'.$uname.'(id:'.$userId.')',
            ]);
    
        return $this->redirect(['/site/login']);
    }
}
