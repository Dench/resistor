<?php

namespace frontend\controllers;

use common\models\Sale;

class SaleController extends \yii\web\Controller
{
    public function actionIndex($id)
    {
        $model = Sale::findOne($id);

        return $this->render('index', [
            'model' => $model
        ]);
    }

}
