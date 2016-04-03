<?php

namespace backend\controllers;

use backend\models\ObjectSearch;
use common\models\Object;
use Yii;
use yii\helpers\Json;
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

    public function actionList()
    {
        if (isset($_POST['depdrop_parents'])) {
            if ($parents = $_POST['depdrop_parents']) {
                $out[-1] = Yii::t('app', 'New object');
                $out += Object::getList($parents[0]);
                foreach ($out as $key => $value) {
                    $result[] = ['id' => $key, 'name' => $value];
                }
                print Json::encode(['output' => @$result, 'selected' => '']);
                return;
            }
        }
    }

}
