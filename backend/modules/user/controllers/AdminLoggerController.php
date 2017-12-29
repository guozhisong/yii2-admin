<?php

namespace backend\modules\user\controllers;

use Yii;
use backend\modules\user\models\AdminLogger;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;


/**
 * AdminLoggerController implements the CRUD actions for AdminLogger model.
 */
class AdminLoggerController extends \backend\controllers\BackendBaseController
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
     * Lists all AdminLogger models.
     * @return mixed
     */
    public function actionIndex($sort='create_time desc')
    {
        $where = [];$andwhere = [];
        if(isset($_GET['catalog']) && !empty($_GET['catalog']))
            $where['catalog'] = $_GET['catalog'];
        if(isset($_GET['time']) && !empty($_GET['time'])){
            $time = '';
            switch ($_GET['time']) {
                case '1':
                    $time = strtotime("-1 day");
                    break;
                case '3' :
                    $time = strtotime("-3 day");
                    break;
                case '7' :
                    $time = strtotime("-1 week");
                    break;
                case '30' :
                    $time = strtotime("last month");
                    break;
                case '90' :
                    $time = strtotime("-3 month");
                    break;
            }
            $andwhere = ['>','create_time',"$time"];
        }

        $dataProvider = new ActiveDataProvider([
            'query' => AdminLogger::find()->with('user')->where($where)->andWhere($andwhere),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AdminLogger model.
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
     * Creates a new AdminLogger model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new AdminLogger();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            \backend\controllers\BackendBaseController::_adminiLogger([
                'catalog' => 'create' ,
                'intro' => '添加日志 - '.$model->intro,
                'url'=> Yii::$app->urlManager->createUrl('user/admin-logger/index'),
            ]);

            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing AdminLogger model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            \backend\controllers\BackendBaseController::_adminiLogger([
                'catalog' => 'delete' ,
                'intro' => '修改日志 - '.$model->intro.'(id:'.$model->id.')',
                'url'=> Yii::$app->urlManager->createUrl('user/admin-logger/index'),
            ]);
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing AdminLogger model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model -> delete();

        \backend\controllers\BackendBaseController::_adminiLogger([
            'catalog' => 'delete' ,
            'intro' => '删除日志 - '.$model->intro.'(id:'.$model->id.')',
            'url'=> Yii::$app->urlManager->createUrl('user/admin-logger/index'),
        ]);

        return $this->redirect(['index']);
    }

    /**
     * Finds the AdminLogger model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return AdminLogger the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AdminLogger::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
