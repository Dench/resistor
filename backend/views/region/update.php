<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Region */

$this->title = Yii::t('app', 'Updating');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Regions'), 'url' => ['/region']];
$this->params['breadcrumbs'][] = ['label' => $model->content->name, 'url' => ['update', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Updating');
?>
<div class="region-update">

    <?= $this->render('_form', [
        'model' => $model,
        'model_content' => $model_content,
    ]) ?>

</div>
