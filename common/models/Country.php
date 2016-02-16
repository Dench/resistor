<?php

namespace common\models;

use yii\db\ActiveRecord;

class Country extends ActiveRecord
{
	
	public static function tableName()
    {
        return '{{%country}}';
    }

    public function rules()
    {
        return [
            [['code', 'name'], 'required'],
            [['population'], 'integer'],
            [['code'], 'string', 'min' => 2, 'max' => 2],
        ];
    }
}