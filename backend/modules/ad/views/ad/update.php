<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Company */

$this->title = '广告位修改: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => '广告位列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '';
?>
<div class="ad-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'agentList' => $agentList,
        'gameList' => $gameList,
    ]) ?>

</div>
