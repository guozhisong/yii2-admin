<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use \yii\helpers\ArrayHelper;
?>
<style>
    input, select {
        margin-bottom: 15px;
    }
    .ad_pic {
        margin: 15px 0 30px 0;
    }
</style>

<script>
    function fileShow(obj) {
        $('#'+obj).click();
    }

    function fileBlur(currentObj, obj) {
        if ($('#'+obj).val() != '') {
            currentObj.value = $('#'+obj).val();
        }
    }

</script>

<div class="ad-form" style="width: 320px;">

    <?php $form = ActiveForm::begin([
            'options' => ['enctype' => 'multipart/form-data', 'name' => 'form1'],
    ]); ?>

    <?= $form->field($model, 'ad_name')->textInput() ?>

    <?= $form->field($model, 'game_id')->dropDownList(ArrayHelper::map($gameList, 'GameId', 'GameName'), ['prompt' => '请选择游戏...']) ?>

    <?php if ($model->isNewRecord): ?>
        <label for="">位置预览图片</label><input type="file" name="file[]" value=""><br />
    <?php else: ?>
        <p>
            <span style="display: block; float:left;">位置预览图片</span>
            <input type="text" onblur="fileBlur(this, 'position_pic')" onclick="fileShow('position_pic')" style="float:right; width: 200px; height: 25px; line-height: 25px;" name="AdModel['position_pic']" value="<?=basename($model->position_pic)?>"></input>
            <input style="display: none;" id="position_pic" type="file" name="file_position" value=""><br />
        </p>
    <?php endif; ?>

    <?php if ($model->isNewRecord): ?>
        <label for="">广告位图片</label><input type="file" name="file[]" value=""><br />
    <?php else: ?>
        <p>
            <span style="display: block; float:left;">广告位图片</span>
            <input type="text" onblur="fileBlur(this, 'ad_pic')" onclick="fileShow('ad_pic')" style="float:right; width: 200px; height: 25px; line-height: 25px;" name="AdModel['ad_pic']" value="<?=basename($model->ad_pic)?>"></input>
            <input style="display: none;" id="ad_pic" type="file" name="file_ad" value=""><br />
        </p>
    <?php endif; ?>

    <?= $form->field($model, 'state')->dropDownList([1 => '显示', 0 => '隐藏']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '创建' : '保存', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>


