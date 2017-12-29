<?php

namespace common\models;

use Yii;

class Agent extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%agent}}';
    }

    public static function getDb()
    {
        return Yii::$app->get('db2');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['agentname'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '工会 ID',
            'agentname' => '工会名称',
        ];
    }

    public static function getAgentList()
    {
        return static::find()->select('id, agentname')->where(['state' => 1])->asArray()->all();
    }

    public static function agentIdToName()
    {
        $list = static::getAgentList();

        return array_column($list, 'agentname', 'id');
    }


}
