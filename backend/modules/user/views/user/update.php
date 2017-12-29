<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Alert;
$this->title = '更新';
$this->params['breadcrumbs'][] = ['label' => '用户列表', 'url' => ['/user/user/index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="main">
                <h1>添加用户</h1>
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
                <?= $this->render('_form', [ 'model' => $model,'roles' => $roles ]) ?>  
              
            </div>
        </div>
    </div>
</div>
