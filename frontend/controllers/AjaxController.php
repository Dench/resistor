<?php

namespace frontend\controllers;

use common\models\District;
use yii\helpers\Json;

class AjaxController extends \yii\web\Controller
{
    public function actionIndex()
    {
    }

    public function actionDistrictList()
    {
        if (isset($_POST['depdrop_parents'])) {
            if ($parents = $_POST['depdrop_parents']) {
                $out = District::getList($parents[0]);
                foreach ($out as $key => $value) {
                    $result[] = ['id' => $key, 'name' => $value];
                }
                print Json::encode(['output' => @$result, 'selected' => '']);
                return;
            }
        }
    }
}
