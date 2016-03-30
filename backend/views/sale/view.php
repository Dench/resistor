<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Sale */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Sales'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sale-view">

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'region_id',
            'district_id',
            'name',
            'year',
            'commission',
            'price',
            'gps',
            'covered',
            'uncovered',
            'plot',
            'bathroom',
            'bedroom',
            'solarpanel',
            'sauna',
            'furniture',
            'conditioner',
            'heating',
            'storage',
            'tennis',
            'title',
            'parking',
            'contacts:ntext',
            'owner:ntext',
            'address:ntext',
            'status',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
