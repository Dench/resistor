<?php

use backend\assets\MapAsset;
use common\models\District;
use common\models\Facilities;
use common\models\Region;
use common\models\Sale;
use common\models\SalePhoto;
use common\models\View;
use kartik\depdrop\DepDrop;
use kartik\file\FileInput;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use yii\widgets\MaskedInput;

MapAsset::register($this);

/* @var $this yii\web\View */
/* @var $model common\models\Sale */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sale-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php if (!$model->id && $model->object_id): ?>
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title"><?= Yii::t('app', 'Photos') ?></h3>
        </div>
        <div class="box-body">
            <?php
                $photos = SalePhoto::getPhotos($model->object_id);

                foreach ($photos as $item) {
                    echo '<label><input type="checkbox" name="photos['.$item['id'].']" value="'.$item['sale_id'].'" style="position: absolute;"><img src="'.(Yii::$app->params['http'].Yii::$app->params['salePhotoThumb']['path'].$item['id']).'.jpg" width="120"></label> ';
                }
            ?>
        </div>
    </div>
    <?php endif; ?>

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
                            <?= $form->field($model, 'type_id')->dropDownList($model->typeList, ['prompt' => '']) ?>
                            <?= $form->field($model, 'covered')->textInput(['maxlength' => true]) ?>
                            <?= $form->field($model, 'uncovered')->textInput(['maxlength' => true]) ?>
                            <?= $form->field($model, 'plot')->textInput(['maxlength' => true]) ?>
                            <div class="form-group">
                                <label><?= Yii::t('app', 'Object') ?></label>
                                <?php
                                    if ($model->object_id) {
                                        $object = 'ID '.$model->object->id.' ('.$model->object->sale->address.') '.date('d.m.Y', $model->object->sale->created_at);
                                    } else {
                                        $object = Yii::t('app', 'New object');
                                    }
                                    echo Html::textInput('', $object, ['class' => 'form-control', 'readonly' => true]);
                                ?>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
                            <?= $form->field($model, 'year')->textInput(['maxlength' => true]) ?>
                            <?= $form->field($model, 'bedroom')->textInput(['maxlength' => true]) ?>
                            <?= $form->field($model, 'bathroom')->textInput(['maxlength' => true]) ?>
                            <?= $form->field($model, 'sold')->dropDownList($model->soldList) ?>
                        </div>
                        <div class="col-md-4">
                            <?= $form->field($model, 'price')->widget(MaskedInput::className(), [
                                'clientOptions' => [
                                    'alias' =>  'decimal',
                                    'groupSeparator' => '.',
                                    'autoGroup' => true,
                                    'rightAlign' => false
                                ],
                                'options' => ['maxlength' => 11, 'class' => 'form-control']
                            ]) ?>
                            <?= $form->field($model, 'title')->dropDownList(Sale::getYesList(), ['prompt' => '']) ?>
                            <?= $form->field($model, 'commission')->textInput(['maxlength' => true]) ?>
                            <?= $form->field($model, 'status')->inline()->radioList(Sale::getStatusList()) ?>
                            <?= $form->field($model, 'top')->inline()->checkbox(['value' => 1]) ?>
                        </div>
                    </div>

                </div>
            </div>

            <div class="row">
                <div class="col-md-8">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title"><?= Yii::t('app', 'Location') ?></h3>
                        </div>
                        <div class="box-body">

                            <div class="row">
                                <div class="col-md-6">
                                    <?= $form->field($model, 'region_id')->dropDownList(Region::getList(), ['id' => 'region_id', 'prompt' => '']) ?>
                                </div>
                                <div class="col-md-6">
                                    <?=
                                    $form->field($model, 'district_id')->widget(DepDrop::classname(), [
                                        'data' => District::getList($model->region_id),
                                        'options'=> ['id' => 'district_id'],
                                        'pluginOptions' => [
                                            'depends' => ['region_id'],
                                            'placeholder' => false,
                                            'url' => Url::to(['/district/list']),
                                        ],
                                        /*'pluginEvents' => [
                                            'change' => 'function(){ console.log(10); }'
                                        ]*/
                                    ]);
                                    ?>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <?= $form->field($model, 'address', ['template' => "{label}\n<div class=\"input-group\">{input}\n<span class=\"input-group-btn\"><button class=\"btn btn-default\" type=\"button\"><span class=\"glyphicon glyphicon-refresh\" aria-hidden=\"true\"></span></button></span></div>\n{hint}\n{error}"])->textInput(['maxlength' => true]) ?>
                                </div>
                                <div class="col-md-6">
                                    <?= $form->field($model, 'gps', ['template' => "{label}\n<div class=\"input-group\">{input}\n<span class=\"input-group-btn\"><button class=\"btn btn-default\" type=\"button\"><span class=\"glyphicon glyphicon-refresh\" aria-hidden=\"true\"></span></button></span></div>\n{hint}\n{error}"])->textInput(['maxlength' => true]) ?>
                                </div>
                            </div>

                            <div id="map_canvas" style="height: 300px; margin-bottom: 20px;"></div>

                            <?= $form->field($model, 'view_ids')->checkBoxList(View::getList()) ?>

                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title"><?= Yii::t('app', 'Extra') ?></h3>
                        </div>
                        <div class="box-body">

                            <div class="row">
                                <div class="col-md-6">
                                    <?= $form->field($model, 'conditioner')->dropDownList(Sale::getYesList(), ['prompt' => '']) ?>
                                </div>
                                <div class="col-md-6">
                                    <?= $form->field($model, 'heating')->dropDownList(Sale::getYesList(), ['prompt' => '']) ?>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <?= $form->field($model, 'sauna')->dropDownList(Sale::getYesList(), ['prompt' => '']) ?>
                                </div>
                                <div class="col-md-6">
                                    <?= $form->field($model, 'pool')->dropDownList(Sale::getYesList(), ['prompt' => '']) ?>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <?= $form->field($model, 'parking_id')->dropDownList($model->parkingList, ['prompt' => '']) ?>
                                </div>
                                <div class="col-md-6">
                                    <?= $form->field($model, 'furniture')->dropDownList(Sale::getYesList(), ['prompt' => '']) ?>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <?= $form->field($model, 'solarpanel')->dropDownList(Sale::getYesList(), ['prompt' => '']) ?>
                                </div>
                                <div class="col-md-6">
                                    <?= $form->field($model, 'tennis')->dropDownList(Sale::getYesList(), ['prompt' => '']) ?>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <?= $form->field($model, 'storage')->dropDownList(Sale::getYesList(), ['prompt' => '']) ?>
                                </div>
                                <div class="col-md-6">

                                </div>
                            </div>

                            <?= $form->field($model, 'facility_ids')->checkBoxList(Facilities::getList()) ?>

                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="col-xs-6 col-md-4">

            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title"><?= Yii::t('app', 'Description') ?></h3>
                </div>
                <div class="box-body">
                    <?php
                    foreach ($model_content as $key => $content) {
                        echo $form->field($content, "[$key]description")->textarea(['rows' => 5])->label(Yii::t('app', 'Lang_'.$key));
                    }
                    ?>
                </div>
            </div>

            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title"><?= Yii::t('app', 'Notes') ?></h3>
                </div>
                <div class="box-body">
                    <?= $form->field($model, 'note_user')->textarea(['rows' => 3]) ?>
                    <?= $form->field($model, 'note_admin')->textarea(['rows' => 3]) ?>
                </div>
            </div>

            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title"><?= Yii::t('app', 'Contact Info') ?></h3>
                </div>
                <div class="box-body">
                    <?= $form->field($model, 'contacts')->textarea(['rows' => 3]) ?>
                    <?= $form->field($model, 'owner')->textarea(['rows' => 3]) ?>
                </div>
            </div>

            <?php if ($model->id): ?>
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title"><?= Yii::t('app', 'Add Attachments') ?></h3>
                </div>
                <div class="box-body">
                    <?php
                        $preview = [];
                        $preview_config = [];
                        foreach($model->files as $item){
                            $preview[] = Html::a($item->name, Url::toRoute(['download/index', 'id' => $item->sale_id, 'name' => $item->name]), ['class' => 'attachment']);
                            $preview_config[] = [
                                'url' => 'delete-file',
                                'key' => $item->id
                            ];
                        }
                        echo FileInput::widget([
                            'name' => 'files',
                            'pluginOptions' => [
                                'uploadUrl' => Url::to(['upload-file']),
                                'showCaption' => false,
                                'showRemove' => false,
                                'showUpload' => false,
                                'overwriteInitial' => false,
                                'dropZoneEnabled' => false,
                                'showClose' => false,
                                'browseClass' => 'btn btn-primary btn-block',
                                'initialPreview' => $preview,
                                'initialPreviewConfig' => $preview_config,
                                'uploadExtraData' => [
                                    'sale_id' => $model->id
                                ]
                            ],
                            'options' => ['multiple' => true]
                        ]);
                    ?>
                </div>
            </div>
            <?php endif; ?>

        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
