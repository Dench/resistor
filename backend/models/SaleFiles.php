<?php

namespace backend\models;

use common\models\Sale;
use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "sale_files".
 *
 * @property integer $id
 * @property integer $sale_id
 * @property string $name
 *
 * @property Sale $sale
 */
class SaleFiles extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sale_files';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sale_id', 'name'], 'required'],
            [['sale_id'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['sale_id'], 'exist', 'skipOnError' => true, 'targetClass' => Sale::className(), 'targetAttribute' => ['sale_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'sale_id' => Yii::t('app', 'Sale ID'),
            'name' => Yii::t('app', 'Name'),
        ];
    }

    public function afterDelete() {
        $file = Yii::$app->params['uploadSalePath'].DIRECTORY_SEPARATOR.$this->sale_id.DIRECTORY_SEPARATOR.$this->name;
        if (file_exists($file)) unlink($file);
        return parent::afterDelete();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSale()
    {
        return $this->hasOne(Sale::className(), ['id' => 'sale_id']);
    }
}
