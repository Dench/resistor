<?php

namespace backend\controllers;

use yii\web\Controller;

class DownloadController extends Controller
{
    public function actionIndex($id, $name)
    {
        $file = \Yii::$app->params['uploadSalePath'].DIRECTORY_SEPARATOR.$id.DIRECTORY_SEPARATOR.$name;

        if (file_exists($file)) {
            header ("Content-Type: application/octet-stream");
            header ("Accept-Ranges: bytes");
            header ("Content-Length: ".filesize($file));
            header ("Content-Disposition: attachment; filename=".$name);
            readfile($file);
        }

        die();
    }

}
