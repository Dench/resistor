<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\ParserAlias */

$this->title = Yii::t('app', 'Updating');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Parser Aliases'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['update', 'id' => $model->name]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Updating');
?>
<div class="parser-alias-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
