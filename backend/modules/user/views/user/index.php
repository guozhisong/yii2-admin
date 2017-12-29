<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
$this->title = '用户列表';
$this->params['breadcrumbs'][] = $this->title;
echo '共有<'.$page -> totalCount.'>个用户';
?>
    <script>
        $(function(){
            var currIndex = '';
            $(".btn-del").click(function(){
         	   $('#myModal').modal('show');
          	   currIndex = $(this).attr('title');
               $(".text-info").html('是否确定删除 :<B>'+$('#user_name_'+currIndex).html()+'</B>用户');
            });
            
            //确定按钮
            $(".sure").click(function(){
                $('#myModal').modal('hide');
                var BaseUrl = '<?php echo Yii::$app->urlManager->createUrl(['user/user/del','id'=>'%s'])?>';
                BaseUrl = BaseUrl.replace('id=%25s', 'id='+currIndex);
                $.get(BaseUrl, function(data){
              	   if(data && data.status==1){
                		 //alert("Data Loaded: " + data.id);
                		 window.location.href="<?php echo Yii::$app->urlManager->createUrl('user/user/index');?>";
                   }else{
                	     alert("删除失败 " );
                   }
              	   
              	},'json');
                
            })

            

        })
    </script>
    
        <div class="col-md-12">
            <div class="main">
            	<!--搜索框-->
	 	<div class="container">
	      <div class="row">
	        <div class="span12">
				<?php $form = ActiveForm::begin(array('id'=>'searchForm','method'=>'get','action'=>array('/user/user/index'),'options'=>array('name'=>'xform', 'class'=>'well form-search '))); ?>
					
				选择角色：<select name="roles">
					<option value="">请选择</option>
	  				<?php if ($roles):?>
	  					<?php foreach($roles as $k=>$v):?>
	  				<option value="<?=$v['name']?>" <?=Yii::$app->request->get('roles')==$v['name']?'selected':''?>><?=$v['description']?></option>
	  					<?php endforeach;?>
	  				<?php endif;?>
	  				</select>
	  			
	  			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	  			<select name="type">
	  				<option value="0" <?=Yii::$app->request->get('type')==0?'selected':''?>>用户编号</option>
	  				<option value="1" <?=Yii::$app->request->get('type')==1?'selected':''?>>用户名称</option>
	  			</select>
	  			<input type="text" class="input-medium search-query" name="keywords" value="<?php echo  Yii::$app->request->get('keywords')?>"/>
	  			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	  			<button type="submit" class="btn btn-info"><i class="icon-search"></i> 搜索</button>
	  			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	  			<button type="submit" class="btn btn-info"><i class="icon-search"></i> 刷新</button>
			</form>
			</div>
			</div>
	   	</div>
	   	<!--搜索框结束-->
                <div class="tool">
                    <a class="btn btn-primary btn-sm" href="<?php echo Yii::$app->urlManager->createUrl('user/user/create')?>">新增用户</a>
                </div>
                
                <table class="table table-hover">
                    <tr>
                        <th><?php echo $model->attributeLabels()['id'];?></th>
                        <th><?php echo $model->attributeLabels()['username'];?></th>
                        <th><?php echo $model->attributeLabels()['role'];?></th>
                        <th><?php echo $model->attributeLabels()['nickname'];?></th>
                        <th>操作</th>
                    </tr>
                    <?php if(count($users)>0):?>
                   
                        <?php foreach($users as $v):?>
                       
                        <tr>
                            <td><?php echo $v['id'];?></td>
                            <td class="user_name" id="user_name_<?php echo $v['id'];?>"><?php echo $v['username']?></td>
                            <td><?php echo $v['role']['item_name'];?></td>
                            <td><?php echo $v['nickname']?></td>
                            <td>
                                
                                   <a class="btn btn-sm btn-danger" href="<?php echo Yii::$app->urlManager->createUrl(['user/user/update','id'=> $v['id']]);?>">修改</a>
                                   <a class="btn btn-sm btn-danger" href="<?php echo Yii::$app->urlManager->createUrl(['user/user/pass-word-reset','id'=> $v['id']]);?>">密码重置</a>
                             
                                   <a class="btn btn-sm btn-danger btn-del" href="<?php echo Yii::$app->urlManager->createUrl(['user/user/del','id'=> $v['id']]);?>" data-pjax="0" data-method="post" data-confirm="确定要删除么?" title="Delete">删除</a>
                                
                            </td>
                        </tr>
                        <?php endforeach?>
                    <?php else:?>
                        <tr><td colspan="5">暂无消息！</td></tr>
                    <?php endif?>
                </table>
                <div class="page">
                    <?php echo \common\widgets\CustomPager::widget([
                        'pagination' => $page,
                        'location' => true,
                    ]);?>
                </div>
            </div>
        </div>

<!-- Modal -->
<div class="modal fade" id="myModal" url='' tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">消息提示</h4>
            </div>
            <div class="modal-body">
                <p class='text-info'>
                    <div class="from"></div>
                    <div class="to"></div>
                    <div class="content"></div>
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary sure">确定</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->