<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\AuthItem */
/* @var $form yii\widgets\ActiveForm */
?>

    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'name')->textInput(['maxlength' => 64])->label('名称'); ?>
    <div style="display:none">
    <?= $form->field($model, 'type',['labelOptions' => ['label' => '类型','class' => 'style:display:none;']])->hiddenInput() ?>
    </div>
    <?= $form->field($model, 'description')->textInput(['maxlength' => 64])->label('描述'); ?>
    <dl>
    <?php 
    if (!empty($permisGroup)) {
        foreach ($permisGroup as $key => $val) {
            echo '<dt>'.$key.'</dt>'.chr(10);
            foreach ($val as $k => $v) {
                echo '<dd><label><input type="checkbox" name="AuthItem[permissions][]" value="'.$k.'"'.
                (in_array($k, $model->permissions) ? 'checked' : '') . '> ' . $v . '</label></dd>' . chr(10);
            }    
        }
    }
  ?>
  </dl>
    <?php //echo $form->field($model, 'permissions')->checkboxList($permissions)->label('权限列表'); ?>
    <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    <?php ActiveForm::end(); ?>

