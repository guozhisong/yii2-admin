<?php

namespace common\helpers;

use Yii;
use yii\helpers\VarDumper;

/**
 * 格式化助手类 
 */
class FormatHelper
{

    public static function getAttrNameById($id)
    {
        if (strpos($id, ',') > 0) {
            $ids = explode(',', $id);
            $str = '';
            foreach ($ids as $id) {
                $str .= Yii::$app->attributeCache->getNameById($id) . ',';
            }
            return rtrim($str, ',');
        } else {
            $id = (int)$id;
            return Yii::$app->attributeCache->getNameById($id);
        }
    }

    public static function getAreaNameById($id)
    {
        if (strpos($id, ',') > 0) {
            $ids = explode(',', $id);
            $str = '';
            foreach ($ids as $id) {
                $str .= Yii::$app->areaCache->getNameById($id) . ',';
            }
            return rtrim($str, ',');
        } else {
            $id = (int)$id;
            return Yii::$app->areaCache->getNameById($id);
        }
    }
    
}



