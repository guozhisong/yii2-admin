<?php
use yii\helpers\Url;
?>

    <?php if($isFirst){ ?>
    	<div class="hot_tuijian_list">
             <div class="h1_hot_list"><span style="color:#136f29;">热文</span>推荐</div>
             <a href="<?php echo Url::to(['show','id'=>$row['id']]); ?>"><img src="<?php echo $row['thumbnail']; ?>" /></a>
             <div class="wenxin_list_hot">
             	<div class="xiao_h1t"><a href="<?php echo Url::to(['show','id'=>$row['id']]); ?>"><?php echo $row['title']; ?></a></div>
               
             	<div class="xiao_h1_jutinekir"><?php echo $row['summary']; ?></div>
                <a href="<?php echo Url::to(['show','id'=>$row['id']]); ?>" class="chamlsnxianq">查看详情</a>
             </div>
             <div class="clear"></div>
        </div>
	<?php }else{ ?>
        <a class="list_link_a_zirewen slv" href="<?php echo Url::to(['show','id'=>$row['id']]); ?>"><?php echo $row['title']; ?></a><div class="diandi_uy">></div>
    <?php } ?>  