<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "object".
 *
 * @property integer $id
 */
class Object extends ActiveRecord
{

    public $name;
    public $address;
    public $status;
    public $region_id;
    public $district_id;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'object';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
        ];
    }

    /**
     * @return array
     */
    public static function getList($id)
    {
        return ArrayHelper::map(
            Sale::find()->where(['district_id' => $id])->all(),
            'object_id',
            function ($e) {
                return 'ID '.$e['object_id'].' ('.$e['address'].')';
            }
        );
    }

    public function getSales()
    {
        return $this->hasMany(Sale::className(), ['object_id' => 'id']);
    }

    public function getSale()
    {
        return $this->hasOne(Sale::className(), ['object_id' => 'id'])->orderBy(['sale.id' => SORT_DESC]);
    }
}
