<?php
use yii\helpers\Html;
//use app\assets\AppAsset;
//use yii\widgets\ActiveForm;
?>
<!DOCTYPE HTML>
<html>
<head>
    <title>后台管理系统</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <?php echo Html::cssFile('@web/assets/css/dpl-min.css')?>
    <?php echo Html::cssFile('@web/assets/css/bui-min.css')?>
    <?php echo Html::cssFile('@web/assets/css/main-min.css')?>
    <?php echo Html::jsFile('@web/js/jquery-1.8.1.min.js')?>
    <?php echo Html::jsFile('@web/assets/js/bui-min.js')?>
    <?php echo Html::jsFile('@web/assets/js/common/main-min.js')?>
    <?php echo Html::jsFile('@web/assets/js/config-min.js')?>
</head>
<body>
	<div class="header">
		<div class="dl-title">
	        <!--<img src="/chinapost/Public/assets/img/top.png">-->
	    </div>
	
	    <div class="dl-log">欢迎您，<span class="dl-log-user" id="<?php echo Yii::$app->user->getId();?>"><?php echo Yii::$app->user->identity->username;?>(<?php echo Yii::$app->user->identity->username;?>)</span>   <span class="glyphicon glyphicon-envelope"></span>  <span class="badge" id="msgnum"><?php if(Yii::$app->session->has('msg')):?> <?php echo Yii::$app->session->get('msg')?><?php else:?>0<?php endif?></span>  <a href="<?php echo Yii::$app->urlManager->createUrl(['admin/index/logout'])?>" title="退出系统" class="dl-log-quit">[退出]</a>
	    </div>
	</div>
<div class="content">
    <div class="dl-main-nav">
        <div class="dl-inform"><div class="dl-inform-title"><s class="dl-inform-icon dl-up"></s></div></div>
        <ul id="J_Nav"  class="nav-list ks-clear">
            <li class="nav-item dl-selected"><div class="nav-item-inner nav-home">系统管理</div></li>		
            <li class="nav-item dl-selected"><div class="nav-item-inner nav-order">用户管理</div></li>
            <li class="nav-item dl-selected"><div class="nav-item-inner nav-order">CMS管理</div></li>
            <li class="nav-item dl-selected"><div class="nav-item-inner nav-tabs">公司管理</div></li>
            <li class="nav-item dl-selected"><div class="nav-item-inner nav-order">微网站管理</div></li>

        </ul>
    </div>
    <ul id="J_NavContent" class="dl-tab-conten">

    </ul>
</div>


<script>
    var test="<?php echo Yii::$app->urlManager->createUrl('user/index/users');?>";
    var thumb="<?php echo Yii::$app->urlManager->createUrl('user/index/thumb');?>";
    var sendmsg="<?php echo Yii::$app->urlManager->createUrl('user/msg/sendmsg');?>";
    var msg="<?php echo Yii::$app->urlManager->createUrl('user/msg/msg')?>";
    var mysend="<?php echo Yii::$app->urlManager->createUrl('user/msg/mysend');?>";
    BUI.use('common/main',function(){
        var config = [
            {id:'1',menu:[
                {text:'设置管理',items:[{id:'101',text:'设置管理',href:"<?php echo Yii::$app->urlManager->createUrl('system/index/index');?>"}]},
                {text:'类别管理',items:[{id:'111',text:'类别管理',href:"<?php echo Yii::$app->urlManager->createUrl('system/area/index');?>"}]},
                {text:'友情链接管理',items:[{id:'121',text:'友情链接管理',href:"<?php echo Yii::$app->urlManager->createUrl('system/links/index');?>"}]},
                {text:'广告管理',items:[{id:'131',text:'广告管理',href:"<?php echo Yii::$app->urlManager->createUrl('system/ad/index');?>"}]},                            
            ]},
            {id:'2',menu:[
            
                {text:'用户管理管理',items:[
                    {id:'201',text:'用户管理',href:"<?php echo Yii::$app->urlManager->createUrl('user/user/index');?>"},
                    {id:'202',text:'资源管理',href:"<?php echo Yii::$app->urlManager->createUrl('user/resources/index');?>"},
                    {id:'203',text:'角色管理',href:"<?php echo Yii::$app->urlManager->createUrl('user/role/index');?>"}
                ]},
                {text:'日记管理',items:[{id:'211',text:'日记管理',href:"<?php echo Yii::$app->urlManager->createUrl('user/admin-logger/index');?>"}]},
             
            ]},
            {id:'3',menu:[
                      
                {text:'CMS管理',items:[
                    {id:'301',text:'分类管理',href:"<?php echo Yii::$app->urlManager->createUrl('cms/catalog/index');?>"},
                    {id:'302',text:'文章管理',href:"<?php echo Yii::$app->urlManager->createUrl('cms/post/index');?>"},
                    {id:'303',text:'单页管理',href:"<?php echo Yii::$app->urlManager->createUrl('cms/page/index');?>"}
                ]},
                  
                         
            ]},  
            {id:'4',menu:[      
                {text:'公司管理',items:[
                    {id:'401',text:'企业列表',href:"<?php echo Yii::$app->urlManager->createUrl('company/index');?>"},
                    {id:'402',text:'待审核企业列表',href:"<?php echo Yii::$app->urlManager->createUrl('company/companycheck');?>"},
                    {id:'403',text:'职位列表',href:"<?php echo Yii::$app->urlManager->createUrl('company/jobs');?>"},
                    {id:'404',text:'待审核职位列表',href:"<?php echo Yii::$app->urlManager->createUrl('company/jobcheck');?>"},
                    {id:'405',text:'企业设置',href:"<?php echo Yii::$app->urlManager->createUrl('company/setting');?>"},
                    {id:'406',text:'企业会员',href:"<?php echo Yii::$app->urlManager->createUrl('company/member');?>"}
                    
                ]},
                  
                         
            ]},  
         
        
                
        ];
        new PageUtil.MainPage({
            modulesConfig : config
        });
    });
</script>
</body>
</html>