<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '操作日志';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="admin-logger-index">

	<h1><?= Html::encode($this->title) ?></h1>
	<!--搜索框-->
	<div class="container">
		<div class="row">
			<div class="span12">
				<?php $form = ActiveForm::begin(array('id'=>'searchForm','method'=>'get','action'=>array('/user/admin-logger/index'),'options'=>array('name'=>'xform', 'class'=>'well form-search '))); ?>

				操作类型：<select name="catalog">
					<option value="">不限</option>
					<option <?=Yii::$app->request->get('catalog')=='login'?'selected':''?> value="login">登录</option>
					<option <?=Yii::$app->request->get('catalog')=='logout'?'selected':''?> value="logout">登出</option>
					<option <?=Yii::$app->request->get('catalog')=='create'?'selected':''?> value="create">添加</option>
					<option <?=Yii::$app->request->get('catalog')=='update'?'selected':''?> value="update">修改</option>
					<option <?=Yii::$app->request->get('catalog')=='delete'?'selected':''?> value="delete">删除</option>
					<option <?=Yii::$app->request->get('catalog')=='grantauth'?'selected':''?> value="grantauth">授权</option>

				</select>

				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				时间：<select name="time">
					<option value="0" >不限</option>
					<option value="1" <?=Yii::$app->request->get('time')==1?'selected':''?>>一天内</option>
					<option value="3" <?=Yii::$app->request->get('time')==3?'selected':''?>>三天内</option>
					<option value="7" <?=Yii::$app->request->get('time')==7?'selected':''?>>一周内</option>
					<option value="30" <?=Yii::$app->request->get('time')==30?'selected':''?>>一月内</option>
					<option value="90" <?=Yii::$app->request->get('time')==90?'selected':''?>>三月内</option>
				</select>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<button type="submit" class="btn btn-info"><i class="icon-search"></i> 搜索</button>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				</form>
			</div>
		</div>
	</div>
	<!--搜索框结束-->
	<p>
		<?= Html::a('添加', ['create'], ['class' => 'btn btn-success']) ?>
	</p>

	<?= GridView::widget([
			'dataProvider' => $dataProvider,
			'columns' => [
					['class' => 'yii\grid\SerialColumn'],
					'user.username',
					'user_id',
					'catalog',
//            [
				//'attribute' => 'url',
				//'headerOptions' => ['width' => '190'],
//            ],
					'intro:ntext',
					'ip',
					[
							'attribute' => 'create_time',
							'value'=>
									function($model){
										return  date('Y-m-d H:i:s',$model->create_time);
									},
							'headerOptions' => ['width' => '170'],
					],

					['class' => 'yii\grid\ActionColumn'],
			],
			'pager'=>[
				//'options'=>['class'=>'hidden']//关闭分页
					'firstPageLabel'=>"首页",
					'prevPageLabel'=>'上一页',
					'nextPageLabel'=>'下一页',
					'lastPageLabel'=>'尾页',
			]
	]); ?>

</div>
