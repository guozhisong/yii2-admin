<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '广告位';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ad-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('添加广告位', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'ad_name',
            [
                'label'=>'游戏名称(ID)',
                'attribute' => 'game_id',
                'value' => function ($data) {
                    return \common\models\Game::gameIdToName()[$data->game_id] . '(' . $data->game_id . ')';
                },
            ],
            'position_pic',
            'ad_pic',
            'click_count',
            [
                'label'=>'状态',
                'attribute' => 'state',
                'value' => function ($data) {
                    return \backend\modules\ad\models\AdModel::getStatus()[$data->state];
                },
            ],
            [
                'label'=>'创建时间',
                'attribute' => 'created_at',
                'format' => ['date', 'php:Y-m-d H:i:s'],
            ],
            [
                'label'=>'修改时间',
                'attribute' => 'updated_at',
                'format' => ['date', 'php:Y-m-d H:i:s'],
            ],


            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>



</div>
