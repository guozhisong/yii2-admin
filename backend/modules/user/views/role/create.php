<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\AuthItem */

$this->title = '新增 ';
$this->params['breadcrumbs'][] = ['label' => '角色列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
        <div class="col-md-6">
            <div class="main">
                <?php if(Yii::$app->session->hasFlash('success')):?>
                    <div class="alert alert-success text">
                        <b><?=Yii::$app->session->getFlash('success')?></b>
                    </div>
                <?php endif?>


                <?php if(Yii::$app->session->hasFlash('error')):?>
                    <div class="alert alert-error text">
                        <b><?=Yii::$app->session->getFlash('error')?></b>
                    </div>
                <?php endif?>
                <?= $this->render('_form', [ 'model' => $model,'permissions' => $permissions ]) ?>   
               
            </div>
        </div>

