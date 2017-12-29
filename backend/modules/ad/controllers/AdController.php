<?php

namespace backend\modules\ad\controllers;

use backend\controllers\BackendBaseController;
use backend\modules\ad\models\AdModel;
use backend\modules\ad\models\AgentModel;
use common\helpers\FileUpload;
use common\models\Agent;
use common\models\Game;
use common\models\UploadForm;
use common\models\UploadImg;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CompanyController implements the CRUD actions for Company model.
 */
class AdController extends BackendBaseController
{
    public $layout  = '/admin';

    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => AdModel::find(),
            'pagination' => [
//                'pageSize' => 10,
            ],
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionCreate()
    {
        $model = new AdModel();

        if (Yii::$app->request->isPost) {
            $up = new FileUpload();
            //设置属性(上传的位置， 大小， 类型， 名是是否要随机生成)
            $up->set("path", "./static/backend/img/ad/");
            $up->set("maxsize", 2000000);
            $up->set("allowtype", array("gif", "png", "jpg","jpeg"));

            //使用对象中的upload方法， 就可以上传文件， 方法需要传一个上传表单的名子 file, 如果成功返回true, 失败返回false
            if($up->upload("file")) {
                $fileNameArr = $up->getFileName();
                $data = Yii::$app->request->post();
                $data['AdModel']['position_pic'] = "static/backend/img/ad/" . $fileNameArr[0];
                $data['AdModel']['ad_pic'] = "static/backend/img/ad/" . $fileNameArr[1];

                if ($model->load($data) && $model->save()) {
                    return $this->redirect(['view', 'id' => $model->id]);
                } else {
                    echo "<script>alert('广告位添加失败!')</script>";
                }
            } else {
                echo '<pre>';
                //获取上传失败以后的错误提示
                var_dump($up->getErrorMsg());
                echo '</pre>';
            }
        } else {
            $agentList = Agent::getAgentList();   //获取工会列表
            $gameList = Game::getGameList();      //获取游戏列表

            return $this->render('create', [
                'model' => $model,
                'agentList' => $agentList,
                'gameList' => $gameList,
            ]);
        }

    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if (Yii::$app->request->isPost) {
            $up = new FileUpload();
            //设置属性(上传的位置， 大小， 类型， 名是是否要随机生成)
            $up->set("path", "./static/backend/img/ad/");
            $up->set("maxsize", 2000000);
            $up->set("allowtype", array("gif", "png", "jpg","jpeg"));
            $data = Yii::$app->request->post();

            if ($_FILES['file_position']['name'] != '') {
                //使用对象中的upload方法， 就可以上传文件， 方法需要传一个上传表单的名子 file, 如果成功返回true, 失败返回false
                if($up->upload("file_position")) {
                    $fileName1 = $up->getFileName();
                    $data['AdModel']['position_pic'] = "static/backend/img/ad/" . $fileName1;
                } else {
                    echo '<pre>';
                    //获取上传失败以后的错误提示
                    var_dump($up->getErrorMsg());
                    echo '</pre>';
                }
            }

            if ($_FILES['file_ad']['name'] != '') {
                if($up->upload("file_ad")) {
                    $fileName2 = $up->getFileName();
                    $data['AdModel']['ad_pic'] = "static/backend/img/ad/" . $fileName2;
                } else {
                    echo '<pre>';
                    //获取上传失败以后的错误提示
                    var_dump($up->getErrorMsg());
                    echo '</pre>';
                }
            }

            if ($model->load($data) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                echo "<script>alert('广告位修改失败!')</script>";
            }
        } else {
            $agentList = Agent::getAgentList();   //获取工会列表
            $gameList = Game::getGameList();      //获取游戏列表

            return $this->render('update', [
                'model' => $model,
                'agentList' => $agentList,
                'gameList' => $gameList,
            ]);
        }
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
        if (($model = AdModel::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
