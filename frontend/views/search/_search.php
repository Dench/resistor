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

<?php if (!Yii::$app->request->get('advanced')): ?>
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
            <?= $form->field($model, 'bedroom_from')->dropDownList([
                    1 => '1 ' . Yii::t('app', 'and more'),
                    2 => '2 ' . Yii::t('app', 'and more'),
                    3 => '3 ' . Yii::t('app', 'and more'),
                    4 => '4 ' . Yii::t('app', 'and more'),
                ], [
                'class' => 'form-control selectpicker show-tick',
                'data-style' => 'btn-primary',
                'title' => Yii::t('app', 'Choose One'),
                'prompt' => Yii::t('app', 'Any')
            ])->label(Yii::t('app', 'Bedrooms')) ?>
        </div>
        <div class="col-xs-6 col-sm-4 col-md-2">
            <?= $form->field($model, 'code')->label(Yii::t('app', 'Property ID'))->textInput(['placeholder' => Yii::t('app', 'Insert property ID')]) ?>
        </div>
        <div class="col-sm-4 col-md-2">
            <label class="search"><i class="fa fa-search"></i> <?= Html::a(Yii::t('app', 'Advanced search'), Url::toRoute(['/search', 'advanced' => 1])) ?></label>
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
                    <?= $form->field($model, 'bedroom_from')->label(false)->textInput(['placeholder' => Yii::t('app', 'From')]) ?>
                </div>
                <div class="col-xs-6">
                    <?= $form->field($model, 'bedroom_to')->label(false)->textInput(['placeholder' => Yii::t('app', 'To')]) ?>
                </div>
            </div>
        </div>
        <div class="col-xs-6 col-sm-4 col-md-2">
            <?= Html::label($model->getAttributeLabel('bathroom')) ?>
            <div class="row fromto">
                <div class="col-xs-6">
                    <?= $form->field($model, 'bathroom_from')->label(false)->textInput(['placeholder' => Yii::t('app', 'From')]) ?>
                </div>
                <div class="col-xs-6">
                    <?= $form->field($model, 'bathroom_to')->label(false)->textInput(['placeholder' => Yii::t('app', 'To')]) ?>
                </div>
            </div>
        </div>
        <div class="col-xs-6 col-sm-4 col-md-2">
            <?= Html::label($model->getAttributeLabel('year')) ?>
            <div class="row fromto">
                <div class="col-xs-6">
                    <?= $form->field($model, 'year_from')->label(false)->textInput(['placeholder' => Yii::t('app', 'From')]) ?>
                </div>
                <div class="col-xs-6">
                    <?= $form->field($model, 'year_to')->label(false)->textInput(['placeholder' => Yii::t('app', 'To')]) ?>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-6 col-sm-4 col-md-2">
            <?= Html::label($model->getAttributeLabel('price')) ?>
            <div class="row fromto">
                <div class="col-xs-6">
                    <?= $form->field($model, 'price_from')->label(false)->textInput(['placeholder' => Yii::t('app', 'From')]) ?>
                </div>
                <div class="col-xs-6">
                    <?= $form->field($model, 'price_to')->label(false)->textInput(['placeholder' => Yii::t('app', 'To')]) ?>
                </div>
            </div>
        </div>
        <div class="col-xs-6 col-sm-4 col-md-2">
            <?= Html::label($model->getAttributeLabel('covered')) ?>
            <div class="row fromto">
                <div class="col-xs-6">
                    <?= $form->field($model, 'covered_from')->label(false)->textInput(['placeholder' => Yii::t('app', 'From')]) ?>
                </div>
                <div class="col-xs-6">
                    <?= $form->field($model, 'covered_to')->label(false)->textInput(['placeholder' => Yii::t('app', 'To')]) ?>
                </div>
            </div>
        </div>
        <div class="col-xs-6 col-sm-4 col-md-2">
            <?= Html::label($model->getAttributeLabel('covered')) ?>
            <div class="row fromto">
                <div class="col-xs-6">
                    <?= $form->field($model, 'uncovered_from')->label(false)->textInput(['placeholder' => Yii::t('app', 'From')]) ?>
                </div>
                <div class="col-xs-6">
                    <?= $form->field($model, 'uncovered_to')->label(false)->textInput(['placeholder' => Yii::t('app', 'To')]) ?>
                </div>
            </div>
        </div>
        <div class="col-xs-6 col-sm-4 col-md-2">
            <?= Html::label($model->getAttributeLabel('covered')) ?>
            <div class="row fromto">
                <div class="col-xs-6">
                    <?= $form->field($model, 'plot_from')->label(false)->textInput(['placeholder' => Yii::t('app', 'From')]) ?>
                </div>
                <div class="col-xs-6">
                    <?= $form->field($model, 'plot_to')->label(false)->textInput(['placeholder' => Yii::t('app', 'To')]) ?>
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
            <?= $form->field($model, 'conditioner')->dropDownList(Sale::getYesList(), [
                'class' => 'form-control selectpicker',
                'data-style' => 'form-control',
                'title' => Yii::t('app', 'Choose One'),
                'prompt' => Yii::t('app', 'Any')
            ]) ?>
        </div>
        <div class="col-xs-6 col-sm-4 col-md-2">
            <?= $form->field($model, 'sauna')->dropDownList(Sale::getYesList(), [
                'class' => 'form-control selectpicker',
                'data-style' => 'form-control',
                'title' => Yii::t('app', 'Choose One'),
                'prompt' => Yii::t('app', 'Any')
            ]) ?>
        </div>
        <div class="col-xs-6 col-sm-4 col-md-2">
            <?= $form->field($model, 'heating')->dropDownList(Sale::getYesList(), [
                'class' => 'form-control selectpicker',
                'data-style' => 'form-control',
                'title' => Yii::t('app', 'Choose One'),
                'prompt' => Yii::t('app', 'Any')
            ]) ?>
        </div>
        <div class="col-xs-6 col-sm-4 col-md-2">
            <?= $form->field($model, 'pool')->dropDownList(Sale::getYesList(), [
                'class' => 'form-control selectpicker',
                'data-style' => 'form-control',
                'title' => Yii::t('app', 'Choose One'),
                'prompt' => Yii::t('app', 'Any')
            ]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-6 col-sm-4 col-md-2">
            <?= $form->field($model, 'code')->textInput()->label(Yii::t('app','Property ID')) ?>
        </div>
        <div class="col-xs-6 col-sm-4 col-md-2">
            <?= $form->field($model, 'furniture')->dropDownList(Sale::getYesList(), [
                'class' => 'form-control selectpicker',
                'data-style' => 'form-control',
                'title' => Yii::t('app', 'Choose One'),
                'prompt' => Yii::t('app', 'Any')
            ]) ?>
        </div>
        <div class="col-xs-6 col-sm-4 col-md-2">
            <?= $form->field($model, 'solarpanel')->dropDownList(Sale::getYesList(), [
                'class' => 'form-control selectpicker',
                'data-style' => 'form-control',
                'title' => Yii::t('app', 'Choose One'),
                'prompt' => Yii::t('app', 'Any')
            ]) ?>
        </div>
        <div class="col-xs-6 col-sm-4 col-md-2">
            <?= $form->field($model, 'tennis')->dropDownList(Sale::getYesList(), [
                'class' => 'form-control selectpicker',
                'data-style' => 'form-control',
                'title' => Yii::t('app', 'Choose One'),
                'prompt' => Yii::t('app', 'Any')
            ]) ?>
        </div>
        <div class="col-xs-6 col-sm-4 col-md-2">
            <?= $form->field($model, 'storage')->dropDownList(Sale::getYesList(), [
                'class' => 'form-control selectpicker',
                'data-style' => 'form-control',
                'title' => Yii::t('app', 'Choose One'),
                'prompt' => Yii::t('app', 'Any')
            ]) ?>
        </div>
        <div class="col-xs-6 col-sm-4 col-md-2">
            <label class="search"><i class="fa fa-search"></i> <?= Html::a(Yii::t('app', 'Simple search'), Url::toRoute(['/search'])) ?></label>
            <?= Html::hiddenInput('advanced', 1); ?>
            <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary btn-block']) ?>
        </div>
    </div>
<?php endif ?>

<?php ActiveForm::end(); ?>