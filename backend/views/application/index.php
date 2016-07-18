<?php

use backend\components\SetColumn;
use common\models\Application;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Applications');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="box">
    <div class="box-body table-responsive">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            
            'time:datetime',
            'name',
            'phone',
            'email:email',
            [
                'class' => SetColumn::className(),
                'attribute' => 'status',
                'filter' => Application::getStatusList(),
                'name' => 'statusName',
                'cssClasses' => [
                    Application::STATUS_READ => 'default',
                    Application::STATUS_NEW => 'danger',
                ],
            ],
            // 'mycity',
            // 'rooms',
            // 'distance',
            // 'sqr',
            // 'budget',
            // 'region',
            // 'text',

            [
                'class' => 'yii\grid\ActionColumn',
                'headerOptions' => ['width' => '70'],
                'template' => '{view} {delete}',
            ],
        ],
    ]); ?>
    </div>
</div>
