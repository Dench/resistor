<?php

namespace common\models;

use Yii;
use \yii\db\ActiveRecord;

/**
 * This is the model class for table "region_lang".
 *
 * @property integer $id
 * @property integer $lang_id
 * @property string $name
 *
 */
class RegionLang extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'region_lang';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'lang_id', 'name'], 'required'],
            [['id', 'lang_id'], 'integer'],
            [['name'], 'string', 'max' => 64]
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
