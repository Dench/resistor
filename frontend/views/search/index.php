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
/* @var $searchModel frontend\models\SaleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Sales');
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

        <h1><?= Html::encode($this->title) ?></h1>

        <?php
            echo ListView::widget([
                'dataProvider' => $dataProvider,
                'itemView' => '_item',
            ]);
        ?>

        <?php /* GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                //'id',
                //'user_id',
                'region_id',
                'district_id',
                'type_id',
                // 'name',
                // 'year',
                // 'commission',
                // 'price',
                // 'gps',
                // 'covered',
                // 'uncovered',
                // 'plot',
                'bathroom',
                'bedroom',
                // 'solarpanel',
                // 'sauna',
                // 'furniture',
                // 'conditioner',
                // 'heating',
                // 'storage',
                // 'tennis',
                // 'pool',
                // 'title',
                // 'parking_id',
                // 'contacts:ntext',
                // 'owner:ntext',
                // 'note_user:ntext',
                // 'note_admin:ntext',
                // 'address',
                // 'status',
                // 'created_at',
                // 'updated_at',

                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]); */?>

    </div>
</section>