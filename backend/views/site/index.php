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
    <?php echo Html::cssFile('@web_backend/assets/css/dpl-min.css')?>
    <?php echo Html::cssFile('@web_backend/assets/css/bui-min.css')?>
    <?php echo Html::cssFile('@web_backend/assets/css/main-min.css')?>
    <?php echo Html::jsFile('@web_backend/js/jquery-1.8.1.min.js')?>
    <?php echo Html::jsFile('@web_backend/assets/js/bui-min.js')?>
    <?php echo Html::jsFile('@web_backend/assets/js/common/main-min.js')?>
    <?php echo Html::jsFile('@web_backend/assets/js/config-min.js')?>
</head>
<body>
    <div class="header">
        <div class="dl-title">
            <!--<img src="/chinapost/Public/assets/img/top.png">-->
        </div>
        
        <div class="dl-log">欢迎您，<span class="dl-log-user" id="<?php echo Yii::$app->user->getId();?>"><?php echo Yii::$app->user->identity->username;?>(<?php echo Yii::$app->user->identity->username;?>)</span>   <span class="glyphicon glyphicon-envelope"></span>  <span class="badge" id="msgnum"><?php if(Yii::$app->session->has('msg')):?> <?php echo Yii::$app->session->get('msg')?><?php else:?>0<?php endif?></span>  <a href="<?php echo Yii::$app->urlManager->createUrl(['site/logout'])?>" title="退出系统" class="dl-log-quit">[退出]</a>
        </div>
        <div class="dl-log"><a href='/' target="_blank" title="网站首页"class="dl-log-quit">网站首页</a></div>
    </div>
<div class="content">
    <div class="dl-main-nav">
        <div class="dl-inform"><div class="dl-inform-title"><s class="dl-inform-icon dl-up"></s></div></div>
        <ul id="J_Nav"  class="nav-list ks-clear">
            <li class="nav-item dl-selected"><div class="nav-item-inner nav-supplier">用户管理</div></li>
            <li class="nav-item dl-selected"><div class="nav-item-inner nav-home">广告管理</div></li>
<!--            <li class="nav-item dl-selected"><div class="nav-item-inner nav-home">系统管理</div></li>       -->
<!--            <li class="nav-item dl-selected"><div class="nav-item-inner nav-monitor">CMS管理</div></li>-->
<!--            <li class="nav-item dl-selected"><div class="nav-item-inner nav-user">公司管理</div></li>-->
<!--            <li class="nav-item dl-selected"><div class="nav-item-inner nav-user">个人管理</div></li>-->
<!--            <li class="nav-item dl-selected"><div class="nav-item-inner nav-monitor">数据处理</div></li>-->
<!--            <li class="nav-item dl-selected"><div class="nav-item-inner nav-monitor">统计</div></li>-->
<!--            <li class="nav-item dl-selected"><div class="nav-item-inner nav-order">微网站管理</div></li>-->

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

                {text:'用户管理管理',items:[
                    {id:'101',text:'用户管理',href:"<?php echo Yii::$app->urlManager->createUrl('user/user/index');?>"},
                    {id:'102',text:'资源管理',href:"<?php echo Yii::$app->urlManager->createUrl('user/resources/index');?>"},
                    {id:'103',text:'角色管理',href:"<?php echo Yii::$app->urlManager->createUrl('user/role/index');?>"}
                ]},
                {text:'日记管理',items:[{id:'111',text:'日记管理',href:"<?php echo Yii::$app->urlManager->createUrl('user/admin-logger/index');?>"}]},

            ]},
            {id:'2',menu:[
                {text:'广告管理',items:[
                    {id:'201',text:'广告列表',href:"<?php echo Yii::$app->urlManager->createUrl('ad/ad/index');?>"},
                    {id:'202',text:'广告添加',href:"<?php echo Yii::$app->urlManager->createUrl('ad/ad/create');?>"},
                ]},
            ]},
