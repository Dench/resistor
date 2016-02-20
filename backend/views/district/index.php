<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Districts');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="district-index">

    <div class="box">
        <div class="box-body">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'columns' => [

                    'id',
                    'region.content.name',
                    'content.name',

                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>
        </div>
        <div class="box-footer">
            <?= Html::a(Yii::t('app', 'Create District'), ['create'], ['class' => 'btn btn-success']) ?>
        </div>
    </div>

</div>
