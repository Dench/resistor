<?php

namespace common\models;

use Imagine\Image\Box;
use Imagine\Image\Point;
use Yii;
use yii\db\ActiveRecord;
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
            [['sale_id', 'sort'], 'integer']
        ];
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
        $model = self::find()->where(['sale_id' => $sale_id])->all();
        foreach ($model as $item) {
            $item->delete();
        }
    }

    public static function clearCache($sale_id)
    {
        $model = self::find()->where(['sale_id' => $sale_id])->all();
        foreach ($model as $item) {
            Yii::info('PhotoID '.print_r($item, true));
            $file = Yii::getAlias('@frontend/web').Yii::$app->params['salePhotoBig']['path'].$item->id.'.jpg';
            if (file_exists($file)) unlink($file);
            $file = Yii::getAlias('@frontend/web').Yii::$app->params['salePhotoSmall']['path'].$item->id.'.jpg';
            if (file_exists($file)) unlink($file);
            $file = Yii::getAlias('@frontend/web').Yii::$app->params['salePhotoThumb']['path'].$item->id.'.jpg';
            if (file_exists($file)) unlink($file);
        }
    }

    public static function resize($id, $param)
    {
        if (!$model = self::findOne($id)) return false;

        $original = Yii::$app->params['uploadSalePath'].DIRECTORY_SEPARATOR.$model->sale_id.DIRECTORY_SEPARATOR.$id.'.jpg';
        $thumb = Yii::getAlias('@webroot').$param['path'].$id.'.jpg';

        $img = Image::getImagine()->open($original);
        $size = $img->getSize();
        $ratio = $size->getWidth() / $size->getHeight();

        $width = $param['width'];
        $height = $param['height'];
        $x = 0;
        $y = 0;

        if ($width < 300) $wm = '_thumb'; else $wm = '';

        $watermark = Image::getImagine()->open(Yii::$app->params['watermark'.$wm]['file']);
        $wSize = $watermark->getSize();
        $bottomRight = new Point($width-$wSize->getWidth()-Yii::$app->params['watermark'.$wm]['x'], $height-$wSize->getHeight()-Yii::$app->params['watermark'.$wm]['y']);

        if ($ratio > 1) {
            $width = round($height * $ratio);
            $x = round(($width - $param['width']) / 2);
        }
        if ($ratio < 1) {
            $height = round($width / $ratio);
            $y = round(($height - $param['height']) / 2);
        }
        if ($ratio == 1) {
            if ($width > $height) {
                $height = $width;
                $y = round(($height - $param['height']) / 2);
            }
            if ($width < $height) {
                $width = $height;
                $x = round(($width - $param['width']) / 2);
            }
        }
        if ($img->resize(new Box($width, $height))
            ->crop(new Point($x, $y), new Box($param['width'], $param['height']))
            ->paste($watermark, $bottomRight)
            ->save($thumb))
            return $thumb;
        else
            return false;
    }
}
