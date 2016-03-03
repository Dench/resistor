<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "source_message".
 *
 * @property integer $id
 * @property string $category
 * @property string $message
 *
 * @property Message[] $messages
 */
class SourceMessage extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'source_message';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['message'], 'string', 'max' => 32],
            [['category'], 'default', 'value' => 'app'],
            [['category'], 'string', 'max' => 16]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'category' => Yii::t('app', 'Category'),
            'message' => Yii::t('app', 'Message'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMessages()
    {
        return $this->hasMany(Message::className(), ['id' => 'id']);
    }

    public function getContent($language = null)
    {
        $language = ($language === null) ? Lang::getCurrent()->code : $language;

        return $this->hasOne(Message::className(), ['id' => 'id'])->where('language = :language', [':language' => $language]);
    }
}
