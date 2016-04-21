<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use common\models\Broker;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\widgets\MaskedInput;

$this->title = Yii::t('app', 'Registration');
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="wrapper-md">
    <div class="container">
        <h1><?= Html::encode($this->title) ?></h1>

        <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

            <div class="row">
                <div class="col-md-4">
                    <?= $form->field($model, 'username') ?>

                    <?= $form->field($model, 'password')->passwordInput() ?>

                    <?= $form->field($model, 'type_id')->dropDownList(Broker::getTypeList())->label(Yii::t('app', 'Who are you?')) ?>

                    <?= $form->field($model, 'name')->textInput(['maxlength' => true])->label($model->type_id == 1 ? Yii::t('app', 'Full name') : Yii::t('app', 'Company name')) ?>

                    <?= $form->field($model, 'company')->textInput(['maxlength' => true]); ?>

                    <?= $form->field($model, 'phone')->widget(MaskedInput::className(), [
                        'mask' => '999999999999',
                    ]) ?>

                    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-4">
                    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'contact')->textarea(['style' => 'height: 86px']) ?>

                    <?= $form->field($model, 'recommend')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'note_user')->textarea(['rows' => 6]) ?>

                    <?= $form->field($model, 'sale_add')->dropDownList([0 => Yii::t('app', 'No'), 1 => Yii::t('app', 'Yes')], ['style' => 'width: 100px'])->label(Yii::t('app', 'I want to add real estate')) ?>
                </div>
            </div>

            <div class="form-group">
                <?= Html::submitButton(Yii::t('app', 'Send'), ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
            </div>

        <?php ActiveForm::end(); ?>
    </div>

</section>

<?php

$name1 = Yii::t('app', 'Full name');
$name2 = Yii::t('app', 'Company name');
$script = <<< JS
    $('#signupform-type_id').change(function(){
        if ($(this).val() == 1) {
            $('.field-signupform-company').show();
            $('.field-signupform-name label').text('{$name1}');
        } else {
            $('.field-signupform-company').hide();
            $('.field-signupform-name label').text('{$name2}');
        }
    });
JS;
$this->registerJs($script, yii\web\View::POS_READY);