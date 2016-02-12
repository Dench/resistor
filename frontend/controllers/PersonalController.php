<?php

namespace frontend\controllers;

use Yii;

class PersonalController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $model = Yii::$app->user->identity;

        return $this->render('index', [
        	'model' => $model,
        ]);
    }

}
