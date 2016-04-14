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

                <?= $form->field($model, 'name')->textInput(['maxlength' => true])->label($model->type_id == 1 ? Yii::t('app', 'Full name') : Yii::t('app', 'Name')) ?>

                <?php
                if ($model->type_id == 1) {
                    echo $form->field($model, 'company')->textInput(['maxlength' => true]);
                }
                ?>

                <?= $form->field($model, 'phone')->widget(MaskedInput::className(), [
                    'mask' => '999999999999',
                ]) ?>

                <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'contact')->textarea(['rows' => 3]) ?>

                <?= $form->field($model, 'recommend')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'note_user')->textarea(['rows' => 6]) ?>

                <?= $form->field($model, 'sale_add')->dropDownList([0 => Yii::t('app', 'No'), 1 => Yii::t('app', 'Yes')], ['style' => 'width: 100px'])->label(Yii::t('app', 'I want to add real estate')) ?>

                <div class="form-group">
                    <?= Html::submitButton(Yii::t('app', 'Send'), ['class' => 'btn btn-primary']) ?>
                    <?= Html::a(Yii::t('app', 'Cancel'), Url::toRoute('personal/index'), ['class' => 'btn btn-link']) ?>
                </div>

                <?php ActiveForm::end(); ?>

            </div>
            <div class="col-md-6">
                <h3><?= Yii::t('app', 'Sent admin to verify.') ?></h3>
                <?= $model->edit ?>
            </div>
        </div>

    </div>
</section>