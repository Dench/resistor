<?php

/* @var $this yii\web\View */
/* @var $search common\models\SaleSearch */
/* @var $last array */
/* @var $week array */
/* @var $searchModel common\models\SaleSearch */

use frontend\widgets\SaleItem;
use yii\bootstrap\Carousel;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = Yii::$app->params['sitename'];
?>

<section class="wrapper-lg bg-custom-home">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="widget padding-lg bg-dark">
                    <h1 class="text-center text-light"><?= Yii::t('app', 'Slogan') ?></h1>
                    <br class="spacer-lg">

                    <?= $this->render('../search/_search', ['model' => $searchModel]); ?>

                </div>
            </div>
        </div>
    </div>
</section>

<section class="wrapper-md">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 text-center">
                <h2><i class="fa fa-trophy text-primary"></i> <?= Yii::t('app', 'The best real estate') ?></h2>
                <p class="lead">
                    <?= Yii::t('app', 'Welcome text') ?>
                </p>
                <p class="lead">
                    <?= Yii::t('app', 'Now heat') ?>
                </p>
            </div>
        </div>
    </div>
</section>

<section class="wrapper-md bg-highlight">
    <div class="container">
        <div class="row">
            <?php
                foreach ($last as $item) {
                    echo SaleItem::widget([
                        'col' => 'col-sm-6 col-md-3',
                        'id' => $item->id,
                        'url' => Url::toRoute(['sale/index', 'id' => $item->id]),
                        'cover' => $item->cover['small'],
                        'name' => $item->name,
                        'region' => $item->region->content->name,
                        'district' => $item->district->content->name,
                        'price' => $item->price,
                        'bedroom' => $item->bedroom,
                        'bathroom' => $item->bathroom
                    ]);
                }
            ?>
        </div>
    </div>
</section>

<section class="wrapper-md bg-primary">
    <div class="container">
        <h2 class="text-center headline"><?= Yii::t('app', 'Featured this week') ?></h2>
        <br class="spacer-lg">
        <div class="row">
            <?php
                foreach ($week as $item) {
                    echo SaleItem::widget([
                        'col' => 'col-sm-6 col-md-3',
                        'id' => $item->id,
                        'url' => Url::toRoute(['sale/index', 'id' => $item->id]),
                        'cover' => $item->cover['small'],
                        'name' => $item->name,
                        'region' => $item->region->content->name,
                        'district' => $item->district->content->name,
                        'price' => $item->price,
                        'bedroom' => $item->bedroom,
                        'bathroom' => $item->bathroom
                    ]);
                }
            ?>
        </div>
    </div>
</section>

<section class="wrapper-md">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-4 text-center">
                <div class="widget padding-md bg-primary">
                    <h2><i class="fa fa-list"></i> <?= Yii::t('app', 'How to choose') ?></h2>
                    <p class="lead"><?= Yii::t('app', 'How to choose - text') ?></p>
                </div>
            </div>
            <div class="col-sm-12 col-md-4 text-center">
                <div class="widget padding-md bg-info">
                    <h2><i class="fa fa-flag"></i> <?= Yii::t('app', 'Legal support') ?></h2>
                    <p class="lead"><?= Yii::t('app', 'Legal support - text') ?></p>
                </div>
            </div>
            <div class="col-sm-12 col-md-4 text-center">
                <div class="widget padding-md bg-primary">
                    <h2><i class="fa fa-question-circle"></i> <?= Yii::t('app', 'Service') ?></h2>
                    <p class="lead"><?= Yii::t('app', 'Service - text') ?></p>
                </div>
            </div>
        </div>
    </div>
</section>