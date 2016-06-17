<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "parse_lang".
 *
 * @property integer $id
 * @property integer $lang_id
 * @property string $hash
 * @property string $data
 */
class ParseLang extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'parse_lang';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'lang_id', 'hash'], 'required'],
            [['id', 'lang_id'], 'integer'],
            [['data'], 'string'],
            [['hash'], 'string', 'max' => 32],
            [['id', 'lang_id'], 'unique', 'targetAttribute' => ['id', 'lang_id'], 'message' => 'The combination of Parse ID and Lang ID has already been taken.'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Parse ID',
            'lang_id' => 'Lang ID',
            'hash' => 'Hash',
            'data' => 'Data',
        ];
    }
}
