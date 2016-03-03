<?php

use common\models\District;
use common\models\Facilities;
use common\models\Region;
use common\models\Sale;
use common\models\View;
use kartik\depdrop\DepDrop;
use kartik\file\FileInput;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Sale */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sale-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php if ($model->id): ?>
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title"><?= Yii::t('app', 'Photos') ?></h3>
            </div>
            <div class="box-body">

                <div class="form-group field-sale-images">
                    <?php

                    $preview = [];
                    $preview_config = [];
                    foreach($model->photos as $item){
                        $preview[] = Html::img(Yii::$app->params['http'].Yii::$app->params['salePhotoThumb']['path'].$item->id.'.jpg');
                        $preview_config[] = [
                            'url' => 'delete-photo',
                            'key' => $item->id
                        ];
                    }
                    echo Html::label(Yii::t('app', 'Photos'));
                    echo FileInput::widget([
                        'name' => 'photos',
                        'pluginOptions' => [
                            'minImageWidth' => Yii::$app->params['salePhotoBig']['width'],
                            'minImageHeight' => Yii::$app->params['salePhotoBig']['height'],
                            'showCaption' => false,
                            'showRemove' => false,
                            'showUpload' => false,
                            'overwriteInitial' => false,
                            'dropZoneEnabled' => false,
                            'initialPreview' => $preview,
                            'initialPreviewConfig' => $preview_config,
                            'browseClass' => 'btn btn-primary btn-block',
                            'browseIcon' => '<i class="glyphicon glyphicon-camera"></i> ',
                            'browseLabel' =>  Yii::t('app', 'Select Photo'),
                            'allowedFileExtensions' => ['jpg'],
                            'uploadUrl' => Url::to(['upload-photo']),
                            'uploadExtraData' => [
                                'sale_id' => $model->id
                            ]
                        ],
                        'options' => [
                            'accept' => 'image/jpeg',
                            'multiple' => true
                        ]
                    ]);
                    ?>
                </div>

            </div>
        </div>
    <?php endif; ?>

    <div class="row">
        <div class="col-xs-12 col-sm-6 col-md-8">

            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title"><?= Yii::t('app', 'MAIN') ?></h3>
                </div>
                <div class="box-body">

                    <?= $form->field($model, 'region_id')->dropDownList(Region::getList(), ['id' => 'region-id', 'prompt' => ''])->label(Yii::t('app', 'Region')) ?>

                    <?=
                    $form->field($model, 'district_id')->widget(DepDrop::classname(), array(
                        'data' => District::getList($model->region_id),
                        'options'=> array('id' => 'district-id'),
                        'pluginOptions' => array(
                            'depends' => array('region-id'),
                            'placeholder' => false,
                            'url' => Url::to(array('/district/list')),
                        )
                    ))->label(Yii::t('app', 'District'));
                    ?>

                    <?= $form->field($model, 'gps')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'year')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'commission')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'covered')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'uncovered')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'plot')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'bathroom')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'bedroom')->textInput(['maxlength' => true]) ?>

                </div>
            </div>

            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title"><?= Yii::t('app', 'CONTACTS') ?></h3>
                </div>
                <div class="box-body">

                    <?= $form->field($model, 'contacts')->textarea(['rows' => 6]) ?>

                    <?= $form->field($model, 'owner')->textarea(['rows' => 6]) ?>

                    <?= $form->field($model, 'address')->textarea(['rows' => 6]) ?>

                </div>
            </div>

        </div>

        <div class="col-xs-6 col-md-4">

            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title"><?= Yii::t('app', 'OTHER') ?></h3>
                </div>
                <div class="box-body">

                    <?= $form->field($model, 'type')->dropDownList($model->type_list) ?>

                    <?= $form->field($model, 'solarpanel')->dropDownList(['', Yii::t('app', 'Yes'), Yii::t('app', 'No')]) ?>

                    <?= $form->field($model, 'sauna')->dropDownList(['', Yii::t('app', 'Yes'), Yii::t('app', 'No')]) ?>

                    <?= $form->field($model, 'furniture')->dropDownList(['', Yii::t('app', 'Yes'), Yii::t('app', 'No')]) ?>

                    <?= $form->field($model, 'conditioner')->dropDownList(['', Yii::t('app', 'Yes'), Yii::t('app', 'No')]) ?>

                    <?= $form->field($model, 'heating')->dropDownList(['', Yii::t('app', 'Yes'), Yii::t('app', 'No')]) ?>

                    <?= $form->field($model, 'storage')->dropDownList(['', Yii::t('app', 'Yes'), Yii::t('app', 'No')]) ?>

                    <?= $form->field($model, 'tennis')->dropDownList(['', Yii::t('app', 'Yes'), Yii::t('app', 'No')]) ?>

                    <?= $form->field($model, 'title')->dropDownList(['', Yii::t('app', 'Yes'), Yii::t('app', 'No')]) ?>

                    <?= $form->field($model, 'parking')->dropDownList($model->parking_list) ?>

                    <?= $form->field($model, 'view_ids')->checkBoxList(View::getList()) ?>

                    <?= $form->field($model, 'facility_ids')->checkBoxList(Facilities::getList()) ?>

                    <?= $form->field($model, 'status')->dropDownList(Sale::getStatusList()) ?>

                </div>
            </div>

        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
