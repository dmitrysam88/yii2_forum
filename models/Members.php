<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Members".
 *
 * @property integer $id
 * @property integer $dialog
 * @property integer $user
 *
 * @property Dialog $dialog0
 * @property User $user0
 */
class Members extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Members';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['dialog', 'user'], 'integer'],
            [['dialog'], 'exist', 'skipOnError' => true, 'targetClass' => Dialog::className(), 'targetAttribute' => ['dialog' => 'id']],
            [['user'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'dialog' => 'Dialog',
            'user' => 'User',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDialog0()
    {
        return $this->hasOne(Dialog::className(), ['id' => 'dialog']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser0()
    {
        return $this->hasOne(User::className(), ['id' => 'user']);
    }
}
