<?php

namespace backend\modules\ad\models;

use Yii;
use yii\behaviors\TimestampBehavior;

class AdModel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%ad}}';
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['game_id', 'state', 'ad_name', 'position_pic', 'ad_pic'], 'required'],
            [['game_id', 'click_count', 'state', 'created_at', 'updated_at'], 'integer'],
            [['ad_name', 'position_pic', 'ad_pic'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'game_id' => '游戏 ID',
            'ad_name' => '广告名称',
            'position_pic' => '位置预览图片',
            'ad_pic' => '广告位图片',
            'created_at' => '创建时间',
            'updated_at' => '修改时间',
            'click_count' => '点击率',
            'state' => '状态',
        ];
    }

    public static function getAdList()
    {
        return static::find()->asArray()->all();
    }

    public static function getStatus()
    {
        return [0 => '隐藏', 1 => '显示'];
    }


}
