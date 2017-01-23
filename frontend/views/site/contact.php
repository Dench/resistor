<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = Yii::t('app', 'Contact us');
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="wrapper-md">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <div class="contact-block">
                    <h4><?= Yii::t('app', 'Russian speaking manager') ?></h4>
                    <div class="contact-box bg-primary">
                        <i class="fa fa-phone"></i>
                        <div>
                            <?= Yii::$app->params['phone1'] ?>
                        </div>
                    </div>
                </div>
                <div class="contact-block">
                    <h4><?= Yii::t('app', 'Greek / English speaking manager') ?></h4>
                    <div class="contact-box">
                        <i class="fa fa-phone"></i>
                        <div><?= Yii::$app->params['phone2'] ?></div>
                    </div>
                </div>
                <div class="contact-block">
                    <h4><?= Yii::t('app', 'General E-mail') ?></h4>
                    <div class="contact-box bg-primary">
                        <i class="fa fa-envelope"></i>
                        <div>
                            <a href="mailto:<?= Yii::$app->params['email'] ?>"><?= Yii::$app->params['email'] ?></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 text-center">
                <h1 style="margin-bottom: 7%"><?= $this->title ?></h1>
                <img src="/img/operator.png" width="70%" />
            </div>
        </div>
    </div>
</section>