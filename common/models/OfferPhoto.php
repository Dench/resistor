<?php

namespace common\models;

use Imagine\Image\Box;
use Imagine\Image\Point;
use Yii;
use yii\db\ActiveRecord;
use yii\helpers\BaseFileHelper;
use yii\imagine\Image;

/**
 * This is the model class for table "offer_photo".
 *
 * @property integer $id
 * @property integer $item_id
 * @property integer $sort
 *
 * @property OfferItem $item
 */
class OfferPhoto extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'offer_photo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['item_id', 'sort'], 'integer'],
            [['hash'], 'default', 'value' => ''],
            [['sort'], 'default', 'value' => 0],
            [['hash'], 'string']
        ];
    }

    public static function getPhotos($item_id)
    {
        $temp = self::find()->where(['item_id' => $item_id])->asArray()->all();

        $items = [];

        foreach ($temp as $t) {
            $items[$t['hash']] = $t;
        }
        return $items;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItem()
    {
        return $this->hasOne(Offer::className(), ['id' => 'item_id']);
    }

    public function afterDelete() {
        $file = Yii::$app->params['uploadOfferPath'].DIRECTORY_SEPARATOR.$this->item_id.DIRECTORY_SEPARATOR.$this->id.'.jpg';
        if (file_exists($file)) unlink($file);
        $file = Yii::getAlias('@frontend/web').Yii::$app->params['offerPhotoSlider']['path'].$this->id.'.jpg';
        if (file_exists($file)) unlink($file);
        $file = Yii::getAlias('@frontend/web').Yii::$app->params['offerPhotoBig']['path'].$this->id.'.jpg';
        if (file_exists($file)) unlink($file);
        $file = Yii::getAlias('@frontend/web').Yii::$app->params['offerPhotoSmall']['path'].$this->id.'.jpg';
        if (file_exists($file)) unlink($file);
        $file = Yii::getAlias('@frontend/web').Yii::$app->params['offerPhotoThumb']['path'].$this->id.'.jpg';
        if (file_exists($file)) unlink($file);
        return parent::afterDelete();
    }

    public static function delPhotos($item_id)
    {
        $model = self::findAll(['item_id' => $item_id]);
        foreach ($model as $item) {
            $item->delete();
        }
        $path = Yii::$app->params['uploadOfferPath'].DIRECTORY_SEPARATOR.$item_id;
        BaseFileHelper::removeDirectory($path);
    }

    public static function resize($id, $param)
    {
        if (!$model = self::findOne($id)) return false;

        $original = Yii::$app->params['uploadOfferPath'].DIRECTORY_SEPARATOR.$model->item_id.DIRECTORY_SEPARATOR.$model->id.'.jpg';
        $thumb = Yii::getAlias('@webroot').$param['path'].$model->id.'.jpg';

        $img = Image::getImagine()->open($original);
        $size = $img->getSize();

        $k1 = $param['width']/$size->getWidth();
        $k2 = $param['height']/$size->getHeight();
        $k = $k1 > $k2 ? $k1 : $k2;
        $width = round($size->getWidth()*$k);
        $height = round($size->getHeight()*$k);
        $x = -round(($param['width']-$width)/2);
        $y = -round(($param['height']-$height)/2);

        if ($param['width'] < 300) $wm = '_thumb'; else $wm = '';
        $watermark = Image::getImagine()->open(Yii::$app->params['watermark'.$wm]['file']);
        $wSize = $watermark->getSize();
        $bottomRight = new Point($param['width']-$wSize->getWidth()-Yii::$app->params['watermark'.$wm]['x'], $param['height']-$wSize->getHeight()-Yii::$app->params['watermark'.$wm]['y']);

        if ($img->resize(new Box($width, $height))
            ->crop(new Point($x, $y), new Box($param['width'], $param['height']))
            ->paste($watermark, $bottomRight)
            ->save($thumb))
            return $thumb;
        else
            return false;
    }
}
