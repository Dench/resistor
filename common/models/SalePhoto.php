<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "sale_photo".
 *
 * @property integer $id
 * @property integer $sale_id
 * @property integer $sort
 *
 * @property Sale $sale
 */
class SalePhoto extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sale_photo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sale_id'], 'required'],
            [['sale_id', 'sort'], 'integer']
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSale()
    {
        return $this->hasOne(Sale::className(), ['id' => 'sale_id']);
    }
}
