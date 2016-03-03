<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\District */
/* @var $region common\models\Region */

$this->title = Yii::t('app', 'Creating');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Districts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="district-create">

    <?= $this->render('_form', [
        'model' => $model,
        'model_content' => $model_content,
    ]) ?>

</div>
