<?php

use yii\helpers\Html;
use yii\grid\GridView;

$this->title = '资源列表';
$this->params['breadcrumbs'][] = $this->title;
echo '共有<'.$page -> totalCount.'>条权限';
?>
 <div class="col-md-12">
            <div class="main">
                <div class="tool">
                    <a class="btn btn-primary btn-sm" href="<?php echo Yii::$app->urlManager->createUrl('user/resources/create')?>">新增</a>
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
                                   <a class="btn btn-sm btn-danger" href="<?php echo Yii::$app->urlManager->createUrl(['user/resources/update','id'=> $v['name']]);?>">修改</a>
                                   <a class="btn btn-sm btn-danger btn-del" title="Delete" data-confirm="确定要删除么?" data-method="post" data-pjax="0" href="<?php echo Yii::$app->urlManager->createUrl(['user/resources/delete','id'=> $v['name']]);?>">删除</a>
                                
                            </td>
                        </tr>
                        <?php endforeach?>
                    <?php else:?>
                        <tr><td colspan="5">暂无消息！</td></tr>
                    <?php endif?>
                </table>
                <div class="page">
                    <?= \common\widgets\CustomPager::widget(['pagination' => $page,'location'=>true]);?>
                </div>
            </div>
        </div>

