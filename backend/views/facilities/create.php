<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Facilities */

$this->title = Yii::t('app', 'Create Facilities');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Facilities'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="facilities-create">

    <?= $this->render('_form', [
        'model' => $model,
        'model_content' => $model_content,
    ]) ?>

</div>
