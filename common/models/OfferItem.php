<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;

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

    /*public function afterDelete()
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
    }*/
}
