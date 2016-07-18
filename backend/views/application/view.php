<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Application */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Applications'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="box">
    <div class="box-body table-responsive">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'time:datetime',
            'name',
            'phone',
            'email:email',
            'mycity',
            'rooms',
            'distance',
            'sqr',
            'budget',
            'region',
            'text',
        ],
    ]) ?>
    </div>
</div>
