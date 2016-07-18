<?php

/* @var $model \frontend\models\ContactForm */

use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
use yii\captcha\Captcha;

$this->title = Yii::t('app', 'Search real estate');
$this->params['breadcrumbs'][] = $this->title;

?>

<section class="wrapper-md">
    <div class="container">

        <h1><?= Html::encode($this->title) ?></h1>

        <div class="row">
            <div class="col-lg-5">

                <?php $form = ActiveForm::begin(['id' => 'send-form']); ?>

                <?= $form->field($model, 'name') ?>

                <?= $form->field($model, 'phone') ?>

                <?= $form->field($model, 'email') ?>

                <?= $form->field($model, 'mycity') ?>

                <h2><?= Yii::t('app', 'Wishes to the object') ?></h2>

                <?= $form->field($model, 'rooms') ?>

                <?= $form->field($model, 'distance') ?>

                <?= $form->field($model, 'sqr') ?>

                <?= $form->field($model, 'budget') ?>

                <?= $form->field($model, 'region') ?>

                <?= $form->field($model, 'text')->textarea(['rows' => 6]) ?>

                <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                    'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
                ]) ?>

                <div class="form-group">
                    <?= Html::submitButton(Yii::t('app', 'Send'), ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                </div>

                <?php ActiveForm::end(); ?>

            </div>
        </div>

    </div>
</section>
