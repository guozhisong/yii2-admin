<?php

use yii\helpers\Html;

$this->title = '修改: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => '资源列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = '修改';
?>
<div class="auth-item-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
