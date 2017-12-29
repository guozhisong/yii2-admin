<?php
use yii\helpers\Url;
?>
<?php 
$weekarray=array("日","一","二","三","四","五","六");
?>
<a class="zph <?php if($isFirst){ ?>mt_21<?php } ?>" target="_blank" href="<?php echo Url::to(['show','id'=>$row['id']]); ?>">
	<img src="<?php echo Url::to('@web_frontend/cms/image/zixunindex/zph_01.jpg') ?>" />
	<div class="wenzi">
		<div class="wenzi_01"><?php echo $row['title'];?></div>
		<div class="wenzi_02">时间：
    		<?php echo date('Y-m-d', $row['created_at']);?>(周<?php echo $weekarray[date("w", $row['created_at'])];?>)
		</div>
	</div>
</a>