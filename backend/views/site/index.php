<?php

/* @var $this yii\web\View */

use common\models\Sale;
use common\models\User;

$this->title = 'Admin Panel';
?>

<div class="row">
    <div class="col-xs-6 col-md-4">
        <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-home"></i></span>
            <div class="info-box-content">
                <span class="info-box-text"><?= Yii::t('app', 'Sales') ?></span>
                <span class="info-box-number"><?= Sale::find()->count() ?></span>
            </div>
        </div>
    </div>
    <div class="col-xs-6 col-md-4">
        <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-user"></i></span>
            <div class="info-box-content">
                <span class="info-box-text"><?= Yii::t('app', 'Users') ?></span>
                <span class="info-box-number"><?= User::find()->count() ?></span>
            </div>
        </div>
    </div>
    <div class="col-xs-6 col-md-4">

    </div>
</div>
