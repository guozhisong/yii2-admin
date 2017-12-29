<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use pjkui\kindeditor\KindEditor;
/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\AuthItem */
/* @var $form yii\widgets\ActiveForm */
?>
<?php $form=ActiveForm::begin(); ?>
<?= $form->field($model,'username')->textInput();?>
<?= $form->field($model,'nickname')->textInput();?>
<?php if($model->isNewRecord){?>
<?= $form->field($model,'password')->textInput();?>
<?=$form->field($model, 'status')->hiddenInput(['value'=>10]) ?>
<?php }?>
<?= $form->field($model, 'role')->dropDownList($roles,['prompt' => '请选择角色'])->label('选择角色');?>
<?=Html::submitButton('添加',['class'=>'btn btn-primary'])?>
<?php ActiveForm::end()?>
