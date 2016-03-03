<?php

use common\models\Region;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\District */
/* @var $region array */
/* @var $form yii\widgets\ActiveForm */

?>

<?php $form = ActiveForm::begin(); ?>

<div class="box">
    <div class="box-body">
        <?= $form->field($model, 'region_id')->dropDownList(Region::getList())->label(Yii::t('app', 'Region')) ?>

        <?php
        foreach ($model_content as $key => $content) {
            echo $form->field($content, "[$key]name")->label(Yii::t('app', 'Lang_'.$key));
        }
        ?>
    </div>
    <div class="box-footer">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
</div>

<?php ActiveForm::end(); ?>
