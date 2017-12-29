<?php

namespace common\models;

use Yii;

class Game extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%publish_5}}';
    }

    public static function getDb()
    {
        return Yii::$app->get('db3');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['GameId'], 'integer'],
            [['GameName'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'GameId' => '游戏 ID',
            'GameName' => '游戏名称',
        ];
    }

    public static function getGameList()
    {
        return static::find()->select('GameId, GameName')->where(['ServiceStatus' => 1])->asArray()->all();
    }

    public static function gameIdToName()
    {
        $list = static::getGameList();

        return array_column($list, 'GameName', 'GameId');
    }


}
