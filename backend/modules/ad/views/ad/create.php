<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Company */

$this->title = '添加广告位';
$this->params['breadcrumbs'][] = ['label' => '广告位列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ad-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'agentList' => $agentList,
        'gameList' => $gameList,
    ]) ?>

</div>

