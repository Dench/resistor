<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\SourceMessage */

$this->title = Yii::t('app', 'Creating');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Phrases'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="source-message-create">

    <?= $this->render('_form', [
        'model' => $model,
        'model_content' => $model_content,
    ]) ?>

</div>
