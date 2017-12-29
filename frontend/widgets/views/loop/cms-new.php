<?php
use yii\helpers\Url;
?>

<?php if($isFirst){ ?>
<div class="hot_tuijian_list">
           <div class="h1_hot_list" style=" float:left; font-weight:600; width:80%; margin-bottom:22px;"><span style="color:#136f29;">最新</span>资讯</div>
      <a class="gengduo_09hh" style="margin-top:0px;" href="<?php echo Url::to(['list','id'=>132]); ?>">更多</a>
      <div class="clear"></div>
           <a href="<?php echo Url::to(['show','id'=>$row['id']]); ?>" target="_blank"><img src="<?php echo $row['thumbnail'];?>"></a>
           <div class="wenxin_list_hot">
           	<div class="xiao_h1t"><a href="<?php echo Url::to(['show','id'=>$row['id']]); ?>" target="_blank"><?php echo $row['title'];?></a></div>
             
           	<div title="<?php echo $row['title'];?>" class="xiao_h1_jutinekir"><?php echo $row['summary'];?></div>
              <a href="<?php echo Url::to(['show','id'=>$row['id']]); ?>" target="_blank" class="chamlsnxianq">查看详情</a>
           </div>
           <div class="clear"></div>
      </div>
<?php }else{ ?>
<a class="list_link_a_zirewen slv" href="<?php echo Url::to(['show','id'=>$row['id']]); ?>" target="blank"><?php echo $row['title'];?></a><div class="diandi_uy">&gt;</div>
<?php } ?>