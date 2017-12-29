<?php

namespace backend\modules\user\controllers;

use Yii;
use backend\modules\user\models\AuthItem;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\Pagination;
use yii\helpers\ArrayHelper;
/**
 * ResourcesController implements the CRUD actions for AuthItem model.
 */
class RoleController extends \backend\controllers\BackendBaseController
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                   // 'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all AuthItem models.
     * @return mixed
     */
    public function actionIndex()
    {
        
        $model  = new AuthItem();
        $uid    = Yii::$app->user->getId();
        $count  = $model->find()->where(['type'=>1])->count();
        $page   = new Pagination(['defaultPageSize' => 5, 'totalCount' => $count]);
        $reslut   = $model->find()->where(['type'=>1])
        ->orderBy('name asc')->offset($page->offset)->limit($page->limit)
        ->asArray()
        ->all();
        return $this->render('index', ['page' => $page,'reslut' => $reslut, 'model' => $model]);
    }

    /**
     * Displays a single AuthItem model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {

        $permissions = $this->getPermissionsToSelectData();
        $model = $this->findModel($id);
        $model->setAttribute('permissions', implode(ArrayHelper::getColumn(Yii::$app->authManager->getPermissionsByRole($id),'name'), ','));
        return $this->render('view', [
            'model' => $model,'permissions' => $permissions
        ]);
    }

    /**
     * Creates a new AuthItem model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new AuthItem();
        $auth = Yii::$app->authManager;
        $permissions = $this->getPermissionsToSelectData();
        //$model->permissions = ['admin-index-index','updatePost'];
        $model->setScenario('role');
        if ($model->load(Yii::$app->request->post())) {
            $auth = Yii::$app->authManager;
            $createRole = $auth->createRole($model->name);
            $createRole->description = $model->description;
            $flag = false;
            try {
                $flag = $auth->add($createRole);
				\backend\controllers\BackendBaseController::_adminiLogger([
	                'catalog' => 'create' ,
	                'intro' => '角色管理-添加 - '.$model->description,
	                'url'=> Yii::$app->urlManager->createUrl('user/role/index'),
	            ]);
            }catch (yii\base\InvalidParamException $e){
               
            }
            if($flag && !empty($model->permissions)){
                foreach ($model->permissions as $val){
                    $auth->addChild($createRole, $auth->getPermission($val));
                }
               
            }
            return $this->redirect(['view', 'id' => $model->name]);
        } else {
            $model->type = 1;
            return $this->render('create', [
                'model' => $model,'permissions' => $permissions
            ]);
        }
    }

    /**
     * Updates an existing AuthItem model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {

        $model = $this->findModel($id);
        $model->setScenario('role');
        $permissions = $this->getPermissionsToSelectData();
        $permisGroup = [];
        foreach ($permissions as $k => $v) {
            list($m, $c, $a) = explode(PERMISSIONS_SEPARATOR, $k);
            $permisGroup[isset(Yii::$app->params['backModulesZh'][$m]) ? Yii::$app->params['backModulesZh'][$m] : $m][$k] =  $v;
        }
        $oldPermissions = Yii::$app->authManager->getPermissionsByRole($id);
        if(!empty($oldPermissions)){
            $oldPermissions = array_keys($oldPermissions);
            $model->permissions = $oldPermissions;
        }else{
            $model->permissions = [];
        }
        
        if ($model->load(Yii::$app->request->post())) {
            $auth = Yii::$app->authManager;
            $item = $auth->getRole($id);
            $item->description = $model->description;
 
            $flag = false;
            try {
            	\backend\controllers\BackendBaseController::_adminiLogger([
		            'catalog' => 'update' ,
		            'intro' => '角色管理-修改 - '.$item->description.'(name:'.$id.')',
		            'url'=> Yii::$app->urlManager->createUrl('user/role/index'),
		        ]);
               $flag = $auth->update($model->name, $item);
            } catch (\Exception $e) {
                
            }
            if($flag == false){
                return $this->redirect(['view', 'id' => $id]);
            }
            //没有修改
            if($oldPermissions == $model->permissions){
                return $this->redirect(['view', 'id' => $id]);
            }
            //array_i
            if(empty($oldPermissions) && empty($model->permissions)){
                return $this->redirect(['view', 'id' => $id]);
            }
            //清空
            if(!empty($oldPermissions) && empty($model->permissions)){
                $auth->removeChildren($item);
                return $this->redirect(['view', 'id' => $id]);
            }
            //求交集 更新
            $addItems = array_diff($model->permissions, $oldPermissions);
            $removeItems = array_diff($oldPermissions, $model->permissions);
            if(!empty($addItems)){
                foreach ($addItems as $val){
                    $auth->addChild($item, $auth->getPermission($val));
                }
            }
            if(!empty($removeItems)){
                foreach ($removeItems as $val){
                    $auth->removeChild($item, $auth->getPermission($val));
                }
            }
            return $this->redirect(['view', 'id' => $id]);
        } else {
            return $this->render('update', [
                'model' => $model, 'permisGroup' => $permisGroup
            ]);
        }
    }

    /**
     * Deletes an existing AuthItem model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        //$this->findModel($id)->delete();
        $auth = Yii::$app->authManager;
        $item = $auth->getRole($id);
        $auth->remove($item);
		\backend\controllers\BackendBaseController::_adminiLogger([
            'catalog' => 'delete' ,
            'intro' => '角色管理-删除角色 - '.$item->description.'(name:'.$id.')',
            'url'=> Yii::$app->urlManager->createUrl('user/role/index'),
        ]);
        return $this->redirect(['index']);
    }

    /**
     * Finds the AuthItem model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return AuthItem the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AuthItem::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function getPermissionsToSelectData(){
        $auth = Yii::$app->authManager;
        $roles = $auth->getPermissions();
        return ArrayHelper::map($roles,'name','description');
    }
}
