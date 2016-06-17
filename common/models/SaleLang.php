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
 * @property string $name
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
            [['id', 'lang_id', 'name'], 'required'],
            [['id', 'lang_id'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['description'], 'safe']
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
            'name' => Yii::t('app', 'Name'),
        ];
    }
}
