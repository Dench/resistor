<?php
/* @var $this yii\web\View */
/* @var $model common\models\Sale */

use yii\bootstrap\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use yii\widgets\MaskedInput;

$this->title = Yii::t('app', 'Creating');
?>
<section class="wrapper-md">
    <div class="container">

        <h1><?= $this->title ?></h1>

        <?= $this->render('_form', [
            'model' => $model,
            'model_content' => $model_content,
        ]) ?>

    </div>
</section>