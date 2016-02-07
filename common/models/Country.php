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

	public static function updatePopulation($code, $population)
	{
		$temp = self::findOne($code);
        $temp->population = $population;
        if (!$temp->save()) return $temp->errors;
	}
}