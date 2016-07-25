<?php

namespace common\models;

use voskobovich\behaviors\ManyToManyBehavior;
use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "application".
 *
 * @property integer $id
 * @property integer $time
 * @property string $name
 * @property string $phone
 * @property string $email
 * @property string $mycity
 * @property string $rooms
 * @property string $distance
 * @property string $sqr
 * @property string $budget
 * @property string $region
 * @property string $text
 * @property string $status
 *
 * @property ApplicationType[] $applicationTypes
 */
class Application extends \yii\db\ActiveRecord
{
    const STATUS_NEW = 0;
    const STATUS_READ = 1;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'application';
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
                'updatedAtAttribute' => false,
            ],
            [
                'class' => ManyToManyBehavior::className(),
                'relations' => [
                    'type_ids' => 'types',
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'email'], 'required'],
            [['name', 'phone', 'email', 'mycity', 'rooms', 'distance', 'sqr', 'budget', 'region', 'text'], 'string', 'max' => 255],
            [['name', 'phone', 'email', 'mycity', 'rooms', 'distance', 'sqr', 'budget', 'region', 'text'], 'trim'],
            ['email', 'email'],
            ['status', 'default', 'value' => self::STATUS_NEW],
            ['status', 'in', 'range' => [self::STATUS_NEW, self::STATUS_READ]],
            [['type_ids'], 'each', 'rule' => ['integer']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'time' => Yii::t('app', 'Time'),
            'name' => Yii::t('app', 'Full name'),
            'phone' => Yii::t('app', 'Phone'),
            'email' => Yii::t('app', 'Email'),
            'mycity' => Yii::t('app', 'Your city'),
            'rooms' => Yii::t('app', 'Number of bedrooms'),
            'distance' => Yii::t('app', 'Distance from the sea'),
            'sqr' => Yii::t('app', 'Area'),
            'budget' => Yii::t('app', 'Budget'),
            'region' => Yii::t('app', 'Region'),
            'text' => Yii::t('app', 'Text'),
            'status' => Yii::t('app', 'Status'),
            'type_ids' => Yii::t('app', 'Property type')
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getApplicationTypes()
    {
        return $this->hasMany(ApplicationType::className(), ['application_id' => 'id']);
    }

    public function afterSave($insert, $changedAttributes)
    {
        if ($this->isNewRecord) {

            $text = $this->text;

            if (empty($this->name)) {
                $text .= $this->getAttributeLabel('name') . ': ' . $this->name.'\n\r';
            }
            if (empty($this->phone)) {
                $text .= $this->getAttributeLabel('phone') . ': ' . $this->phone.'\n\r';
            }
            if (empty($this->mycity)) {
                $text .= $this->getAttributeLabel('mycity') . ': ' . $this->mycity.'\n\r';
            }
            if (empty($this->rooms)) {
                $text .= $this->getAttributeLabel('rooms') . ': ' . $this->rooms.'\n\r';
            }
            if (empty($this->distance)) {
                $text .= $this->getAttributeLabel('distance') . ': ' . $this->distance.'\n\r';
            }
            if (empty($this->sqr)) {
                $text .= $this->getAttributeLabel('sqr') . ': ' . $this->sqr.'\n\r';
            }
            if (empty($this->budget)) {
                $text .= $this->getAttributeLabel('budget') . ': ' . $this->budget.'\n\r';
            }
            if (empty($this->region)) {
                $text .= $this->getAttributeLabel('region') . ': ' . $this->region.'\n\r';
            }

            Yii::$app->mailer->compose()
                ->setTo(Yii::$app->params['adminEmail'])
                ->setFrom([$this->email => $this->name])
                ->setSubject(Yii::t('app', 'Search real estate'))
                ->setTextBody($text)
                ->send();

            Yii::$app->mailer->compose()
                ->setTo($this->email)
                ->setFrom(Yii::$app->params['adminEmail'])
                ->setSubject(Yii::t('app', 'Search real estate'))
                ->setTextBody(Yii::t('app', 'Thank you, your application has been accepted and will be processed shortly.'))
                ->send();
        }
        parent::afterSave($insert, $changedAttributes);
    }

    public static function notifyApp()
    {
        return self::find()->where(['status' => self::STATUS_NEW])->count();
    }

    public static function getStatusList()
    {
        return [
            self::STATUS_NEW => Yii::t('app', 'New'),
            self::STATUS_READ => '',
        ];
    }

    public function getStatusName()
    {
        $a = self::getStatusList();
        return $a[$this->status];
    }

    public function getTypes()
    {
        return $this->hasMany(Type::className(), ['id' => 'type_id'])
            ->viaTable('application_type', ['application_id' => 'id']);

    }
}
