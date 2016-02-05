<?php

namespace frontend\controllers;

use yii\web\Controller;
use yii\data\Pagination;
use common\models\Country;

class CountryController extends Controller
{
    public function actionIndex()
    {
        $query = Country::find();

        $pagination = new Pagination([
            'defaultPageSize' => 5,
            'totalCount' => $query->count(),
        ]);

        $countries = $query->orderBy('name')
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return $this->render('index', [
            'countries' => $countries,
            'pagination' => $pagination,
        ]);
    }

    public function actionUpdate()
    {
        $errors = Country::updatePopulation('UA', rand(100000,999999));

        return $this->render('update', ['errors' => $errors]);
    }
}