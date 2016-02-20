<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\SaleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Sales');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sale-index">

    <div class="box">
        <div class="box-body">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    'id',
                    'region_id',
                    'district_id',
                    'title',
                    'year',
                    // 'commission',
                    // 'price',
                    // 'gps',
                    // 'covered',
                    // 'uncovered',
                    // 'plot',
                    // 'bathroom',
                    // 'bedroom',
                    // 'solarpanel',
                    // 'sauna',
                    // 'furniture',
                    // 'conditioner',
                    // 'heating',
                    // 'storage',
                    // 'tennis',
                    // 'contacts:ntext',
                    // 'owner:ntext',
                    // 'address:ntext',
                    // 'status',
                    // 'created_at',
                    // 'updated_at',

                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>
        </div>
        <div class="box-footer">
            <?= Html::a(Yii::t('app', 'Create Sale'), ['create'], ['class' => 'btn btn-success']) ?>
        </div>
    </div>

</div>
