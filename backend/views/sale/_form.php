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
                    echo FileInput::widget([
                        'name' => 'photos',
                        'pluginOptions' => [
                            'minImageWidth' => Yii::$app->params['salePhotoMin']['width'],
                            'minImageHeight' => Yii::$app->params['salePhotoMin']['height'],
                            'showCaption' => false,
                            'showRemove' => false,
                            'showUpload' => false,
                            'overwriteInitial' => false,
                            'dropZoneEnabled' => false,
                            'showClose' => false,
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
                    <h3 class="box-title"><?= Yii::t('app', 'General Info') ?></h3>
                </div>
                <div class="box-body">

                    <div class="row">
                        <div class="col-md-4">
                            <?= $form->field($model, 'type')->dropDownList($model->type_list) ?>
                            <?= $form->field($model, 'covered')->textInput(['maxlength' => true]) ?>
                            <?= $form->field($model, 'uncovered')->textInput(['maxlength' => true]) ?>
                            <?= $form->field($model, 'plot')->textInput(['maxlength' => true]) ?>
                        </div>
                        <div class="col-md-4">
                            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
                            <?= $form->field($model, 'year')->textInput(['maxlength' => true]) ?>
                            <?= $form->field($model, 'bedroom')->textInput(['maxlength' => true]) ?>
                            <?= $form->field($model, 'bathroom')->textInput(['maxlength' => true]) ?>
                        </div>
                        <div class="col-md-4">
                            <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>
                            <?= $form->field($model, 'title')->dropDownList(['', Yii::t('app', 'Yes'), Yii::t('app', 'No')]) ?>
                            <?= $form->field($model, 'commission')->textInput(['maxlength' => true]) ?>
                            <?= $form->field($model, 'status')->inline()->radioList(Sale::getStatusList()) ?>
                        </div>
                    </div>

                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title"><?= Yii::t('app', 'Description') ?></h3>
                        </div>
                        <div class="box-body">
                            <?php
                            foreach ($model_content as $key => $content) {
                                echo $form->field($content, "[$key]description")->textarea(['rows' => 3])->label(Yii::t('app', 'Lang_'.$key));
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title"><?= Yii::t('app', 'Notes') ?></h3>
                        </div>
                        <div class="box-body">
                            <?= $form->field($model, 'note_user')->textarea(['rows' => 3]) ?>
                            <?= $form->field($model, 'note_admin')->textarea(['rows' => 3]) ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title"><?= Yii::t('app', 'Contact Info') ?></h3>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-6">
                            <?= $form->field($model, 'contacts')->textarea(['rows' => 2]) ?>
                        </div>
                        <div class="col-md-6">
                            <?= $form->field($model, 'owner')->textarea(['rows' => 2]) ?>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="col-xs-6 col-md-4">

            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title"><?= Yii::t('app', 'Location') ?></h3>
                </div>
                <div class="box-body">

                    <div class="row">
                        <div class="col-md-6">
                            <?= $form->field($model, 'region_id')->dropDownList(Region::getList(), ['id' => 'region_id', 'prompt' => ''])->label(Yii::t('app', 'Region')) ?>
                        </div>
                        <div class="col-md-6">
                            <?=
                            $form->field($model, 'district_id')->widget(DepDrop::classname(), array(
                                'data' => District::getList($model->region_id),
                                'options'=> array('id' => 'district_id'),
                                'pluginOptions' => array(
                                    'depends' => array('region_id'),
                                    'placeholder' => false,
                                    'url' => Url::to(array('/district/list')),
                                )
                            ))->label(Yii::t('app', 'District'));
                            ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>
                        </div>
                        <div class="col-md-6">
                            <?= $form->field($model, 'gps')->textInput(['maxlength' => true]) ?>
                        </div>
                    </div>

                    <div id="map_canvas" style="height: 300px; margin-bottom: 20px;"></div>

                    <?= $form->field($model, 'view_ids')->checkBoxList(View::getList()) ?>

                </div>
            </div>

            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title"><?= Yii::t('app', 'Extra') ?></h3>
                </div>
                <div class="box-body">

                    <div class="row">
                        <div class="col-md-6">
                            <?= $form->field($model, 'conditioner')->dropDownList(['', Yii::t('app', 'Yes'), Yii::t('app', 'No')]) ?>
                        </div>
                        <div class="col-md-6">
                            <?= $form->field($model, 'heating')->dropDownList(['', Yii::t('app', 'Yes'), Yii::t('app', 'No')]) ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <?= $form->field($model, 'sauna')->dropDownList(['', Yii::t('app', 'Yes'), Yii::t('app', 'No')]) ?>
                        </div>
                        <div class="col-md-6">
                            <?= $form->field($model, 'pool')->dropDownList(['', Yii::t('app', 'Yes'), Yii::t('app', 'No')]) ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <?= $form->field($model, 'parking')->dropDownList($model->parking_list) ?>
                        </div>
                        <div class="col-md-6">
                            <?= $form->field($model, 'furniture')->dropDownList(['', Yii::t('app', 'Yes'), Yii::t('app', 'No')]) ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <?= $form->field($model, 'solarpanel')->dropDownList(['', Yii::t('app', 'Yes'), Yii::t('app', 'No')]) ?>
                        </div>
                        <div class="col-md-6">
                            <?= $form->field($model, 'tennis')->dropDownList(['', Yii::t('app', 'Yes'), Yii::t('app', 'No')]) ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <?= $form->field($model, 'storage')->dropDownList(['', Yii::t('app', 'Yes'), Yii::t('app', 'No')]) ?>
                        </div>
                        <div class="col-md-6">

                        </div>
                    </div>

                    <?= $form->field($model, 'facility_ids')->checkBoxList(Facilities::getList()) ?>

                </div>
            </div>

        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
