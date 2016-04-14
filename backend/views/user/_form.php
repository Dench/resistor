<?php

use common\models\Group;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\User;
use yii\widgets\MaskedInput;

/* @var $this yii\web\View */
/* @var $model common\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<?php $form = ActiveForm::begin(); ?>

<div class="row">
    <div class="col-md-4">
        <div class="box">
            <div class="box-header with-border">
                <?= Yii::t('app', 'User') ?>
            </div>
            <div class="box-body">
                <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'group_id')->dropDownList(Group::getList()) ?>

                <?= $form->field($model, 'status')->dropDownList(User::getStatusList()) ?>

                <?= $form->field($model, 'password')->passwordInput() ?>
            </div>
        </div>
    </div>
    <div class="col-md-8">

    </div>
</div>

<?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>

<?php ActiveForm::end(); ?>
