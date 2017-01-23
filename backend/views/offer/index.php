<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\OfferSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Offers');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="box">
    <div class="box-body table-responsive">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                [
                    'attribute' => 'code',
                    'content' => function($data){
                        return Yii::$app->params['frontend_home'].'/offer/'.$data->code;
                    }
                ],
                'created_at:datetime',
                'updated_at:datetime',
    
                [
                    'class' => 'yii\grid\ActionColumn',
                    'buttons' => [
                        'view' => function ($url, $model) {
                            return Html::a(
                                '<span class="glyphicon glyphicon-eye-open"></span>',
                                Yii::$app->params['frontend_home'].'/offer/'.$model->code,
                                [
                                    'target' => '_blank'
                                ]
                            );
                        }
                    ],
                ],
            ],
        ]); ?>
    </div>
    <div class="box-footer">
        <?= Html::a(Yii::t('app', 'Create'), ['create'], ['class' => 'btn btn-success']) ?>
    </div>
</div>
