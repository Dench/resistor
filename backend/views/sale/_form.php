<?php

use common\models\District;
use common\models\Region;
use common\models\Sale;
use kartik\depdrop\DepDrop;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Sale */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sale-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'region_id')->dropDownList(Region::getList(), ['id' => 'region-id', 'prompt' => ''])->label(Yii::t('app', 'REGION')) ?>

    <?=
        $form->field($model, 'district_id')->widget(DepDrop::classname(), array(
            'data' => District::getList($model->region_id),
            'options'=> array('id' => 'district-id'),
            'pluginOptions' => array(
                'depends' => array('region-id'),
                'placeholder' => false,
                'url' => Url::to(array('/district/list')),
            )
        ))->label(Yii::t('app', 'DISTRICT'));
    ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'year')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'commission')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'gps')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'covered')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'uncovered')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'plot')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'bathroom')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'bedroom')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'solarpanel')->dropDownList(['', Yii::t('app', 'YES'), Yii::t('app', 'NO')]) ?>

    <?= $form->field($model, 'sauna')->dropDownList(['', Yii::t('app', 'YES'), Yii::t('app', 'NO')]) ?>

    <?= $form->field($model, 'furniture')->dropDownList(['', Yii::t('app', 'YES'), Yii::t('app', 'NO')]) ?>

    <?= $form->field($model, 'conditioner')->dropDownList(['', Yii::t('app', 'YES'), Yii::t('app', 'NO')]) ?>

    <?= $form->field($model, 'heating')->dropDownList(['', Yii::t('app', 'YES'), Yii::t('app', 'NO')]) ?>

    <?= $form->field($model, 'storage')->dropDownList(['', Yii::t('app', 'YES'), Yii::t('app', 'NO')]) ?>

    <?= $form->field($model, 'tennis')->dropDownList(['', Yii::t('app', 'YES'), Yii::t('app', 'NO')]) ?>

    <?= $form->field($model, 'title')->dropDownList(['', Yii::t('app', 'YES'), Yii::t('app', 'NO')]) ?>

    <?= $form->field($model, 'contacts')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'owner')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'address')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'status')->dropDownList(Sale::getStatusList()) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
