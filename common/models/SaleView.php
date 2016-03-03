<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "sale_view".
 *
 * @property integer $view_id
 * @property integer $sale_id
 *
 * @property View $view
 * @property Sale $sale
 */
class SaleView extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sale_view';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['view_id', 'sale_id'], 'required'],
            [['view_id', 'sale_id'], 'integer'],
            [['view_id', 'sale_id'], 'unique', 'targetAttribute' => ['view_id', 'sale_id'], 'message' => 'The combination of View ID and Sale ID has already been taken.']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'view_id' => 'View ID',
            'sale_id' => 'app', 'Sale ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getView()
    {
        return $this->hasOne(View::className(), ['id' => 'view_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSale()
    {
        return $this->hasOne(Sale::className(), ['id' => 'sale_id']);
    }
}
