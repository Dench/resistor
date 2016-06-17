<?php

namespace common\models;

use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "stage".
 *
 * @property integer $id
 */
class Stage extends ActiveRecord
{
    private static $_list;
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'stage';
    }

    /**
     * @param null $lang_id
     * @return StageLang|ActiveRecord
     */
    public function getContent($lang_id = null)
    {
        $lang_id = ($lang_id === null) ? Lang::getCurrent()->id : $lang_id;

        return $this->hasOne(StageLang::className(), ['id' => 'id'])->where('lang_id = :lang_id', [':lang_id' => $lang_id]);
    }

    /**
     * @return array
     */
    public static function getList()
    {
        if (!self::$_list) {
            self::$_list = ArrayHelper::map(self::find()->all(), 'id', 'content.name');
        }

        return self::$_list;
    }
}
