<?php
/* @var $this yii\web\View */
/* @var $model common\models\User */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

$this->title = Yii::t('app', 'Edit');
?>
<section class="wrapper-md">
    <div class="container">

        <h1><?= $this->title ?></h1>

        <div class="row">
            <div class="col-md-4">

                <?php $form = ActiveForm::begin(); ?>

                <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'password')->passwordInput() ?>

                <div class="form-group">
                    <?= Html::submitButton(Yii::t('app', 'Update'), ['class' => 'btn btn-primary']) ?>
                    <?= Html::a(Yii::t('app', 'Cancel'), Url::toRoute('personal/index'), ['class' => 'btn btn-link']) ?>
                </div>

                <?php ActiveForm::end(); ?>

            </div>
            <div class="col-md-8">

            </div>
        </div>

    </div>
</section>