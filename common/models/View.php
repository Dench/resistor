<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "view".
 *
 * @property integer $id
 * @property string $name
 *
 * @property SaleView[] $saleViews
 * @property Sale[] $sales
 */
class View extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'view';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 32]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => Yii::t('app', 'Name'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSaleViews()
    {
        return $this->hasMany(SaleView::className(), ['view_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSales()
    {
        return $this->hasMany(Sale::className(), ['id' => 'sale_id'])->viaTable('sale_view', ['view_id' => 'id']);
    }

    public function getContent($lang_id = null)
    {
        $lang_id = ($lang_id === null) ? Lang::getCurrent()->id : $lang_id;

        return $this->hasOne(ViewLang::className(), ['id' => 'id'])->where('lang_id = :lang_id', [':lang_id' => $lang_id]);
    }
}
