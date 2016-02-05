<?php

namespace common\models;

use yii\db\ActiveRecord;

class Country extends ActiveRecord
{
	
	public function rules()
    {
        return [
            [['code', 'name'], 'required'],
            [['population'], 'integer', 'max' => 2],
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