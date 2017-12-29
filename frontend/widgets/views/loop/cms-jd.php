<?php
use yii\helpers\Url;
?>

<a href="<?php echo Url::to(['show','id'=>$row['id']]); ?>" target="_blank" class="zuinxin_imga">
	<img src="<?php echo $row['thumbnail']; ?>" />
	<div class="rrise_ok opacity"></div>
	<div class="rrise_kk slv"><?php echo $row['title']; ?></div>
</a>