<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "offer".
 *
 * @property integer $id
 * @property string $code
 * @property string $text
 * @property string $name
 * @property string $phone1
 * @property string $phone2
 * @property string $email
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property OfferItem[] $items
 */
class Offer extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'offer';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['code'], 'default', 'value' => function(){
                return substr(md5(rand(1000,9999)), 0, 6);
            }],
            [['text', 'name', 'phone1', 'phone2'], 'string'],
            ['email', 'email'],
            [['code'], 'string', 'max' => 32],
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
            'text' => Yii::t('app', 'Text'),
            'name' => Yii::t('app', 'Full name'),
            'phone1' => Yii::t('app', 'Phone'),
            'phone2' => Yii::t('app', 'Phone'),
            'email' => Yii::t('app', 'Email'),
            'created_at' => Yii::t('app', 'Created'),
            'updated_at' => Yii::t('app', 'Updated'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItems()
    {
        return $this->hasMany(OfferItem::className(), ['group_id' => 'id']);
    }
    
    public function beforeDelete()
    {
        $items = OfferItem::findAll(['group_id' => $this->id]);
        
        foreach ($items as $item) {
            $item->delete();
        }
        
        return parent::beforeDelete();
    }
}
