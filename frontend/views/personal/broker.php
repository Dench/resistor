<?php
/* @var $this yii\web\View */
/* @var $model common\models\Broker */

use yii\bootstrap\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use yii\widgets\MaskedInput;

$this->title = Yii::t('app', 'Edit');
?>
<section class="wrapper-md">
    <div class="container">

        <h1><?= $this->title ?></h1>

        <div class="row">
            <div class="col-md-6">
                <?php $form = ActiveForm::begin(); ?>

                <?= $form->field($model, 'name')->textInput(['maxlength' => true])->label($model->type_id == 1 ? Yii::t('app', 'Full name') : Yii::t('app', 'Company name')) ?>

                <?php
                if ($model->type_id == 1) {
                    echo $form->field($model, 'company')->textInput(['maxlength' => true]);
                }
                ?>

                <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'contact')->textarea(['rows' => 3]) ?>

                <?= $form->field($model, 'recommend')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'note_user')->textarea(['rows' => 6]) ?>

                <div class="form-group">
                    <?= Html::submitButton(Yii::t('app', 'Send'), ['class' => 'btn btn-primary']) ?>
                    <?= Html::a(Yii::t('app', 'Cancel'), Url::toRoute('personal/index'), ['class' => 'btn btn-link']) ?>
                </div>

                <?php ActiveForm::end(); ?>

            </div>
            <?php if ($model->edit): ?>
            <div class="col-md-6">
                <h3><?= Yii::t('app', 'Sent admin to verify.') ?></h3>
                <?= $model->edit ?>
            </div>
            <?php endif; ?>
        </div>

    </div>
</section>