<?php

/* @var $model \frontend\models\ContactForm */

use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
use yii\captcha\Captcha;

$this->title = Yii::t('app', 'Search real estate');
$this->params['breadcrumbs'][] = $this->title;

?>

<?php $form = ActiveForm::begin(['id' => 'send-form']); ?>

<div class="row">
    <div class="col-md-6">
        <?= $form->field($model, 'name') ?>
    </div>
    <div class="col-md-6">
        <?= $form->field($model, 'mycity') ?>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <?= $form->field($model, 'email') ?>
    </div>
    <div class="col-md-6">
        <?= $form->field($model, 'phone') ?>
    </div>
</div>

<h2><?= Yii::t('app', 'Wishes to the object') ?></h2>

<div class="row">
    <div class="col-md-6">
        <?= $form->field($model, 'rooms') ?>
    </div>
    <div class="col-md-6">
        <?= $form->field($model, 'budget') ?>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <?= $form->field($model, 'sqr') ?>
    </div>
    <div class="col-md-6">
        <?= $form->field($model, 'distance') ?>
    </div>
</div>

<?= $form->field($model, 'region') ?>

<?= $form->field($model, 'text')->textarea(['rows' => 6]) ?>

<div class="form-group">
    <?= Html::submitButton(Yii::t('app', 'Send'), ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
</div>

<?php ActiveForm::end(); ?>
