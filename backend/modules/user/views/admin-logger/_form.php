<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\AdminLogger */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="admin-logger-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'user_id')->textInput(['maxlength' => 10]) ?>

    <?= $form->field($model, 'catalog')->dropDownList([ 'login' => 'Login', 'create' => 'Create', 'update' => 'Update', 'delete' => 'Delete', 'other' => 'Other', 'browse' => 'Browse', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'url')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'intro')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'ip')->textInput(['maxlength' => 15]) ?>

    <?= $form->field($model, 'create_time')->textInput(['maxlength' => 10]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
