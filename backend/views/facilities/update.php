<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Facilities */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Facilities',
]) . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Facilities'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="facilities-update">

    <?= $this->render('_form', [
        'model' => $model,
        'model_content' => $model_content,
    ]) ?>

</div>
