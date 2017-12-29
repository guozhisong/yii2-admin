<?php
use yii\helpers\Url;
?>

<?php if($isFirst){ ?>
<div class="text_ts">
	<a class="text_01" target="_blank" href="<?php echo Url::to(['show','id'=>$row['id']]); ?>"><span><?php echo $id + 1;?>、</span><?php echo $row['title'];?></a>
	<div class="text_02"><?php echo $row['summary'];?></div>
</div>
<?php }else{ ?>
<a class="text" target="_blank" href="<?php echo Url::to(['show','id'=>$row['id']]); ?>"><span><?php echo $id + 1;?>、</span><?php echo $row['title'];?></a>
<?php } ?>