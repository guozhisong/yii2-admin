<?php
use yii\helpers\Url;
?>

<?php if(($index%2)==0){ ?>
<li class="clearfix">
	<a href="<?php echo Url::to(['/news/default/show','id'=>$row['id']]); ?>"><span><?php echo $row['title']; ?></span><?php echo date('Y-m-d',$row['created_at']); ?></a>
</li>
<?php }else{ ?>
<li class="clearfix mr_0">
	<a href="<?php echo Url::to(['/news/default/show','id'=>$row['id']]); ?>"><span><?php echo $row['title']; ?></span><?php echo date('Y-m-d',$row['created_at']); ?></a>
</li>
<?php } ?>

