<?php

namespace backend\modules\user\models;

use Yii;
use common\models\User;

/**
 * This is the model class for table "{{%admin_logger}}".
 *
 * @property string $id
 * @property string $user_id
 * @property string $catalog
 * @property string $url
 * @property string $intro
 * @property string $ip
 * @property string $create_time
 */
class AdminLogger extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%admin_logger}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'create_time'], 'integer'],
            [['catalog', 'intro'], 'string'],
            [['url'], 'string', 'max' => 255],
            [['ip'], 'string', 'max' => 15]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user.username' => '用户名',
            'user_id' => '用户id',
            'catalog' => '类型',
            'resources' => '',
            'module_id' => '',
            'controller_id' => '',
            'action_id' => '',
            'url' => 'url',
            'intro' => '操作',
            'ip' => '操作ip',
            'create_time' => '操作时间',
        ];
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id'=>'user_id']);
    }

}
