<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "view_lang".
 *
 * @property integer $id
 * @property integer $lang_id
 * @property string $name
 *
 * @property View $id0
 * @property Lang $lang
 */
class ViewLang extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'view_lang';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'lang_id', 'name'], 'required'],
            [['id', 'lang_id'], 'integer'],
            [['name'], 'string', 'max' => 32],
            [['id', 'lang_id'], 'unique', 'targetAttribute' => ['id', 'lang_id'], 'message' => 'The combination of ID and Lang ID has already been taken.']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'lang_id' => Yii::t('app', 'Lang ID'),
            'name' => Yii::t('app', 'Name'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getId0()
    {
        return $this->hasOne(View::className(), ['id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLang()
    {
        return $this->hasOne(Lang::className(), ['id' => 'lang_id']);
    }
}
