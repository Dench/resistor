<?php

namespace frontend\controllers;

use common\models\Sale;
use Yii;
use yii\web\NotFoundHttpException;

class SaleController extends \yii\web\Controller
{
    public function actionIndex($id)
    {
        $model = Sale::findOne($id);

        if (!$model || $model->status != 1) {
            throw new NotFoundHttpException(Yii::t('yii', 'Page not found.'));
        }

        return $this->render('index', [
            'model' => $model
        ]);
    }

}
