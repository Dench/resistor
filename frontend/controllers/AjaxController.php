<?php

namespace frontend\controllers;

use common\models\District;
use common\models\Sale;
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
                $district_ids = Sale::find()->select('district_id')->where(['region_id' => $parents[0]])->groupBy(['district_id'])->column();
                $out = District::getListByIds($district_ids);
                foreach ($out as $key => $value) {
                    $result[] = ['id' => $key, 'name' => $value];
                }
                print Json::encode(['output' => @$result, 'selected' => '']);
                return;
            }
        }
    }
}
