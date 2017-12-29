<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Alert;

$this->title = '密码重置';
$this->params['breadcrumbs'][] = ['label' => '用户管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>修改用户</title>
    <?=Html::cssFile('@web/css/bootstrap.min.css')?>
    <?=Html::cssFile('@web/css/site.css')?>
    <?=Html::jsFile('@web/Js/jquery.js')?>
    <?=Html::jsFile('@web/Js/bootstrap.js')?>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="main">
                <h1><?php echo $this->title;?></h1>
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
                <?php $form=ActiveForm::begin(); ?>
             
                <?= $form->field($model,'username');?>

                <?= $form->field($model,'password')->textInput();?>
                <?=Html::submitButton('重置',['class'=>'btn btn-primary'])?>
                <?php ActiveForm::end()?>
              
            </div>
        </div>
    </div>
</div>



</body>
</html>