<?php
use yii\helpers\Url;
?>

<a <?php if($index<3){ ?> class="qian3" <?php } ?> href="<?php echo Url::to(['/news/default/show','id'=>$row['id']]); ?>"><span><?php echo $index+1; ?></span><?php echo $row['title']; ?></a>