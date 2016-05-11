<?php

use backend\components\SetColumn;
use common\models\District;
use common\models\Lang;
use common\models\Region;
use common\models\Sale;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel common\models\SaleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Sales');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box">
    <div class="box-body table-responsive">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                [
                    'attribute' => 'code',
                    'headerOptions' => ['width' => '100'],
                ],
                'name',
                [
                    'class' => SetColumn::className(),
                    'attribute' => 'region_id',
                    'filter' => Region::getList(),
                    'name' => 'region.content.name',
                ],
                [
                    'class' => SetColumn::className(),
                    'attribute' => 'district_id',
                    'filter' => District::getListAll(),
                    'name' => 'district.content.name',
                ],
                'address',
                [
                    'attribute' => 'created_at',
                    'format' =>  ['date', 'dd.MM.Y'],
                    'options' => ['width' => '80']
                ],
                [
                    'class' => SetColumn::className(),
                    'attribute' => 'top',
                    'filter' => Sale::getTopList(),
                    'name' => 'topName',
                    'cssClasses' => [
                        Sale::TOP_DISABLED => 'default',
                        Sale::TOP_ENABLED => 'success',
                    ],
                ],
                [
                    'class' => SetColumn::className(),
                    'attribute' => 'status',
                    'filter' => Sale::getStatusList(),
                    'name' => 'statusName',
                    'cssClasses' => [
                        Sale::STATUS_HIDE => 'default',
                        Sale::STATUS_ACTIVE => 'success',
                        Sale::STATUS_AWAITING => 'warning',
                    ],
                ],
                [
                    'class' => SetColumn::className(),
                    'attribute' => 'sold',
                    'filter' => Sale::getSoldList(),
                    'name' => 'soldName',
                    'cssClasses' => [
                        Sale::SOLD_ACTUAL => 'success',
                        Sale::SOLD_US => 'default',
                        Sale::SOLD_OTHER => 'default',
                    ],
                ],

                [
                    'class' => 'yii\grid\ActionColumn',
                    'headerOptions' => ['width' => '70'],
                    'template' => '{link} {update} {delete}',
                    'buttons' => [
                        'link' => function ($url, $model, $key) {
                            return Html::a('<span class="fa fa-eye"></span>', Url::to(Yii::$app->params['http'].'/'.Lang::getCurrent()->code.'/sale/'.$model->id), ['target' => '_blank']);
                        },
                    ],
                ],
            ],
        ]); ?>
    </div>
    <div class="box-footer">
        <?= Html::a(Yii::t('app', 'Create'), ['create'], ['class' => 'btn btn-success']) ?>
    </div>
</div>
