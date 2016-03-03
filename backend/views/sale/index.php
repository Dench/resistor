<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\SaleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Sales');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box">
    <div class="box-body">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            //'filterModel' => $searchModel,
            'columns' => [
                [
                    'attribute' => 'id',
                    'headerOptions' => ['width' => '50'],
                ],
                'name',
                'region.content.name',
                'district.content.name',
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

                [
                    'class' => 'yii\grid\ActionColumn',
                    'headerOptions' => ['width' => '70'],
                ],
            ],
        ]); ?>
    </div>
    <div class="box-footer">
        <?= Html::a(Yii::t('app', 'Create'), ['create'], ['class' => 'btn btn-success']) ?>
    </div>
</div>
