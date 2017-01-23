<?php

namespace frontend\controllers;

use common\models\Offer;

class OfferController extends \yii\web\Controller
{
    public function actionIndex($code)
    {
        $model = Offer::findOne(['code' => $code]);

        return $this->render('index', [
            'model' => $model,
            'code' => $code
        ]);
    }

}
