<?php

namespace backend\modules\user\controllers;

use Yii;
use backend\modules\user\models\AuthItem;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\Pagination;

use yii\rbac\Item;
/**
 * ResourcesController implements the CRUD actions for AuthItem model.
 */
class ResourcesController extends \backend\controllers\BackendBaseController
{
    
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
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
        $count  = $model->find()->where(['type'=>2])->count();
        $page   = new Pagination(['defaultPageSize' => 10,'totalCount' => $count]);
        $reslut   = $model->find()->where(['type'=>2])
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
        return $this->render('view', [
            'model' => $this->findModel($id),
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
        $model->type = 2;
        $model->setScenario('resources');
        if ($model->load(Yii::$app->request->post()) ) {
            $auth = Yii::$app->authManager;
            $create = $auth->createPermission($model->name);
            $create->description = $model->description;
            try {
                $auth->add($create);
				\backend\controllers\BackendBaseController::_adminiLogger([
	                'catalog' => 'create' ,
	                'intro' => '资源管理-添加 - '.$model->description,
	                'url'=> Yii::$app->urlManager->createUrl('user/resources/index'),
	            ]);
            }catch (yii\base\InvalidParamException $e){
                
            }
            return $this->redirect(['view', 'id' => $model->name]);
        } else {
            return $this->render('create', [
                'model' => $model,
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
        $model->setScenario('resources');
        $oldName = $model->name;
        if ($model->load(Yii::$app->request->post())) {
            $auth = Yii::$app->authManager;
            $item = $auth->getPermission($id);
            $item->name = $model->name;
            $item->description = $model->description;
            $auth->update($oldName, $item);
			
			\backend\controllers\BackendBaseController::_adminiLogger([
	            'catalog' => 'update' ,
	            'intro' => '资源管理-修改 - '.$item->description.'(name:'.$id.')',
	            'url'=> Yii::$app->urlManager->createUrl('user/resources/index'),
	        ]);
            return $this->redirect(['index']);
           
        } else {
            return $this->render('update', [
                'model' => $model,
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

        $auth = Yii::$app->authManager;
        $item = $auth->getPermission($id);
        $auth->remove($item);
		\backend\controllers\BackendBaseController::_adminiLogger([
            'catalog' => 'delete' ,
            'intro' => '资源管理-删除 - '.$item->description.'(name:'.$id.')',
            'url'=> Yii::$app->urlManager->createUrl('user/resources/index'),
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
}
