<?php 
use yii\helpers\Url;
use common\widgets\Loop;
use common\models\CmsPost;
use common\models\CompanyJob;
use common\models\Company;
use common\models\Area;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\assets\AppAsset;
?>

<div>
	<div class="js-jobLoc-allLoc">
		<div class="cj-jobLoc-item-wrap">
			<div class="cj-jobLoc-highLight cj-jobLoc-item">
				<span class="js-jobLoc-all" data="0">全国</span>
			</div>
		</div>
		<div class="clear"></div>

		<div class="cj-jobLoc-subtitle">热门城市</div>

		<div class="cj-jobLoc-item-wrap">
			<?php if($hotArea): foreach($hotArea as $key=>$val):?>
			<div class="cj-jobLoc-highLight cj-jobLoc-item">
				<span class="js-jobLoc-hotCity" data='<?=$key?>'><?=$val?></span>
			</div>
			<?php endforeach;endif;?>

			<div class="clear"></div>
		</div>

		<div class="cj-jobLoc-subtitle">全部省份</div>

		<div class="cj-jobLoc-item-wrap">
			<?php if($parentArea): foreach($parentArea as $key=>$val):?>
			<div class="cj-jobLoc-item">
				<span class="js-jobLoc-province" data='<?=$key;?>'><?=$val['areaname'];?></span>
			</div>
			<?php endforeach;endif;?>

			<div class="clear"></div>
		</div>
	</div>

	<div>
		<?php if($parentArea): foreach($parentArea as $key=>$val):?>
		<div class="cj-jobLoc-item-wrap">
			<div class="cj-jobLoc-province cj-jobLoc-item">
				<span class="js-jobLoc-pCity" data='<?=$key?>'><?=$val['areaname'];?></span>
			</div>

			<div class="clear"></div>
			<div class="cj-jobLoc-item-wrap">
				<?php if(!empty($val[ 'child'])): foreach($val[ 'child'] as $k=>$v):?>
				<div class="cj-jobLoc-item cj-jobLoc-subitem">
					<span class="js-jobLoc-city" data='<?=$k?>' data-parent='<?=$key?>'><?=$v['areaname']?></span>
				</div>
				<?php endforeach;endif;?>

				<div class="clear"></div>
			</div>
		</div>
		<?php endforeach;endif;?>
	</div>
</div>


<div>
	<!--所属职能弹出层开始-->
		<div id="js-function-dialog" class="cj-dialog-container">
			<div class="js-function-item-wrap cj-function-item-wrap">
				<?php if (!empty($jobCategory)) { foreach ($jobCategory as $v) {?>
					<div class="cj-function-item">
						<span class="js-function-item" data="<?php echo $v['id'];?>"><?php echo $v['name']?></span>
					</div>
				<?php }}?>
			</div>
			<?php if (!empty($jobCategory)) { foreach ($jobCategory as $v) {?>
				<div class="cj-function-item-wrap">
					<?php if (!empty($v['child'])) : $i = 0; foreach ($v['child'] as $k) :$i++; ?>
						<div class="cj-function-subitem">
							<span class="js-function-subitem" data="<?php echo $k['id'];?>" data-parent="<?php echo $v['id'];?>"><?php echo $k['name'];?></span>
						</div>
					<?php endforeach;endif;?>
				</div>
			<?php }}?>
		</div>
		<!--所属职能弹出层结束-->
</div>