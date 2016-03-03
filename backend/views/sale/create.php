<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Sale */

$this->title = Yii::t('app', 'Creating');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Sales'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sale-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
