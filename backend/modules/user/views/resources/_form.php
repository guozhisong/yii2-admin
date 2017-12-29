<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\AuthItem */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="auth-item-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => 64]) ?>

    <div style="display: none">
    <?= $form->field($model, 'type',['labelOptions' => ['label' => '','class' => 'style:display:none;']])->hiddenInput() ?>
    </div>
    <?= $form->field($model, 'description')->textInput() ?>
    <?= $form->field($model, 'rule_name')->textInput(['maxlength' => 64]) ?>
    <?= $form->field($model, 'data')->textInput() ?>
    

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
