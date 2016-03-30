<?php

namespace backend\controllers;

use backend\models\ObjectSearch;
use Yii;
use yii\web\Controller;

class ObjectController extends Controller
{
    public function actionIndex()
    {
        $searchModel = new ObjectSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

}
