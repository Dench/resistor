<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Sale */
/* @var $view common\models\SaleView */

$this->title = Yii::t('app', 'Updating');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Sales'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => 'ID '.$model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Updating');
?>
<div class="sale-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
