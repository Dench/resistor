<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "facilities_lang".
 *
 * @property integer $id
 * @property integer $lang_id
 * @property string $name
 */
class FacilitiesLang extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'facilities_lang';
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
            'id' => 'ID',
            'lang_id' => Yii::t('app', 'Lang'),
            'name' => Yii::t('app', 'Name'),
        ];
    }
}
