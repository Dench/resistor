<?php

namespace common\models;

use Yii;
use \yii\db\ActiveRecord;

/**
 * This is the model class for table "lang".
 *
 * @property integer $id
 * @property string $code
 * @property string $name
 *
 * @property DistrictLang[] $districtLangs
 * @property District[] $ids
 * @property RegionLang[] $regionLangs
 * @property Region[] $ids0
 */
class Lang extends ActiveRecord
{
    // Переменная, для хранения текущего объекта языка
    public static $current = null;

    // Получение текущего объекта языка
    public static function getCurrent()
    {
        if (self::$current === null) {
            self::$current = self::getDefaultLang();
        }
        return self::$current;
    }

    // Установка текущего объекта языка и локаль пользователя
    public static function setCurrent($code = null)
    {
        $language = self::getLangByUrl($code);
        self::$current = ($language === null) ? self::getDefaultLang() : $language;
        Yii::$app->language = self::$current->code;
    }

    // Получения объекта языка по умолчанию
    public static function getDefaultLang()
    {
        return Lang::findOne(Yii::$app->params['langDef']);
    }

    // Получения объекта языка по буквенному идентификатору
    public static function getLangByUrl($code = null)
    {
        if ($code === null) {
            return null;
        } else {
            $language = Lang::find()->where('code = :code', [':code' => $code])->one();
            if ( $language === null ) {
                return null;
            }else{
                return $language;
            }
        }
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'lang';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['code', 'name'], 'required'],
            [['code'], 'string', 'max' => 2],
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
            'code' => Yii::t('app', 'Code'),
            'name' => Yii::t('app', 'Name'),
        ];
    }
}
