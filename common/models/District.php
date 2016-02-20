<?php

namespace common\models;

use Yii;
use \yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "district".
 *
 * @property integer $id
 * @property integer $region_id
 *
 * @property Region $region
 * @property DistrictLang[] $districtLangs
 * @property Lang[] $langs
 */
class District extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'district';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['region_id'], 'required'],
            [['region_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'region_id' => 'Region ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRegion()
    {
        return $this->hasOne(Region::className(), ['id' => 'region_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDistrictLangs()
    {
        return $this->hasMany(DistrictLang::className(), ['id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLangs()
    {
        return $this->hasMany(Lang::className(), ['id' => 'lang_id'])->viaTable('district_lang', ['id' => 'id']);
    }

    public function getContent($lang_id = null)
    {
        $lang_id = ($lang_id === null) ? Lang::getCurrent()->id : $lang_id;

        return $this->hasOne(DistrictLang::className(), ['id' => 'id'])->where('lang_id = :lang_id', [':lang_id' => $lang_id]);
    }

    public static function getList($id)
    {
        return ArrayHelper::map(self::find()->where(['region_id' => $id])->all(), 'id', 'content.name');
    }
}
