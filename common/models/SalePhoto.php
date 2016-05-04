<?php

namespace common\models;

use Imagine\Image\Box;
use Imagine\Image\Point;
use Yii;
use yii\db\ActiveRecord;
use yii\helpers\BaseFileHelper;
use yii\imagine\Image;

/**
 * This is the model class for table "sale_photo".
 *
 * @property integer $id
 * @property integer $sale_id
 * @property integer $sort
 *
 * @property Sale $sale
 */
class SalePhoto extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sale_photo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sale_id'], 'required'],
            [['sale_id', 'sort'], 'integer'],
            [['hash'], 'default', 'value' => ''],
            [['sort'], 'default', 'value' => 0],
            [['hash'], 'string']
        ];
    }

    public static function getPhotos($object_id)
    {
        $ids = (new \yii\db\Query())->from('sale')->where(['object_id' => $object_id])->column();

        $temp = self::find()->where(['in', 'sale_id', $ids])->asArray()->all();

        $items = [];

        foreach ($temp as $t) {
            $items[$t['hash']] = $t;
        }
        return $items;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSale()
    {
        return $this->hasOne(Sale::className(), ['id' => 'sale_id']);
    }

    public function afterDelete() {
        $file = Yii::$app->params['uploadSalePath'].DIRECTORY_SEPARATOR.$this->sale_id.DIRECTORY_SEPARATOR.$this->id.'.jpg';
        if (file_exists($file)) unlink($file);
        $file = Yii::getAlias('@frontend/web').Yii::$app->params['salePhotoBig']['path'].$this->id.'.jpg';
        if (file_exists($file)) unlink($file);
        $file = Yii::getAlias('@frontend/web').Yii::$app->params['salePhotoSmall']['path'].$this->id.'.jpg';
        if (file_exists($file)) unlink($file);
        $file = Yii::getAlias('@frontend/web').Yii::$app->params['salePhotoThumb']['path'].$this->id.'.jpg';
        if (file_exists($file)) unlink($file);
        return parent::afterDelete();
    }

    public static function delPhotos($sale_id)
    {
        $model = self::findAll(['sale_id' => $sale_id]);
        foreach ($model as $item) {
            $item->delete();
        }
        $path = Yii::$app->params['uploadSalePath'].DIRECTORY_SEPARATOR.$sale_id;
        BaseFileHelper::removeDirectory($path);
    }

    public static function resize($id, $param)
    {
        if (!$model = self::findOne($id)) return false;

        $original = Yii::$app->params['uploadSalePath'].DIRECTORY_SEPARATOR.$model->sale_id.DIRECTORY_SEPARATOR.$model->id.'.jpg';
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
