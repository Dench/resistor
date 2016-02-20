<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "facilities".
 *
 * @property integer $id
 *
 * @property FacilitiesLang[] $facilitiesLangs
 * @property Lang[] $langs
 */
class Facilities extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'facilities';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFacilitiesLangs()
    {
        return $this->hasMany(FacilitiesLang::className(), ['id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLangs()
    {
        return $this->hasMany(Lang::className(), ['id' => 'lang_id'])->viaTable('facilities_lang', ['id' => 'id']);
    }

    public function getContent($lang_id = null)
    {
        $lang_id = ($lang_id === null) ? Lang::getCurrent()->id : $lang_id;

        return $this->hasOne(FacilitiesLang::className(), ['id' => 'id'])->where('lang_id = :lang_id', [':lang_id' => $lang_id]);
    }
}
