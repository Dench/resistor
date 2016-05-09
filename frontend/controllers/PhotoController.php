<?php

namespace frontend\controllers;

use common\models\SalePhoto;
use Imagine\Image\Point;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class PhotoController extends Controller
{
    public function actionSlider($id)
    {
        if ($file = SalePhoto::resize($id, Yii::$app->params['salePhotoSlider'])) {
            header('Content-Type: image/jpeg');
            print file_get_contents($file);
        } else {
            throw new NotFoundHttpException('Photo not found!');
        }
        die();
    }

    public function actionBig($id)
    {
        if ($file = SalePhoto::resize($id, Yii::$app->params['salePhotoBig'])) {
            header('Content-Type: image/jpeg');
            print file_get_contents($file);
        } else {
            throw new NotFoundHttpException('Photo not found!');
        }
        die();
    }

    public function actionSmall($id)
    {
        if ($file = SalePhoto::resize($id, Yii::$app->params['salePhotoSmall'])) {
            header('Content-Type: image/jpeg');
            print file_get_contents($file);
        } else {
            throw new NotFoundHttpException('Photo not found!');
        }
        die();
    }

    public function actionThumb($id)
    {
        if ($file = SalePhoto::resize($id, Yii::$app->params['salePhotoThumb'])) {
            header('Content-Type: image/jpeg');
            print file_get_contents($file);
        } else {
            throw new NotFoundHttpException('Photo not found!');
        }
        die();
    }
}
