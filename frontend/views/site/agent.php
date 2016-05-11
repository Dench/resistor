<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = Yii::t('app', 'Agents');
?>
<section class="wrapper-md">
    <div class="container">

        <h1><?= Html::encode($this->title) ?></h1>

        <div class="row">
            <div class="col-md-4">
            </div>
            <div class="col-md-4">
                <?php $form = ActiveForm::begin(['id' => 'login-form', 'method' => 'post', 'action' => Url::toRoute('site/login')]); ?>

                    <?= $form->field($model, 'username') ?>

                    <?= $form->field($model, 'password')->passwordInput() ?>

                    <?= $form->field($model, 'rememberMe')->checkbox() ?>

                    <div style="color:#999;margin:1em 0">
                        <?= Yii::t('app', 'If forgot password', ['link' => Html::a(Yii::t('app', 'Reset it'), ['site/request-password-reset'])]) ?>
                    </div>

                    <div class="form-group">
                        <?= Html::submitButton(Yii::t('app', 'Login'), ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                        <?= Html::a(Yii::t('app', 'Sign up'), Url::toRoute('site/signup'), ['class' => 'btn btn-link']) ?>
                    </div>

                <?php ActiveForm::end(); ?>
            </div>
            <div class="col-md-4">
                <?php
                
                ?>
            </div>
        </div>

    </div>
</section>
