<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "sale".
 *
 * @property integer $id
 * @property integer $region_id
 * @property integer $district_id
 * @property integer $type
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
 * @property integer $parking
 * @property string $contacts
 * @property string $owner
 * @property string $address
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 */
class Sale extends ActiveRecord
{
    const STATUS_HIDE = 0;
    const STATUS_ACTIVE = 1;

    public $parking_list = [
        0 => '',
        1 => 'Private parking',
        2 => 'Communal parking',
        3 => 'Garage',
    ];

    public $type_list = [
        0 => '',
        1 => 'Townhouse',
        2 => 'Villa',
        3 => 'Apartments',
    ];

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
            [
                'class' => \voskobovich\behaviors\ManyToManyBehavior::className(),
                'relations' => [
                    'view_ids' => 'views',
                    'facility_ids' => 'facilities',
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
            [['region_id', 'district_id'], 'required'],
            [['price','covered', 'uncovered', 'plot'], 'string', 'max' => 11],
            [['year'], 'string', 'max' => 4],
            [['bathroom', 'bedroom'], 'string', 'max' => 2],
            [['region_id', 'district_id', 'year', 'price', 'covered', 'uncovered', 'plot', 'bathroom', 'bedroom',
                'solarpanel', 'sauna', 'furniture', 'conditioner', 'heating', 'storage', 'tennis', 'status', 'title',
                'type', 'pool', 'parking', 'created_at', 'updated_at'], 'integer'],
            [['contacts', 'owner', 'address', 'note_user', 'note_admin'], 'string'],
            [['name'], 'string', 'max' => 64],
            [['address'], 'string', 'max' => 255],
            [['commission', 'gps'], 'string', 'max' => 40],
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_HIDE]],
            [['view_ids', 'facility_ids'], 'each', 'rule' => ['integer']],
        ];
    }

    public static function getStatusList()
    {
        return [
            self::STATUS_ACTIVE => Yii::t('app', 'Acvive'),
            self::STATUS_HIDE => Yii::t('app', 'Hide'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => Yii::t('app', 'User'),
            'region_id' => Yii::t('app', 'Region'),
            'district_id' => Yii::t('app', 'District'),
            'type' => Yii::t('app', 'Property type'),
            'name' => Yii::t('app', 'Name'),
            'year' => Yii::t('app', 'Year built'),
            'commission' => Yii::t('app', 'Commission'),
            'price' => Yii::t('app', 'Price'),
            'gps' => Yii::t('app', 'Coordinates'),
            'covered' => Yii::t('app', 'Covered area'),
            'uncovered' => Yii::t('app', 'Uncovered area'),
            'plot' => Yii::t('app', 'Plot area'),
            'bathroom' => Yii::t('app', 'Bathrooms'),
            'bedroom' => Yii::t('app', 'Bedrooms'),
            'solarpanel' => Yii::t('app', 'Solar Panel'),
            'sauna' => Yii::t('app', 'Sauna'),
            'furniture' => Yii::t('app', 'Furniture'),
            'conditioner' => Yii::t('app', 'Conditioner'),
            'heating' => Yii::t('app', 'Central heating'),
            'storage' => Yii::t('app', 'Storage'),
            'tennis' => Yii::t('app', 'Tennis court'),
            'pool' => Yii::t('app', 'Pool'),
            'title' => Yii::t('app', 'Title deeds'),
            'parking' => Yii::t('app', 'Parking'),
            'contacts' => Yii::t('app', 'Contacts'),
            'owner' => Yii::t('app', 'Owner contacts'),
            'note_user' => Yii::t('app', 'Note for facilitator'),
            'note_admin' => Yii::t('app', 'Note for admin'),
            'address' => Yii::t('app', 'Address'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created'),
            'updated_at' => Yii::t('app', 'Updated'),
            'view_ids' => Yii::t('app', 'View from the window'),
            'facility_ids' => Yii::t('app', 'Facilities'),
        ];
    }

    public function getContent($lang_id = null)
    {
        $lang_id = ($lang_id === null) ? Lang::getCurrent()->id : $lang_id;

        return $this->hasOne(SaleLang::className(), ['id' => 'id'])->where('lang_id = :lang_id', [':lang_id' => $lang_id]);
    }

    public function getCover()
    {
        $image['thumb'] = false;
        $image['small'] = false;
        $image['big'] = false;
        if (!empty($this->photos[0])) {
            $image['thumb'] = Yii::$app->params['salePhotoThumb']['path'] . $this->photos[0]['id'] . '.jpg';
            $image['small'] = Yii::$app->params['salePhotoSmall']['path'] . $this->photos[0]['id'] . '.jpg';
            $image['big'] = Yii::$app->params['salePhotoBig']['path'] . $this->photos[0]['id'] . '.jpg';
        }
        return $image;
    }

    public function getImages()
    {
        $images['thumb'] = [];
        $images['small'] = [];
        $images['big'] = [];
        foreach ($this->photos as $i) {
            $images['thumb'][$i['id']] = Yii::$app->params['salePhotoThumb']['path'].$i['id'].'.jpg';
            $images['small'][$i['id']] = Yii::$app->params['salePhotoSmall']['path'].$i['id'].'.jpg';
            $images['big'][$i['id']] = Yii::$app->params['salePhotoBig']['path'].$i['id'].'.jpg';
        }
        return $images;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPhotos()
    {
        return $this->hasMany(SalePhoto::className(), ['sale_id' => 'id']);
    }

    public function getRegion()
    {
        return $this->hasOne(Region::className(), ['id' => 'region_id']);
    }

    public function getDistrict()
    {
        return $this->hasOne(District::className(), ['id' => 'district_id']);
    }

    public function getViews()
    {
        return $this->hasMany(View::className(), ['id' => 'view_id'])
            ->viaTable('sale_view', ['sale_id' => 'id']);

    }

    public function getFacilities()
    {
        return $this->hasMany(Facilities::className(), ['id' => 'facility_id'])
            ->viaTable('sale_facilities', ['sale_id' => 'id']);

    }

    public function afterDelete()
    {
        SalePhoto::delPhotos($this->id);
        return parent::afterDelete();
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if (!$this->id) {
                $this->user_id = Yii::$app->user->identity->id;
            }
            return true;
        }
        return false;
    }

}
