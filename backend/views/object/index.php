<?php

use backend\components\SetColumn;
use common\models\District;
use common\models\Region;
use common\models\Sale;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ObjectSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Objects');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box">
    <div class="box-body">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute' => 'id',
                'headerOptions' => ['width' => '50'],
            ],
            [
                'class' => SetColumn::className(),
                'label' => Yii::t('app', 'Name'),
                'attribute' => 'name',
                'value' => 'sale.name',
            ],
            [
                'class' => SetColumn::className(),
                'attribute' => 'region_id',
                'filter' => Region::getList(),
                'value' => 'sale.region.content.name'
            ],
            [
                'class' => SetColumn::className(),
                'attribute' => 'district_id',
                'filter' => District::getListAll(),
                'value' => 'sale.district.content.name',
            ],
            [
                'attribute' => 'sale.created_at',
                'format' =>  ['date', 'dd.MM.Y'],
                'options' => ['width' => '80']
            ],
            [
                'class' => SetColumn::className(),
                'attribute' => 'status',
                'filter' => Sale::getStatusList(),
                'value' => 'sale.statusName',
                'cssClasses' => [
                    Sale::STATUS_HIDE => 'default',
                    Sale::STATUS_ACTIVE => 'success',
                ],
            ],
        ],
    ]); ?>
    </div>
</div>
