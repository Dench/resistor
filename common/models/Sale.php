<?php

namespace common\models;

use backend\models\SaleFiles;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\helpers\BaseFileHelper;
use yii\helpers\Url;

/**
 * This is the model class for table "sale".
 *
 * @property integer $id
 * @property integer $code
 * @property integer $object_id
 * @property integer $user_id
 * @property integer $region_id
 * @property integer $district_id
 * @property integer $type_id
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
 * @property integer $parking_id
 * @property string $contacts
 * @property string $owner
 * @property string $address
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $top
 * @property boolean $vat
 * @property boolean $gps_hide
 * 
 * @property array view_ids
 * @property array facility_ids
 * @property array stage_ids
 * 
 * @property SaleLang content
 */
class Sale extends ActiveRecord
{
    const STATUS_HIDE = 0;
    const STATUS_ACTIVE = 1;
    const STATUS_AWAITING = 2;

    const TOP_DISABLED = 0;
    const TOP_ENABLED = 1;
    
    const VAT_TRUE = 1;
    const VAT_FALSE = 0;

    const SOLD_ACTUAL = 1;
    const SOLD_US = 2;
    const SOLD_OTHER = 3;

    private static $_type_list;
    private static $_stage_list;

    private static $_min;
    private static $_max;

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
                    'stage_ids' => 'stages',
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
            ['price', 'filter', 'filter' => function ($value) {
                return preg_replace('/,/', '', $value);
            }],
            [['type_id', 'region_id', 'district_id'], 'required'],
            /*[['price','covered', 'uncovered', 'plot'], 'string', 'max' => 11],
            [['year'], 'string', 'max' => 4],
            [['bathroom', 'bedroom'], 'string', 'max' => 2],*/
            [['id', 'object_id', 'region_id', 'district_id', 'year', 'covered', 'uncovered', 'plot', 'bathroom', 'bedroom',
                'solarpanel', 'sauna', 'furniture', 'conditioner', 'heating', 'storage', 'tennis', 'status', 'title',
                'type_id', 'pool', 'parking_id', 'created_at', 'updated_at'], 'integer'],
            [['price', 'contacts', 'owner', 'address', 'note_user', 'note_admin'], 'string'],
            [['address'], 'string', 'max' => 255],
            [['commission', 'gps'], 'string', 'max' => 40],
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_HIDE, self::STATUS_AWAITING]],
            ['top', 'default', 'value' => self::TOP_DISABLED],
            ['top', 'in', 'range' => [self::TOP_ENABLED, self::TOP_DISABLED]],
            ['sold', 'default', 'value' => self::SOLD_ACTUAL],
            ['sold', 'in', 'range' => [self::SOLD_ACTUAL, self::SOLD_US, self::SOLD_OTHER]],
            [['view_ids', 'facility_ids', 'stage_ids'], 'each', 'rule' => ['integer']],
            [['code', 'commission', 'contacts', 'owner', 'note_user', 'note_admin', 'address'], 'default', 'value' => ''],
            [['vat', 'gps_hide'], 'boolean']
        ];
    }

    public function getName()
    {
        return $this->content->name;
    }

    public function getParking()
    {
        $temp = self::getParkingList();
        return @$temp[$this->parking_id];
    }

    public static function getParkingList()
    {
        return [
            1 => Yii::t('app', 'Private'),
            2 => Yii::t('app', 'Communal'),
            3 => Yii::t('app', 'Garage'),
        ];
    }

    public static function getYesList()
    {
        return [
            1 => Yii::t('app', 'Yes'),
            0 => Yii::t('app', 'No')
        ];
    }

    public static function getYesOrNo($q)
    {
        if (empty($q)) return false;
        $a = self::getYesList();
        return @$a[$q];
    }

    public static function getTypeList()
    {
        if (!self::$_type_list) {
            self::$_type_list = [
                1 => Yii::t('app', 'Villa'),
                2 => Yii::t('app', 'Apartments'),
                3 => Yii::t('app', 'Townhouse'),
                4 => Yii::t('app', 'Building plot'),
            ];
        }
        return self::$_type_list;
    }

    public function getTypeName()
    {
        $a = self::getTypeList();
        return $a[$this->type_id];
    }

    public static function getTopList()
    {
        return [
            self::TOP_DISABLED => '-',
            self::TOP_ENABLED => Yii::t('app', 'Top'),
        ];
    }

    public function getTopName()
    {
        $a = self::getTopList();
        return $a[$this->top];
    }

    public static function getStatusList()
    {
        return [
            self::STATUS_ACTIVE => Yii::t('app', 'Acvive'),
            self::STATUS_HIDE => Yii::t('app', 'Hide'),
            self::STATUS_AWAITING => Yii::t('app', 'Awaiting'),
        ];
    }

    public static function getVatList()
    {
        return [
            self::VAT_TRUE => Yii::t('app', 'Plus VAT'),
            self::VAT_FALSE => Yii::t('app', 'VAT exempt'),
        ];
    }

    public function getStatusName()
    {
        $a = self::getStatusList();
        return $a[$this->status];
    }

    public static function getSoldList()
    {
        return [
            self::SOLD_ACTUAL => Yii::t('app', 'Actual'),
            self::SOLD_US => Yii::t('app', 'Sold us'),
            self::SOLD_OTHER => Yii::t('app', 'Sold other'),
        ];
    }

    public function getSoldName()
    {
        $a = self::getSoldList();
        return $a[$this->sold];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'object_id' => Yii::t('app', 'Object'),
            'code' => Yii::t('app', 'Code'),
            'user_id' => Yii::t('app', 'User'),
            'region_id' => Yii::t('app', 'Region'),
            'district_id' => Yii::t('app', 'District'),
            'type_id' => Yii::t('app', 'Property type'),
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
            'parking_id' => Yii::t('app', 'Parking'),
            'contacts' => Yii::t('app', 'Direct contact'),
            'owner' => Yii::t('app', 'Owner contacts (admin)'),
            'note_user' => Yii::t('app', 'Visible only for agents'),
            'note_admin' => Yii::t('app', 'Visible only for admins'),
            'address' => Yii::t('app', 'Address'),
            'status' => Yii::t('app', 'Status'),
            'sold' => Yii::t('app', 'Sale status'),
            'created_at' => Yii::t('app', 'Created'),
            'updated_at' => Yii::t('app', 'Updated'),
            'view_ids' => Yii::t('app', 'View from the window'),
            'facility_ids' => Yii::t('app', 'Facilities'),
            'stage_ids' => Yii::t('app', 'Facilities'),
            'top' => Yii::t('app', 'Top'),
            'vat' => Yii::t('app', 'VAT'),
            'name' => Yii::t('app', 'Name'),
            'gps_hide' => Yii::t('app', 'Hide'),
        ];
    }

    public static function weekItems($limit = 4)
    {
        return self::find()->where(['top' => self::TOP_ENABLED, 'status' => 1])->orderBy(['id' => SORT_DESC])->limit($limit)->all();
    }

    public static function lastItems($limit = 8)
    {
        return self::find()->where(['status' => 1])->orderBy(['id' => SORT_DESC])->limit($limit)->all();
    }

    public static function gpsMarkers($district_id)
    {
        $temp = Object::find()->joinWith(['sale']);
        if ($district_id > 0) {
            $temp = $temp->where(['district_id' => $district_id]);
        }
        $temp = $temp->asArray()->all();
        $items = [];
        foreach ($temp as $t) {
            $t = $t['sale'];
            $items[] = [
                'link' => Url::toRoute(['sale/update', 'id' => $t['id']]),
                'status' => $t['status'],
                'pos' => $t['gps'],
                'title' => 'ID '.$t['object_id'].' ('.$t['address'].') '.$t['name'].' - '.date('d.m.Y', $t['created_at'])
            ];
        }
        return $items;
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
        $image['slider'] = false;
        if (!empty($this->photos[0])) {
            $image['thumb'] = Yii::$app->params['salePhotoThumb']['path'] . $this->photos[0]['id'] . '.jpg';
            $image['small'] = Yii::$app->params['salePhotoSmall']['path'] . $this->photos[0]['id'] . '.jpg';
            $image['big'] = Yii::$app->params['salePhotoBig']['path'] . $this->photos[0]['id'] . '.jpg';
            $image['slider'] = Yii::$app->params['salePhotoSlider']['path'] . $this->photos[0]['id'] . '.jpg';
        }
        return $image;
    }

    public function getImages()
    {
        $images['thumb'] = [];
        $images['small'] = [];
        $images['big'] = [];
        $images['slider'] = [];
        foreach ($this->photos as $i) {
            $images['thumb'][$i['id']] = Yii::$app->params['salePhotoThumb']['path'].$i['id'].'.jpg';
            $images['small'][$i['id']] = Yii::$app->params['salePhotoSmall']['path'].$i['id'].'.jpg';
            $images['big'][$i['id']] = Yii::$app->params['salePhotoBig']['path'].$i['id'].'.jpg';
            $images['slider'][$i['id']] = Yii::$app->params['salePhotoSlider']['path'].$i['id'].'.jpg';
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

    public function getFiles()
    {
        return $this->hasMany(SaleFiles::className(), ['sale_id' => 'id']);
    }

    public function getRegion()
    {
        return $this->hasOne(Region::className(), ['id' => 'region_id']);
    }

    public function getObject()
    {
        return $this->hasOne(Object::className(), ['id' => 'object_id']);
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

    public function getStages()
    {
        return $this->hasMany(Stage::className(), ['id' => 'stage_id'])
            ->viaTable('sale_stage', ['sale_id' => 'id']);

    }

    public function afterDelete()
    {
        SalePhoto::delPhotos($this->id);
        $path = Yii::$app->params['uploadSalePath'].DIRECTORY_SEPARATOR.$this->id;
        BaseFileHelper::removeDirectory($path);
        if (!self::findOne(['object_id' => $this->object_id])) {
            Object::findOne($this->object_id)->delete();
        }
        return parent::afterDelete();
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if (!$this->id) {
                if (!$this->user_id) {
                    $this->user_id = Yii::$app->user->identity->id;
                }
                if ($this->object_id<1) {
                    $object = new Object();
                    $object->save();
                    $this->object_id = $object->id;
                }
            }
            return true;
        }
        return false;
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);

        // Photo copy - Start
        if ($insert && Yii::$app->request->post('photos')) {
            $new_path = Yii::$app->params['uploadSalePath'] . DIRECTORY_SEPARATOR . $this->id;
            BaseFileHelper::createDirectory($new_path);
            foreach (Yii::$app->request->post('photos') as $k => $v) {
                $old_photo = SalePhoto::findOne($k);
                if ($old_photo) {
                    $old = Yii::$app->params['uploadSalePath'] . DIRECTORY_SEPARATOR . $v . DIRECTORY_SEPARATOR . $old_photo->id . '.jpg';
                    if (file_exists($old)) {
                        $new_photo = new SalePhoto();
                        $new_photo->sale_id = $this->id;
                        if ($new_photo->save()) {
                            $new_photo->sort = $new_photo->id;
                            $new_photo->hash = md5_file($old);
                            if ($new_photo->save()) {
                                if (!copy($old, $new_path . DIRECTORY_SEPARATOR . $new_photo->id . '.jpg')) {
                                    $new_photo->delete();
                                }
                            }
                        }
                    }

                }
            }
        }
        // Photo copy - End

        $code = sprintf("%02d", $this->region_id) . sprintf("%03d", $this->district_id) . $this->id;
        Yii::$app->db->createCommand()->update('sale', ['code' => $code], ['id' => $this->id])->execute();
    }

    public static function priceMin()
    {
        if (!self::$_min) {
            self::$_min = self::find()->min('price');
        }
        return self::$_min;
    }

    public static function priceMax()
    {
        if (!self::$_max) {
            self::$_max = self::find()->max('price');
        }
        return self::$_max;
    }

}
