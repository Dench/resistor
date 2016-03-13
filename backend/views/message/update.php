<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\SourceMessage */

$this->title = Yii::t('app', 'Updating');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Phrases'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->message, 'url' => ['update', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Updating');
?>
<div class="source-message-update">

    <?= $this->render('_form', [
        'model' => $model,
        'model_content' => $model_content,
    ]) ?>

</div>
