<?php

namespace frontend\controllers;

use common\models\OfferPhoto;
use Imagine\Image\Point;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class PhotoOfferController extends Controller
{
    public function actionSlider($id)
    {
        if ($file = OfferPhoto::resize($id, Yii::$app->params['offerPhotoSlider'])) {
            header('Content-Type: image/jpeg');
            print file_get_contents($file);
        } else {
            throw new NotFoundHttpException('Photo not found!');
        }
        die();
    }

    public function actionBig($id)
    {
        if ($file = OfferPhoto::resize($id, Yii::$app->params['offerPhotoBig'])) {
            header('Content-Type: image/jpeg');
            print file_get_contents($file);
        } else {
            throw new NotFoundHttpException('Photo not found!');
        }
        die();
    }

    public function actionSmall($id)
    {
        if ($file = OfferPhoto::resize($id, Yii::$app->params['offerPhotoSmall'])) {
            header('Content-Type: image/jpeg');
            print file_get_contents($file);
        } else {
            throw new NotFoundHttpException('Photo not found!');
        }
        die();
    }

    public function actionThumb($id)
    {
        if ($file = OfferPhoto::resize($id, Yii::$app->params['offerPhotoThumb'])) {
            header('Content-Type: image/jpeg');
            print file_get_contents($file);
        } else {
            throw new NotFoundHttpException('Photo not found!');
        }
        die();
    }
}
