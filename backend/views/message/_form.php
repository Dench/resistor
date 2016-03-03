<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\SourceMessage */
/* @var $form yii\widgets\ActiveForm */
?>

<?php $form = ActiveForm::begin(); ?>

<div class="box">
    <div class="box-body">
        <?= $form->field($model, 'message')->textInput(['maxlength' => true])->label(Yii::t('app', 'Code')) ?>

        <?php
        foreach ($model_content as $key => $content) {
            echo $form->field($content, "[$key]translation")->label(Yii::t('app', 'Lang_'.$content->language));
        }
        ?>
    </div>
    <div class="box-footer">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
</div>

<?php ActiveForm::end(); ?>
