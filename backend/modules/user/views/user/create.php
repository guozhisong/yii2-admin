<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Alert;
$this->title = '新增';
$this->params['breadcrumbs'][] = ['label' => '用户列表', 'url' => ['/user/user/index']];
$this->params['breadcrumbs'][] = $this->title;
?>

    <script>
        $(function(){
            ckinfo();
            //检查信息框
            function ckinfo(){
                var len=$(".text").length;
                if(len){
                    fadeInfo();
                }
            }

            //消息消失动画
            function fadeInfo(){
                setTimeout(function(){
                    //alert('消息框即将消失！');
                    $(".text").fadeOut(800);
                },1000)
            }

        })
    </script>
<div class="container">
    <div class="row">
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
                <?= $this->render('_form', [ 'model' => $model,'roles' => $roles ]) ?>   
               
            </div>
        </div>
    </div>
</div>
