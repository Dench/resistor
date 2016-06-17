<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\ParserAlias */

$this->title = Yii::t('app', 'Creating');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Parser Aliases'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="parser-alias-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
