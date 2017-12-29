<?php

namespace backend\modules\user\controllers;

use Yii;
use yii\web\NotFoundHttpException;
use yii\data\Pagination;
use yii\helpers\ArrayHelper;
use backend\modules\user\models\UserForm;
use common;
use backend\modules\user\models\AuthItem;
class UserController extends \backend\controllers\BackendBaseController
{


    public function actionIndex(){
        $roles  = AuthItem::find()->where(['type'=>1])->asArray()->all();
        $where = UserForm::getConditionForUserList(Yii::$app->request->get());
        $model  = new UserForm();
        $uid    = Yii::$app->user->getId();
        //没有搜索条件的总数量
        $count  = $model->find()->where(['group_type' => USER_GROUP_TYPE_ADMIN])->count();
        //有搜索条件的总数量
        if(!empty($where['where']) || $where['name']){
            $count = $model->find()->joinWith('role')->where($where['where']);
            if($where['name']){
                $count = $count -> andWhere(['like','username',$where['keywords']]);
            }
            $count = $count -> count();
        }
        $page   = new Pagination(['defaultPageSize' => 10,'totalCount' => $count]);
        $users  = $model->find()
                 //->orderBy('id asc')
                 ->offset($page->offset)->limit($page->limit)
                 ->joinWith('role')
                 ->where(['group_type' => USER_GROUP_TYPE_ADMIN])
                 ->AndWhere($where['where']);
        if($where['name']){
            $users = $users -> andWhere(['like','username',$where['keywords']]);
        }
        unset($where);
        $users = $users->asArray()->all();
        return $this->render('index', ['page' => $page,'users' => $users, 'model' => $model,'roles'=>$roles]);
        
    }
    
    public function actionCreate()
    {
        $model = new UserForm();
        $auth   = Yii::$app->authManager;
        $model->setScenario('create');        
        if (Yii::$app->request->isPost && $model->load(Yii::$app->request->post()) && $model->saveUser()) {
            if (!empty($model->role)) {
                $auth->assign($auth->getRole($model->role), $model->id);
            }
            \backend\controllers\BackendBaseController::_adminiLogger([
                'catalog' => 'create' ,
                'intro' => '创建后台用户 - '.$model->username,
                'url'=> Yii::$app->urlManager->createUrl('user/user/index'),
            ]);
            return $this->redirect(['/user/user/index']);
        }
        return $this->render('create', ['model' => $model, 'roles' => $this->getRolesToSelectData()]);
    }
    
    public function actionPassWordReset($id)
    {
        $model = $this->findModel($id);
        $model->setScenario('pass-word-reset');        
        if ($model->load(Yii::$app->request->post()) && $model->passWordReset()) {
            \backend\controllers\BackendBaseController::_adminiLogger([
                'catalog' => 'update' ,
                'intro' => '重置用户密码 - '.$model->username.'(id:'.$model->id.')',
                'url'=> Yii::$app->urlManager->createUrl('user/user/index'),
            ]);
            return $this->redirect(['/user/user/index']);
        } else {
            return $this->render('pass-word-reset', [
                'model' => $model
            ]);
        }
        
    }
    
    public function actionUpdate($id){
        
        $model = $this->findModel($id);
        $model->setScenario('update');
        $auth = Yii::$app->authManager;
        $roleItem = $this->getRoleItemByUserId($model->id);
        $model->role = empty($roleItem->name) ? '' : $roleItem->name;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if (empty($model->role)) {
                $auth->revokeAll($model->id);
                
                \backend\controllers\BackendBaseController::_adminiLogger([
                    'catalog' => 'update' ,
                    'intro' => '修改用户信息 - '.$model->username.'(id:'.$model->id.')',
                    'url'=> Yii::$app->urlManager->createUrl('user/user/index'),
                ]);
                
                return $this->redirect(['/user/user/index']);
            }
            if (empty($roleItem)) {
                $auth->assign($auth->getRole($model->role), $model->id);
            } else if ($roleItem->name != $model->role) {
                if ($auth->revokeAll($model->id)) {
                    $auth->assign($auth->getRole($model->role), $model->id);
                }
            }
                
			\backend\controllers\BackendBaseController::_adminiLogger([
				'catalog' => 'update' ,
				'intro' => '修改用户信息 - '.$model->username.'(id:'.$model->id.')',
				'url'=> Yii::$app->urlManager->createUrl('user/user/index'),
			]);
			
            
            return $this->redirect(['/user/user/index']);
        } else {
            return $this->render('update', [
                'model' => $model,  'roles' => $this->getRolesToSelectData()
            ]);
        }
     
        
    }
    public function actionDel($id){
       $model = $this->findModel($id);
       if($model->delete())
            \backend\controllers\BackendBaseController::_adminiLogger([
                'catalog' => 'delete' ,
                'intro' => '删除用户 - '.$model->username.'(id:'.$model->id.')',
                'url'=> Yii::$app->urlManager->createUrl('user/user/index'),
            ]);
        return $this->redirect(['index']);
 
    }
    
    public function actionGrantAuth($uid)
    {
        $model = common\models\User::findIdentity($uid);
        if ($model === null) throw new NotFoundHttpException('The requested page does not exist.');
        Yii::$app->delegate->setDelegateUser($model);
        if ($model->group_type == 2) {
            \backend\controllers\BackendBaseController::_adminiLogger([
                'catalog' => 'grantauth' ,
                'intro' => '授权公司用户：'.$model->username.'(UID='.$uid.')',
                'url'=> Yii::$app->urlManager->createUrl('company/index/index'),
            ]);
            $url = Yii::$app->request->getHostInfo() . '/company/member';
        } elseif ($model->group_type == 1) {
            \backend\controllers\BackendBaseController::_adminiLogger([
                'catalog' => 'grantauth' ,
                'intro' => '授权个人用户：'.$model->username.'(UID='.$uid.')',
                'url'=> Yii::$app->urlManager->createUrl('person/member/index'),
            ]);
            $url = Yii::$app->request->getHostInfo() . '/person/resume';
        } else {
            throw new NotFoundHttpException('只有企业或个人用户可以授权！');
        }
        echo '<script language="javascript">top.location="'.$url.'";</script>'; 
        die();
    }
    
    public function actionView(){
    
    }
    
    
    public function actionList(){
    
    }
    
    public function getRoleItemByUserId($userId){
        $auth       = Yii::$app->authManager;
        $roleItem   = $auth->getRolesByUser($userId);
        if(empty($roleItem)) return null;
        $roleItem = array_values($roleItem)[0];
        return $roleItem;
        
    }
    public function getRolesToSelectData(){
        $auth   = Yii::$app->authManager;
        $roles  = $auth->getRoles();
        return ArrayHelper::map($roles,'name','name');
    }
    
    /**
     * Finds the WeixinAccount model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return WeixinAccount the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = UserForm::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
