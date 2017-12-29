<?php
namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use backend\modules\user\models\AdminLogger;
use common\components\XUtils;
/**
 * Site controller
 */
class BackendBaseController extends Controller
{
    public static $notValidatePermissions = ['app-backend_site_login'];
    public $layout  = '/admin';
    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }
    public function actionError()
    {
         
        if (\Yii::$app->exception !== null) {
            return $this->render('error', ['exception' => \Yii::$app->exception]);
        }
    }
   
    public function beforeAction($action)
    {
    
        if (empty(Yii::$app->user->getId())) {
            Yii::$app->controller->redirect(['/site/login']);
            return false;
        }
        if (Yii::$app->user->identity->group_type != USER_GROUP_TYPE_ADMIN) {
            Yii::$app->controller->redirect(['/site/login']);
            throw new \yii\web\NotFoundHttpException('账号类型不是管理员帐号');
            return false;
        }
        $action         = Yii::$app->controller->action->id;
        $moduleId       = Yii::$app->controller->action->controller->module->id;
        $controllerId   = Yii::$app->controller->action->controller->id;
        $actionId       = Yii::$app->controller->action->id;
        $currIndex      = $moduleId.PERMISSIONS_SEPARATOR.$controllerId.PERMISSIONS_SEPARATOR.$actionId;
        $roleItems      = Yii::$app->authManager->getRolesByUser(Yii::$app->user->getId());
        if (in_array($currIndex, static::$notValidatePermissions)) {
            return true;
        }
        if (!empty($roleItems) && $roleName = array_keys($roleItems)[0]) {
             
            if ($roleName == ADMINISTRATOR) {
                return true;
            }
        }
        if (Yii::$app->authManager->getRolesByUser(Yii::$app->user->getId()) == ADMINISTRATOR) {
            
            return true;
        };
        if (Yii::$app->user->can($currIndex)) {
            return true;
        } else {
            header("Content-type:text/html;charset=utf-8");
            throw new \yii\web\UnauthorizedHttpException('对不起，您现在还没获此操作的权限');
            //echo '对不起，您现在还没获此操作的权限';
            return false;
        }
    }
    
    
    /**
     * 后台日志记录
     * @param  $intro
     */
    static function _adminiLogger (array $arr = array())
    {
        //if(Config::get('admin_logger') == 'open'){
        $model = new AdminLogger();
        $model->attributes = $arr;
        !isset($arr['user_id']) && $model->user_id = intval(Yii::$app->user->getId());
        $action         = Yii::$app->controller->action->id;
        $moduleId       = Yii::$app->controller->action->controller->module->id;
        $controllerId   = Yii::$app->controller->action->controller->id;
        $actionId       = Yii::$app->controller->action->id;
        $currIndex      = $moduleId.PERMISSIONS_SEPARATOR.$controllerId.PERMISSIONS_SEPARATOR.$actionId;
        //$model->url = Yii::$app->request->getScriptFile();
        if (!$model->catalog) $model->catalog = $actionId;
        //$model->url = '';
        $model->resources = $currIndex;
        $model->module_id = $moduleId;
        $model->controller_id = $controllerId;
        $model->action_id = $actionId;
        $model->ip = XUtils::getClientIP();
        $model->create_time = time();
        $model->save();
        //}
    }

}
