<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\FileHelper;

/**
 * This is the model class for table "offer_item".
 *
 * @property integer $id
 * @property integer $group_id
 * @property string $name
 * @property string $text
 *
 * @property Offer $group
 * @property OfferPhoto $photos
 */
class OfferItem extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'offer_item';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'default', 'value' => '(no name)'],
            [['text'], 'string'],
            [['name'], 'string', 'max' => 255],
            [['group_id'], 'exist', 'skipOnError' => true, 'targetClass' => Offer::className(), 'targetAttribute' => ['group_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'group_id' => Yii::t('app', 'Group ID'),
            'name' => Yii::t('app', 'Name'),
            'text' => Yii::t('app', 'Text'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroup()
    {
        return $this->hasOne(Offer::className(), ['id' => 'group_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPhotos()
    {
        return $this->hasMany(OfferPhoto::className(), ['item_id' => 'id']);
    }

    public function afterDelete()
    {
        Yii::info('delPhotos'.$this->id);
        OfferPhoto::delPhotos($this->id);
        $path = Yii::$app->params['uploadOfferPath'].DIRECTORY_SEPARATOR.$this->id;
        FileHelper::removeDirectory($path);
        return parent::afterDelete();
    }
}
