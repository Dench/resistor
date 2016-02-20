<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "sale".
 *
 * @property integer $id
 * @property integer $region_id
 * @property integer $district_id
 * @property string $name
 * @property integer $year
 * @property string $commission
 * @property integer $price
 * @property string $gps
 * @property integer $covered
 * @property integer $uncovered
 * @property integer $plot
 * @property integer $bathroom
 * @property integer $bedroom
 * @property integer $solarpanel
 * @property integer $sauna
 * @property integer $furniture
 * @property integer $conditioner
 * @property integer $heating
 * @property integer $storage
 * @property integer $tennis
 * @property integer $title
 * @property string $contacts
 * @property string $owner
 * @property string $address
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 */
class Sale extends \yii\db\ActiveRecord
{
    const STATUS_HIDE = 0;
    const STATUS_ACTIVE = 1;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sale';
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
            [['region_id', 'district_id'], 'required'],
            [['region_id', 'district_id', 'year', 'price', 'covered', 'uncovered', 'plot', 'bathroom', 'bedroom',
                'solarpanel', 'sauna', 'furniture', 'conditioner', 'heating', 'storage', 'tennis', 'status', 'title',
                'created_at', 'updated_at'], 'integer'],
            [['contacts', 'owner', 'address'], 'string'],
            [['year', 'price', 'covered', 'uncovered', 'plot', 'bathroom', 'bedroom'], 'trim'],
            [['name'], 'string', 'max' => 64],
            [['year'], 'string', 'max' => 4],
            [['bathroom', 'bedroom'], 'string', 'max' => 2],
            [['price','covered', 'uncovered', 'plot'], 'string', 'max' => 11],
            [['commission', 'gps'], 'string', 'max' => 32],
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_HIDE]],
        ];
    }

    public static function getStatusList()
    {
        return [
            self::STATUS_ACTIVE => 'Acvive',
            self::STATUS_HIDE => 'Hide',
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
            'district_id' => 'District ID',
            'name' => Yii::t('app', 'Name'),
            'year' => Yii::t('app', 'Year'),
            'commission' => Yii::t('app', 'Commission'),
            'price' => Yii::t('app', 'Price'),
            'gps' => Yii::t('app', 'Gps'),
            'covered' => Yii::t('app', 'Covered'),
            'uncovered' => Yii::t('app', 'Uncovered'),
            'plot' => Yii::t('app', 'Plot'),
            'bathroom' => Yii::t('app', 'Bathroom'),
            'bedroom' => Yii::t('app', 'Bedroom'),
            'solarpanel' => Yii::t('app', 'Solar Panel'),
            'sauna' => Yii::t('app', 'Sauna'),
            'furniture' => Yii::t('app', 'Furniture'),
            'conditioner' => Yii::t('app', 'Conditioner'),
            'heating' => Yii::t('app', 'Heating'),
            'storage' => Yii::t('app', 'Storage'),
            'tennis' => Yii::t('app', 'Tennis'),
            'title' => Yii::t('app', 'Title'),
            'contacts' => Yii::t('app', 'Contacts'),
            'owner' => Yii::t('app', 'Owner'),
            'address' => Yii::t('app', 'Address'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }
}
