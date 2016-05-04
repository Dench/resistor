<?php

use common\models\Broker;
use common\models\Group;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\MaskedInput;

/* @var $this yii\web\View */
/* @var $model common\models\Broker */
/* @var $user common\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="agent-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-4">
            <div class="box">
                <div class="box-header with-border">
                    <?= Yii::t('app', 'Registration data') ?>
                </div>
                <div class="box-body">
                    <?= $form->field($user, 'username')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($user, 'email')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($user, 'password')->passwordInput() ?>

                    <?= $form->field($user, 'group_id')->dropDownList(Group::getList()) ?>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="box">
                <div class="box-header with-border">
                    <?= Yii::t('app', 'Information broker') ?>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-6">
                            <?= $form->field($model, 'type_id')->dropDownList(Broker::getTypeList()); ?>

                            <?= $form->field($model, 'name')->textInput(['maxlength' => true])->label($model->type_id == 1 ? Yii::t('app', 'Full name') : Yii::t('app', 'Name')) ?>

                            <?php
                            if ($model->type_id == 1) {
                                echo $form->field($model, 'company')->textInput(['maxlength' => true]);
                            }
                            ?>

                            <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

                            <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

                            <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

                            <?= $form->field($model, 'contact')->textarea(['rows' => 3]) ?>
                        </div>
                        <div class="col-md-6">
                            <?= $form->field($model, 'recommend')->textInput(['maxlength' => true]) ?>

                            <?= $form->field($model, 'note_user')->textarea(['rows' => 6]) ?>

                            <?= $form->field($model, 'note_admin')->textarea(['rows' => 6]) ?>

                            <?= $form->field($model, 'sale_add')->checkbox(['value' => 1]) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php if ($model->edit): ?>
        <div class="col-md-4">
            <div class="box">
                <div class="box-header with-border">
                    <?= Yii::t('app', 'Registration data') ?>
                </div>
                <div class="box-body">
                    <?= $model->edit ?>
                    <?= Html::label(Html::checkbox('ok', false, ['name' => 'ok']).' OK') ?>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>

    <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>

    <?php ActiveForm::end(); ?>

</div>
