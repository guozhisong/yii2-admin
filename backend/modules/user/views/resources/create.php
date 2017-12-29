<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\AuthItem */

$this->title = '新增';
$this->params['breadcrumbs'][] = ['label' => '资源列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="auth-item-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
