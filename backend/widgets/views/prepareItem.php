<?php
/** @var $sale Sale */
/** @var $content SaleLang */
/** @var $image ParseImage */
/** @var $origin array */
/** @var $parse Parse */

use backend\models\Parse;
use backend\models\ParseImage;
use common\models\District;
use common\models\Region;
use common\models\Sale;
use common\models\SaleLang;
use common\models\Stage;
use common\models\View;
use kartik\depdrop\DepDrop;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
use yii\helpers\Url;

?>

<div class="box">
    <div class="box-body">

        <?php $form = ActiveForm::begin(['options' => ['class' => 'item', 'id' => 'p' . $parse->id]]); ?>

        <div class="row">
            <div class="col-md-2">
                <?= $form->field($sale, 'type_id', ['template' => '{input}'])->dropDownList(Sale::getTypeList(), [
                    'prompt' => '- ' . @$origin['type'] . ' -',
                    'class' => 'form-control',
                    'data-toggle' => 'tooltip',
                    'title' => $sale->getAttributeLabel('type_id')
                ]) ?>
            </div>
            <div class="col-md-2">
                <?= $form->field($sale, 'region_id', ['template' => '{input}'])->dropDownList(Region::getList(), [
                    'class' => 'form-control',
                    'id' => 'region_id_' . $form->id,
                    'prompt' => '- ' . @$origin['region'] . ' -',
                    'data-toggle' => 'tooltip',
                    'title' => $sale->getAttributeLabel('region_id')
                ]) ?>
            </div>
            <div class="col-md-2">
                <?php
                if ($sale->region_id) {
                    $district_list = District::getList($sale->region_id);
                } else {
                    $district_list = [];
                }
                echo $form->field($sale, 'district_id', ['template' => '{input}'])->widget(DepDrop::className(), [
                    'data' => $district_list,
                    'options'=> [
                        'id' => 'district_id_' . $form->id,
                        'prompt' => '- ' . @$origin['district'] . ' -',
                        'data-toggle' => 'tooltip',
                        'title' => $sale->getAttributeLabel('district_id'),
                        'data-value' => @$origin['district'],
                    ],
                    'pluginOptions' => [
                        'depends' => ['region_id_' . $form->id],
                        'placeholder' => false,
                        'url' => Url::to(['/district/list']),
                    ],
                ]);
                ?>
            </div>
            <div class="col-md-2">
                <?= $form->field($sale, 'gps', ['template' => '{input}'])->textInput(['data-toggle' => 'tooltip', 'title' => $sale->getAttributeLabel('gps')]) ?>
            </div>
            <div class="col-md-1">
                <?= $form->field($sale, 'price', ['template' => '{input}'])->textInput(['data-toggle' => 'tooltip', 'title' => $sale->getAttributeLabel('price')]) ?>
            </div>
            <div class="col-md-2">
                <?= $form->field($sale, 'vat', ['template' => '{input}'])->dropDownList(Sale::getVatList(), [
                    'prompt' => '- ' . @$origin['vat'] . ' -',
                    'class' => 'form-control',
                    'data-toggle' => 'tooltip',
                    'title' => $sale->getAttributeLabel('vat')
                ]) ?>
            </div>
            <div class="col-md-1">
                <?= Html::submitButton(Yii::t('app', 'Send'), ['class' => 'btn btn-default btn-block']) ?>
                <?= Html::activeHiddenInput($sale, 'id'); ?>
                <?= Html::activeHiddenInput($sale, 'user_id'); ?>
                <?= Html::activeHiddenInput($parse, 'id'); ?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-2">
                <?= $form->field($sale, 'view_ids', ['template' => '{input}'])->checkboxList(View::getList(), ['data-toggle' => 'tooltip', 'title' => $sale->getAttributeLabel('view_ids')]) ?>
            </div>
            <div class="col-md-4">
                <?= $form->field($content, 'name', ['template' => '{input}'])->textInput(['data-toggle' => 'tooltip', 'title' => $sale->getAttributeLabel('name')]) ?>
            </div>
            <div class="col-md-2">
                <?= $form->field($content, 'description', ['template' => '{input}'])->textarea(['data-toggle' => 'tooltip', 'title' => $sale->getAttributeLabel('description')]) ?>
                <?php
                foreach ($image as $i) {
                    if (!empty($i->url)) {
                        echo Html::a(' <i class="glyphicon glyphicon-camera"></i> ', $i->url, ['target' => '_blank']);
                    }
                    echo Html::activeHiddenInput($i, '[' . $i->id . ']url', ['id' => false, 'class' => 'photo']);
                }
                ?>
            </div>
            <div class="col-md-1">
                <?= $form->field($sale, 'covered', ['template' => '{input}'])->textInput(['data-toggle' => 'tooltip', 'title' => $sale->getAttributeLabel('covered')]) ?>
            </div>
            <div class="col-md-1">
                <?= $form->field($sale, 'bedroom', ['template' => '{input}'])->textInput(['data-toggle' => 'tooltip', 'title' => $sale->getAttributeLabel('bedroom')]) ?>
            </div>
            <div class="col-md-2">
                <?= $form->field($sale, 'stage_ids', ['template' => '{input}'])->checkboxList(Stage::getList(), ['data-toggle' => 'tooltip', 'title' => $sale->getAttributeLabel('stage_ids')]) ?>
            </div>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>