//            {id:'1',menu:[
//                {text:'系统管理',items:[
//                    {id:'101',text:'网站设置',href:"<?php //echo Yii::$app->urlManager->createUrl('system/config/site');?>//"},
//                    {id:'101',text:'个人设置',href:"<?php //echo Yii::$app->urlManager->createUrl('system/config/person');?>//"},
//                ]},
//
//                {text:'类别管理',items:[
//                    {id:'111',text:'地区管理',href:"<?php //echo Yii::$app->urlManager->createUrl('system/area/index');?>//"},
//                    {id:'112',text:'个人类别管理',href:"<?php //echo Yii::$app->urlManager->createUrl(['system/attribute/index', 'type' => 'user']);?>//"},
//                    {id:'113',text:'企业类别管理',href:"<?php //echo Yii::$app->urlManager->createUrl(['system/attribute/index', 'type' => 'com']);?>//"},
//                    {id:'114',text:'职位类别管理',href:"<?php //echo Yii::$app->urlManager->createUrl(['system/attribute/index', 'type' => 'job']);?>//"},
//                ]},
//
//                {text:'友情链接管理',items:[
//                    {id:'121',text:'友情链接分类',href:"<?php //echo Yii::$app->urlManager->createUrl('system/linkclass/index');?>//"},
//                    {id:'122',text:'友情链接列表',href:"<?php //echo Yii::$app->urlManager->createUrl('system/link/index');?>//"},
//                ]},
//                {text:'广告管理',items:[{id:'131',text:'广告管理',href:"<?php //echo Yii::$app->urlManager->createUrl('system/ad/index');?>//"}]},
//                {text:'短信群发',items:[
//                    {id:'131',text:'招聘会',href:"<?php //echo Yii::$app->urlManager->createUrl('system/sms/index');?>//"},
//                ]},
//                {text:'网站地图',items:[{id:'141',text:'网站地图',href:"<?php //echo Yii::$app->urlManager->createUrl('system/sitemap');?>//"}]},
//            ]},
//            {id:'3',menu:[
//
//                {text:'CMS管理',items:[
//                    {id:'301',text:'分类管理',href:"<?php //echo Yii::$app->urlManager->createUrl('cms/channel/index');?>//"},
//                    {id:'302',text:'文章管理',href:"<?php //echo Yii::$app->urlManager->createUrl('cms/post/index');?>//"},
//                    {id:'303',text:'单页管理',href:"<?php //echo Yii::$app->urlManager->createUrl('cms/page/index');?>//"},
//                    {id:'304',text:'标签管理',href:"<?php //echo Yii::$app->urlManager->createUrl('cms/tags/index');?>//"},
//                    {id:'305',text:'聚合管理',href:"<?php //echo Yii::$app->urlManager->createUrl('cms/flag/index');?>//"}
//                ]},
//
//
//            ]},
//            {id:'4',menu:[
//                {text:'公司管理',items:[
//                    {id:'401',text:'企业列表',href:"<?php //echo Yii::$app->urlManager->createUrl('company/index');?>//"},
//                    {id:'402',text:'待审核企业列表',href:"<?php //echo Yii::$app->urlManager->createUrl('company/companycheck');?>//"},
//                    {id:'403',text:'职位列表',href:"<?php //echo Yii::$app->urlManager->createUrl(['company/jobs', 'source' => 'side']);?>//"},
//                    {id:'404',text:'首页热门招聘排序',href:"<?php //echo Yii::$app->urlManager->createUrl('company/jobs/listorder');?>//"},
//                    {id:'405',text:'待审核职位列表',href:"<?php //echo Yii::$app->urlManager->createUrl('company/jobcheck');?>//"},
//                    {id:'406',text:'企业设置',href:"<?php //echo Yii::$app->urlManager->createUrl('company/setting');?>//"},
//                    {id:'407',text:'企业会员',href:"<?php //echo Yii::$app->urlManager->createUrl('company/member');?>//"},
//                    {id:'408',text:'简历下载次数充值',href:"<?php //echo Yii::$app->urlManager->createUrl('company/recharge');?>//"},
//                    {id:'409',text:'简历下载充值记录',href:"<?php //echo Yii::$app->urlManager->createUrl('company/recharge/recode');?>//"},
//                    {id:'410',text:'职位模板列表',href:"<?php //echo Yii::$app->urlManager->createUrl('company/job-tpl');?>//"},
//                    {id:'411',text:'积分充值',href:"<?php //echo Yii::$app->urlManager->createUrl('company/point/insert');?>//"},
//                    {id:'412',text:'积分充值列表',href:"<?php //echo Yii::$app->urlManager->createUrl('company/point/index');?>//"},
//                ]},
//
//            ]},
//            {id:'5',menu:[
//                {text:'简历管理',items:[{id:'221',text:'简历列表',href:"<?php //echo Yii::$app->urlManager->createUrl(['person/resume/index', 'source' => 'side']);?>//"}]},
//                {text:'个人管理',items:[{id:'222',text:'个人列表',href:"<?php //echo Yii::$app->urlManager->createUrl('person/member/index');?>//"}]},
//                {text:'高招会报名',items:[{id:'223',text:'报名列表',href:"<?php //echo Yii::$app->urlManager->createUrl('person/apply/index');?>//"}]},
//            ]},
//            {id:'6',menu:[
//                {text:'重复数据',items:[
//                    {id:'601',text:'重复邮箱',href:"<?php //echo Yii::$app->urlManager->createUrl('data/data/email');?>//"},
//                    {id:'602',text:'重复手机号',href:"<?php //echo Yii::$app->urlManager->createUrl('data/data/mobile');?>//"},
//                ]},
//                {text:'无效邮箱和手机号',items:[
//                    {id:'601',text:'无效邮箱',href:"<?php //echo Yii::$app->urlManager->createUrl('data/data/un-email');?>//"},
//                    {id:'602',text:'无效手机号',href:"<?php //echo Yii::$app->urlManager->createUrl('data/data/un-mobile');?>//"},
//                ]},
//                {text:'已处理用户名列表',items:[
//                    {id:'603',text:'已修改用户名列表',href:"<?php //echo Yii::$app->urlManager->createUrl('data/username/index');?>//"},
//                ]},
//            ]},
//            {id:'7',menu:[
//                {text:'报表统计',items:[
//                    {id:'701',text:'登录报表',href:"<?php //echo Yii::$app->urlManager->createUrl(['journaling/journaling/login','type'=>2]);?>//"},
//                    {id:'702',text:'注册报表',href:"<?php //echo Yii::$app->urlManager->createUrl(['journaling/journaling/reg','type'=>1]);?>//"},
//                    {id:'703',text:'简历投递报表',href:"<?php //echo Yii::$app->urlManager->createUrl('journaling/journaling/deliver');?>//"},
//                    {id:'704',text:'简历更新报表',href:"<?php //echo Yii::$app->urlManager->createUrl('journaling/journaling/resume-update');?>//"},
//                    {id:'705',text:'发布职位报表',href:"<?php //echo Yii::$app->urlManager->createUrl('journaling/journaling/publish');?>//"},
//                ]},
//                {text:'普通统计',items:[
//                    {id:'706',text:'分享统计',href:"<?php //echo Yii::$app->urlManager->createUrl(['journaling/share-page/index']);?>//"},
//                ]}
//            ]},
                
        ];
        new PageUtil.MainPage({
            modulesConfig : config
        });
    });
</script>
</body>
</html>
