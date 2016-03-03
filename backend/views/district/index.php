<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Districts');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box">
    <div class="box-body">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                [
                    'attribute' => 'id',
                    'headerOptions' => ['width' => '50'],
                ],
                'region.content.name',
                'content.name',

                [
                    'class' => 'yii\grid\ActionColumn',
                    'headerOptions' => ['width' => '50'],
                    'template' => '{update} {delete}',
                ],
            ],
        ]); ?>
    </div>
    <div class="box-footer">
        <?= Html::a(Yii::t('app', 'Create'), ['create'], ['class' => 'btn btn-success']) ?>
    </div>
</div>
