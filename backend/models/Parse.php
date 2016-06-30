<?php

namespace backend\models;

use common\models\Lang;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\helpers\Json;

/**
 * This is the model class for table "parse".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $remote_id
 * @property integer $sale_id
 * @property integer $time
 */
class Parse extends \yii\db\ActiveRecord
{
    const SCENARIO_ARISTO = 3;
    const SCENARIO_PAFILIA = 4;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'parse';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'time',
                'updatedAtAttribute' => 'time',
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'remote_id'], 'required'],
            [['user_id', 'sale_id'], 'integer'],
            [['remote_id'], 'string', 'max' => 32],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'remote_id' => 'Remote ID',
            'sale_id' => 'Sale ID',
            'time' => 'Time',
        ];
    }

    /**
     * Load XML file and saves the modified data in the database.
     * Returns the IDs of rows affected.
     *
     * @param $file
     * @param $scenario
     * @param bool $force
     * @return array $ids
     */
    public static function saveXml($file, $user_id, $lang_id = null, $force = null)
    {
        $lang_id = ($lang_id === null) ? Lang::getCurrent()->id : $lang_id;

        $properties = simplexml_load_file($file);

        $property_ids = [];
        if ($user_id == Parse::SCENARIO_ARISTO) {
            foreach ($properties as $property) {
                $property_ids[] = (string)$property->propertyID;
            }
        }
        if ($user_id == Parse::SCENARIO_PAFILIA) {
            $properties = $properties->properties->property;
            foreach ($properties as $property) {
                $property_ids[] = str_replace('property-', '', (string)$property->attributes()->id);
            }
        }
        $parses = Parse::find()->where(['user_id' => $user_id, 'remote_id' => $property_ids])->indexBy('remote_id')->all();

        $parse_ids = [];
        foreach ($parses as $p) {
            $parse_ids[] = $p->id;
        }
        $contents = ParseLang::find()->where(['id' => $parse_ids, 'lang_id' => $lang_id])->indexBy('id')->all();

        $ids = [];
        foreach ($properties as $property) {
            $property_id = 0;
            if ($user_id == Parse::SCENARIO_ARISTO) {
                $property_id = (string)$property->propertyID;
            }
            if ($user_id == Parse::SCENARIO_PAFILIA) {
                $property_id = str_replace('property-', '', (string)$property->attributes()->id);
            }
            $content = false;

            if (!isset($parses[$property_id])) {
                $parse = new Parse();
                $parse->user_id = $user_id;
                $parse->remote_id = $property_id;
            } else {
                $parse = $parses[$property_id];
                if (isset($contents[$parse->id])) {
                    $content = $contents[$parse->id];
                }
            }

            if (empty($content)) {
                $content = new ParseLang();
                $content->lang_id = $lang_id;
            }

            $content->data = Json::encode($property);

            $hash = md5($content->data);

            if ($hash != $content->hash || $force) {
                if ($parse->save()) {
                    $content->hash = $hash;
                    $content->id = $parse->id;
                    if ($content->save()) {
                        $ids[] = $parse->id;
                    }
                }
            } elseif (!$parse->sale_id) {
                $ids[] = $parse->id;
            }
        }

        return $ids;
    }

    /**
     * @param null $lang_id
     * @return ParseLang|ActiveRecord
     */
    public function getContent($lang_id = null)
    {
        $lang_id = ($lang_id === null) ? Lang::getCurrent()->id : $lang_id;

        return $this->hasOne(ParseLang::className(), ['id' => 'id'])->where('lang_id = :lang_id', [':lang_id' => $lang_id]);
    }
}
