<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "sale_lang".
 *
 * @property integer $id
 * @property integer $lang_id
 * @property string $description
 *
 */
class SaleLang extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sale_lang';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'lang_id'], 'required'],
            [['id', 'lang_id'], 'integer'],
            [['description'], 'string']
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
            'description' => Yii::t('app', 'Description'),
        ];
    }
}
