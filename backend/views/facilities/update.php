<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Facilities */

$this->title = Yii::t('app', 'Updating');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Facilities'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->content->name, 'url' => ['update', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Updating');
?>
<div class="facilities-update">

    <?= $this->render('_form', [
        'model' => $model,
        'model_content' => $model_content,
    ]) ?>

</div>
