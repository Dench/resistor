<?php

use common\models\District;
use common\models\Region;
use common\models\Sale;
use kartik\depdrop\DepDrop;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\SaleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Property search');
$this->params['breadcrumbs'][] = $this->title;
?>

<section class="wrapper-xs bg-highlight">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">

                <?= $this->render('_search', ['model' => $searchModel]); ?>

            </div>
        </div>
    </div>
</section>

<section class="wrapper-md">
    <div class="container">

        <div class="row">
            <?php
                echo ListView::widget([
                    'dataProvider' => $dataProvider,
                    'itemView' => '_item',
                    'layout' => "{summary}\n{items}\n<div class=\"clear-pager\">{pager}</div>",
                    //'pager' => ['class' => \kop\y2sp\ScrollPager::className()],
                ]);
            ?>
        </div>

    </div>
</section>