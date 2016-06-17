<?php

namespace backend\models;

use common\models\SalePhoto;
use Yii;

/**
 * This is the model class for table "parse_image".
 *
 * @property integer $id
 * @property integer $parse_id
 * @property integer $photo_id
 * @property string $url
 *
 * @property Parse $parse
 * @property SalePhoto $photo
 */
class ParseImage extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'parse_image';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parse_id', 'url'], 'required'],
            [['parse_id', 'photo_id'], 'integer'],
            [['url'], 'string', 'max' => 255],
            [['parse_id'], 'exist', 'skipOnError' => true, 'targetClass' => Parse::className(), 'targetAttribute' => ['parse_id' => 'id']],
            [['photo_id'], 'exist', 'skipOnError' => true, 'targetClass' => SalePhoto::className(), 'targetAttribute' => ['photo_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'parse_id' => Yii::t('app', 'Parse ID'),
            'photo_id' => Yii::t('app', 'Photo ID'),
            'url' => Yii::t('app', 'Url'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParse()
    {
        return $this->hasOne(Parse::className(), ['id' => 'parse_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPhoto()
    {
        return $this->hasOne(SalePhoto::className(), ['id' => 'photo_id']);
    }
}
