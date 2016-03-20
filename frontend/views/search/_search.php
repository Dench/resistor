<?php

use common\models\District;
use common\models\Facilities;
use common\models\Region;
use common\models\Sale;
use common\models\View;
use kartik\depdrop\DepDrop;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\SaleSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<?php $form = ActiveForm::begin([
    'action' => ['/search'],
    'method' => 'get',
    'enableClientValidation' => false
]); ?>

<?php if (Yii::$app->request->get('advanced')): ?>
    <div class="row">
        <div class="col-sm-4 col-md-2">
            <?= $form->field($model, 'region_id')->dropDownList(Region::getList(), [
                'class' => 'form-control selectpicker show-tick',
                'data-style' => 'btn-primary',
                'id' => 'region_id',
                'title' => Yii::t('app', 'Choose One'),
                'prompt' => Yii::t('app', 'Any')
            ]) ?>
        </div>
        <div class="col-sm-4 col-md-2">
            <?=
            $form->field($model, 'district_id')->widget(DepDrop::classname(), [
                'data' => District::getList($model->region_id),
                'options'=> [
                    'id' => 'district_id',
                    'class' => 'form-control selectpicker show-tick',
                    'data-style' => 'btn-primary',
                    'title' => Yii::t('app', 'Choose One'),
                    'prompt' => Yii::t('app', 'Any')
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
        <div class="col-sm-4 col-md-2">
            <?= $form->field($model, 'type_id')->dropDownList(Sale::getTypeList(), [
                'class' => 'form-control selectpicker show-tick',
                'data-style' => 'btn-primary',
                'title' => Yii::t('app', 'Choose One'),
                'prompt' => Yii::t('app', 'Any')
            ])->label(Yii::t('app', 'Type')) ?>
        </div>
        <div class="col-xs-6 col-sm-4 col-md-2">
            <?= $form->field($model, 'bedroom')->dropDownList([1,2,3,4], [
                'class' => 'form-control selectpicker show-tick',
                'data-style' => 'btn-primary',
                'title' => Yii::t('app', 'Choose One'),
                'prompt' => Yii::t('app', 'Any')
            ]) ?>
        </div>
        <div class="col-xs-6 col-sm-4 col-md-2">
            <?= $form->field($model, 'bathroom')->dropDownList([1,2,3,4], [
                'class' => 'form-control selectpicker show-tick',
                'data-style' => 'btn-primary',
                'title' => Yii::t('app', 'Choose One'),
                'prompt' => Yii::t('app', 'Any')
            ])->label(Yii::t('app', 'Bath')) ?>
        </div>
        <div class="col-sm-4 col-md-2">
            <label>&nbsp;</label>
            <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary btn-block']) ?>
        </div>
    </div>
<?php else: ?>
    <div class="row">
        <div class="col-xs-6 col-sm-4 col-md-2">
            <?= $form->field($model, 'region_id')->dropDownList(Region::getList(), [
                'class' => 'form-control selectpicker show-tick',
                'data-style' => 'form-control',
                'id' => 'region_id',
                'title' => Yii::t('app', 'Choose One'),
                'prompt' => Yii::t('app', 'Any')
            ]) ?>
        </div>
        <div class="col-xs-6 col-sm-4 col-md-2">
            <?=
            $form->field($model, 'district_id')->widget(DepDrop::classname(), [
                'data' => District::getList($model->region_id),
                'options'=> [
                    'class' => 'form-control selectpicker show-tick',
                    'data-style' => 'form-control',
                    'id' => 'district_id',
                    'title' => Yii::t('app', 'Choose One'),
                    'prompt' => Yii::t('app', 'Any')
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
        <div class="col-xs-6 col-sm-4 col-md-2">
            <?= $form->field($model, 'type_id')->dropDownList(Sale::getTypeList(), [
                'class' => 'form-control selectpicker show-tick',
                'data-style' => 'form-control',
                'title' => Yii::t('app', 'Choose One'),
                'prompt' => Yii::t('app', 'Any')
            ])->label(Yii::t('app', 'Type')) ?>
        </div>
        <div class="col-xs-6 col-sm-4 col-md-2">
            <?= Html::label($model->getAttributeLabel('bedroom')) ?>
            <div class="row fromto">
                <div class="col-xs-6">
                    <?= $form->field($model, 'bedroom[from]')->label(false)->textInput(['placeholder' => Yii::t('app', 'From')]) ?>
                </div>
                <div class="col-xs-6">
                    <?= $form->field($model, 'bedroom[to]')->label(false)->textInput(['placeholder' => Yii::t('app', 'To')]) ?>
                </div>
            </div>
        </div>
        <div class="col-xs-6 col-sm-4 col-md-2">
            <?= Html::label($model->getAttributeLabel('bathroom')) ?>
            <div class="row fromto">
                <div class="col-xs-6">
                    <?= $form->field($model, 'bathroom[from]')->label(false)->textInput(['placeholder' => Yii::t('app', 'From')]) ?>
                </div>
                <div class="col-xs-6">
                    <?= $form->field($model, 'bathroom[to]')->label(false)->textInput(['placeholder' => Yii::t('app', 'To')]) ?>
                </div>
            </div>
        </div>
        <div class="col-xs-6 col-sm-4 col-md-2">
            <?= Html::label($model->getAttributeLabel('year')) ?>
            <div class="row fromto">
                <div class="col-xs-6">
                    <?= $form->field($model, 'year[from]')->label(false)->textInput(['placeholder' => Yii::t('app', 'From')]) ?>
                </div>
                <div class="col-xs-6">
                    <?= $form->field($model, 'year[to]')->label(false)->textInput(['placeholder' => Yii::t('app', 'To')]) ?>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-6 col-sm-4 col-md-2">
            <?= Html::label($model->getAttributeLabel('price')) ?>
            <div class="row fromto">
                <div class="col-xs-6">
                    <?= $form->field($model, 'price[from]')->label(false)->textInput(['placeholder' => Yii::t('app', 'From')]) ?>
                </div>
                <div class="col-xs-6">
                    <?= $form->field($model, 'price[to]')->label(false)->textInput(['placeholder' => Yii::t('app', 'To')]) ?>
                </div>
            </div>
        </div>
        <div class="col-xs-6 col-sm-4 col-md-2">
            <?= Html::label($model->getAttributeLabel('covered')) ?>
            <div class="row fromto">
                <div class="col-xs-6">
                    <?= $form->field($model, 'covered[from]')->label(false)->textInput(['placeholder' => Yii::t('app', 'From')]) ?>
                </div>
                <div class="col-xs-6">
                    <?= $form->field($model, 'covered[to]')->label(false)->textInput(['placeholder' => Yii::t('app', 'To')]) ?>
                </div>
            </div>
        </div>
        <div class="col-xs-6 col-sm-4 col-md-2">
            <?= Html::label($model->getAttributeLabel('covered')) ?>
            <div class="row fromto">
                <div class="col-xs-6">
                    <?= $form->field($model, 'uncovered[from]')->label(false)->textInput(['placeholder' => Yii::t('app', 'From')]) ?>
                </div>
                <div class="col-xs-6">
                    <?= $form->field($model, 'uncovered[to]')->label(false)->textInput(['placeholder' => Yii::t('app', 'To')]) ?>
                </div>
            </div>
        </div>
        <div class="col-xs-6 col-sm-4 col-md-2">
            <?= Html::label($model->getAttributeLabel('covered')) ?>
            <div class="row fromto">
                <div class="col-xs-6">
                    <?= $form->field($model, 'plot[from]')->label(false)->textInput(['placeholder' => Yii::t('app', 'From')]) ?>
                </div>
                <div class="col-xs-6">
                    <?= $form->field($model, 'plot[to]')->label(false)->textInput(['placeholder' => Yii::t('app', 'To')]) ?>
                </div>
            </div>
        </div>
        <div class="col-xs-6 col-sm-4 col-md-2">
            <?= $form->field($model, 'view_ids')->dropDownList(View::getList(), [
                'class' => 'form-control selectpicker',
                'data-style' => 'form-control',
                'title' => Yii::t('app', 'Choose One'),
                'multiple' => 'multiple'
            ]) ?>
        </div>
        <div class="col-xs-6 col-sm-4 col-md-2">
            <?= $form->field($model, 'facility_ids')->dropDownList(Facilities::getList(), [
                'class' => 'form-control selectpicker',
                'data-style' => 'form-control',
                'title' => Yii::t('app', 'Choose One'),
                'multiple' => 'multiple'
            ]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-6 col-sm-4 col-md-2">
            <?= $form->field($model, 'name')->textInput() ?>
        </div>
        <div class="col-xs-6 col-sm-4 col-md-2">
            <?= $form->field($model, 'parking_id')->dropDownList(Sale::getParkingList(), [
                'class' => 'form-control selectpicker',
                'data-style' => 'form-control',
                'title' => Yii::t('app', 'Choose One'),
                'prompt' => Yii::t('app', 'Any')
            ]) ?>
        </div>
        <div class="col-xs-6 col-sm-4 col-md-2">
            <?= $form->field($model, 'conditioner')->dropDownList([Yii::t('app', 'Yes'), Yii::t('app', 'No')], [
                'class' => 'form-control selectpicker',
                'data-style' => 'form-control',
                'title' => Yii::t('app', 'Choose One'),
                'prompt' => Yii::t('app', 'Any')
            ]) ?>
        </div>
        <div class="col-xs-6 col-sm-4 col-md-2">
            <?= $form->field($model, 'sauna')->dropDownList([Yii::t('app', 'Yes'), Yii::t('app', 'No')], [
                'class' => 'form-control selectpicker',
                'data-style' => 'form-control',
                'title' => Yii::t('app', 'Choose One'),
                'prompt' => Yii::t('app', 'Any')
            ]) ?>
        </div>
        <div class="col-xs-6 col-sm-4 col-md-2">
            <?= $form->field($model, 'heating')->dropDownList([Yii::t('app', 'Yes'), Yii::t('app', 'No')], [
                'class' => 'form-control selectpicker',
                'data-style' => 'form-control',
                'title' => Yii::t('app', 'Choose One'),
                'prompt' => Yii::t('app', 'Any')
            ]) ?>
        </div>
        <div class="col-xs-6 col-sm-4 col-md-2">
            <?= $form->field($model, 'pool')->dropDownList([Yii::t('app', 'Yes'), Yii::t('app', 'No')], [
                'class' => 'form-control selectpicker',
                'data-style' => 'form-control',
                'title' => Yii::t('app', 'Choose One'),
                'prompt' => Yii::t('app', 'Any')
            ]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-6 col-sm-4 col-md-2">
            <?= $form->field($model, 'id')->textInput() ?>
        </div>
        <div class="col-xs-6 col-sm-4 col-md-2">
            <?= $form->field($model, 'furniture')->dropDownList([Yii::t('app', 'Yes'), Yii::t('app', 'No')], [
                'class' => 'form-control selectpicker',
                'data-style' => 'form-control',
                'title' => Yii::t('app', 'Choose One'),
                'prompt' => Yii::t('app', 'Any')
            ]) ?>
        </div>
        <div class="col-xs-6 col-sm-4 col-md-2">
            <?= $form->field($model, 'solarpanel')->dropDownList([Yii::t('app', 'Yes'), Yii::t('app', 'No')], [
                'class' => 'form-control selectpicker',
                'data-style' => 'form-control',
                'title' => Yii::t('app', 'Choose One'),
                'prompt' => Yii::t('app', 'Any')
            ]) ?>
        </div>
        <div class="col-xs-6 col-sm-4 col-md-2">
            <?= $form->field($model, 'tennis')->dropDownList([Yii::t('app', 'Yes'), Yii::t('app', 'No')], [
                'class' => 'form-control selectpicker',
                'data-style' => 'form-control',
                'title' => Yii::t('app', 'Choose One'),
                'prompt' => Yii::t('app', 'Any')
            ]) ?>
        </div>
        <div class="col-xs-6 col-sm-4 col-md-2">
            <?= $form->field($model, 'storage')->dropDownList([Yii::t('app', 'Yes'), Yii::t('app', 'No')], [
                'class' => 'form-control selectpicker',
                'data-style' => 'form-control',
                'title' => Yii::t('app', 'Choose One'),
                'prompt' => Yii::t('app', 'Any')
            ]) ?>
        </div>
        <div class="col-xs-6 col-sm-4 col-md-2">
            <label>&nbsp;</label>
            <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary btn-block']) ?>
        </div>
    </div>
<?php endif ?>

<?php ActiveForm::end(); ?>