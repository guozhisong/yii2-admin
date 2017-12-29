<?php
use yii\helpers\Url;
use common\helpers\Abc;
?>

<div class="text">
	<a class="text_01" target="_blank" href="<?php echo Url::to(['show','id'=>$row['id']]); ?>"><?php echo $row['title']; ?></a>
	<div class="text_02">
		<img src="<?php echo $row['thumbnail']; ?>" />
		<span><?php echo Abc::truncate_utf8_string($row['summary'],34);?></span>
		<a href="<?php echo Url::to(['show','id'=>$row['id']]); ?>">[详细]</a><!--44个字数-->
	</div>
</div>

