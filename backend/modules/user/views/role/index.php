<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '角色列表 ';
$this->params['breadcrumbs'][] = $this->title;
?>
 <div class="col-md-12">
            <div class="main">
                <div class="tool">
                    <a class="btn btn-primary btn-sm" href="<?php echo Yii::$app->urlManager->createUrl('user/role/create')?>">新增</a>
                </div>
                <table class="table table-hover">
                    <tr>
                        <th><?php echo $model->attributeLabels()['name'];?></th>
                        <th><?php echo $model->attributeLabels()['description'];?></th>
           
                        <th>操作</th>
                    </tr>
                    <?php if(count($reslut)>0):?>
                   
                        <?php foreach($reslut as $v):?>
                       
                        <tr>
                            <td><?php echo $v['name'];?></td>
                            <td class="user_name" id="user_name_<?php echo $v['name'];?>"><?php echo $v['description']?></td>
                           
                            <td>
                                   <a class="btn btn-sm btn-danger" href="<?php echo Yii::$app->urlManager->createUrl(['user/role/update','id'=> $v['name']]);?>">修改</a>
                                   <a class="btn btn-sm btn-danger btn-del" title="Delete" data-confirm="Are you sure you want to delete this item?" data-method="post" data-pjax="0" onclick="return confirm('确定要删除么？');" href="<?php echo Yii::$app->urlManager->createUrl(['user/role/delete','id'=> $v['name']]);?>">删除</a>
                                
                            </td>
                        </tr>
                        <?php endforeach?>
                    <?php else:?>
                        <tr><td colspan="5">暂无消息！</td></tr>
                    <?php endif?>
                </table>
                <div class="page">
                    <?php echo  \yii\widgets\LinkPager::widget(['pagination' => $page]) ?>
                </div>
            </div>
        </div>

