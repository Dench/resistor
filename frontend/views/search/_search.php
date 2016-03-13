<?php

use common\models\District;
use common\models\Region;
use common\models\Sale;
use kartik\depdrop\DepDrop;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\SaleSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<?php $form = ActiveForm::begin([
    'action' => ['/search'],
    'method' => 'get',
]); ?>

<div class="row">
    <div class="col-md-2">
        <?= $form->field($model, 'region_id')->dropDownList(Region::getList(), [
            'class' => 'form-control selectpicker show-tick',
            'data-style' => 'btn-primary',
            'id' => 'region_id',
            'title' => Yii::t('app', 'Choose One')
        ]) ?>
    </div>
    <div class="col-md-2">
        <?=
        $form->field($model, 'district_id')->widget(DepDrop::classname(), [
            'data' => District::getList($model->region_id),
            'options'=> [
                'id' => 'district_id',
                'class' => 'form-control selectpicker show-tick',
                'data-style' => 'btn-primary',
                'title' => Yii::t('app', 'Choose One')
            ],
            'pluginOptions' => [
                'depends' => ['region_id'],
                'placeholder' => false,
                'url' => Url::to(['/ajax/district-list']),
            ],
            'pluginEvents' => [
                'depdrop.afterChange' => "function (event, id, value) { $('#district_id').selectpicker('refresh'); }"
            ]
        ]);
        ?>
    </div>
    <div class="col-md-3">
        <?= $form->field($model, 'type_id')->dropDownList(Sale::getTypeList(), [
            'class' => 'form-control selectpicker show-tick',
            'data-style' => 'btn-primary',
            'title' => Yii::t('app', 'Choose One')
        ]) ?>
    </div>
    <div class="col-md-3">
        <label><?= Yii::t('app', 'Bedrooms').' / '.Yii::t('app', 'Bathrooms') ?></label>
        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'bedroom')->dropDownList([1,2,3,4], [
                    'class' => 'form-control selectpicker show-tick',
                    'data-style' => 'btn-primary',
                    'title' => '-'
                ])->label(false) ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'bathroom')->dropDownList([1,2,3,4], [
                    'class' => 'form-control selectpicker show-tick',
                    'data-style' => 'btn-primary',
                    'title' => '-'
                ])->label(false) ?>
            </div>
        </div>
    </div>
    <div class="col-md-2">
        <label>&nbsp;</label>
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary btn-block']) ?>
    </div>
</div>

<?php ActiveForm::end(); ?>