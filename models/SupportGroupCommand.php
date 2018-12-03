<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "support_group_command".
 *
 * @property int $id
 * @property int $support_group_id
 * @property string $command
 * @property int $is_default
 * @property int $updated_at
 * @property int $updated_by
 *
 * @property SupportGroup $supportGroup
 * @property SupportGroupCommandText[] $supportGroupCommandTexts
 */
class SupportGroupCommand extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'support_group_command';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['support_group_id', 'command', 'is_default', 'updated_at', 'updated_by'], 'required'],
            [['support_group_id', 'is_default', 'updated_at', 'updated_by'], 'integer'],
            [['command'], 'string', 'max' => 255],
            [['support_group_id'], 'exist', 'skipOnError' => true, 'targetClass' => SupportGroup::className(), 'targetAttribute' => ['support_group_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'support_group_id' => 'Support Group ID',
            'command' => 'Command',
            'is_default' => 'Is Default',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSupportGroup()
    {
        return $this->hasOne(SupportGroup::className(), ['id' => 'support_group_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSupportGroupCommandTexts()
    {
        return $this->hasMany(SupportGroupCommandText::className(), ['support_group_command_id' => 'id']);
    }
}