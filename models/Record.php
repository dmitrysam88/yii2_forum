<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Record".
 *
 * @property integer $id
 * @property string $text
 * @property integer $dialog
 * @property integer $autor
 *
 * @property User $autor0
 * @property Dialog $dialog0
 */
class Record extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Record';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['text'], 'string'],
            [['dialog', 'autor'], 'integer'],
            [['autor'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['autor' => 'id']],
            [['dialog'], 'exist', 'skipOnError' => true, 'targetClass' => Dialog::className(), 'targetAttribute' => ['dialog' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'text' => 'Text',
            'dialog' => 'Dialog',
            'autor' => 'Autor',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAutor0()
    {
        return $this->hasOne(User::className(), ['id' => 'autor']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDialog0()
    {
        return $this->hasOne(Dialog::className(), ['id' => 'dialog']);
    }
}
