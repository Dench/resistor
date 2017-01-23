<?php
/* @var $this yii\web\View */
/* @var $model common\models\Offer */
/* @var $items common\models\OfferItem[] */
/* @var $form yii\widgets\ActiveForm */

use kartik\file\FileInput;
use wbraganca\dynamicform\DynamicFormWidget;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

$del_text = Yii::t('yii', 'Are you sure you want to delete this item?');

$js = <<<JS
$(".dynamicform_wrapper").on("beforeInsert", function(e, item) {
    console.log("beforeInsert");
});

$(".dynamicform_wrapper").on("afterInsert", function(e, item) {
    console.log("afterInsert");
    eventFile($('input[type="file"]'));
    $('.file-input').last().addClass('file-input-new').find('.file-initial-thumbs').empty();
});
eventFile($('input[type="file"]'));
function eventFile(obj) {
    obj.on('fileloaded', function(event, file, previewId, index, reader) {
        obj.fileinput('upload');
    });
    obj.on('fileuploaded', function(event, data, previewId, index) {
        var inputHidden = $('<input>')
            .attr('type', 'hidden')
            .attr('name', 'FileId['+data.response.index+'][]')
            .val(data.response.file_id);
        $('#'+previewId).append(inputHidden);
    });
    obj.on('filedeleted', function(event, key) {
        $('input[type="hidden"]').each(function(){
            if ($(this).val() == key) {
                $(this).remove();
            }
        })
    });
}

$(".dynamicform_wrapper").on("beforeDelete", function(e, item) {
    if (!confirm("{$del_text}")) {
        return false;
    }
    return true;
});

$(".dynamicform_wrapper").on("afterDelete", function(e) {
    console.log("Deleted item!");
});

$(".dynamicform_wrapper").on("limitReached", function(e, item) {
    alert("Limit reached");
});
JS;

$this->registerJs($js);
?>

<?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>

<?php DynamicFormWidget::begin([
    'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
    'widgetBody' => '.container-items', // required: css class selector
    'widgetItem' => '.item', // required: css class
    'limit' => 999, // the maximum times, an element can be cloned (default 999)
    'min' => 1, // 0 or 1 (default 1)
    'insertButton' => '.add-item', // css class
    'deleteButton' => '.remove-item', // css class
    'model' => $items[0],
    'formId' => 'dynamic-form',
    'formFields' => [
        'name',
        'text',
    ],
]); ?>

<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title pull-left"><?= Yii::t('app', 'Offer') ?></h3>
    </div>
    <div class="box-body row">
        <div class="col-md-6">
            <?= $form->field($model, 'text')->textarea(['rows' => 8]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

            <div class="row">
                <div class="col-md-6">
                    <?= $form->field($model, 'phone1')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-6">
                    <?= $form->field($model, 'phone2')->textInput(['maxlength' => true]) ?>
                </div>
            </div>

            <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
</div>

<div class="container-items"><!-- widgetContainer -->
    <?php foreach ($items as $i => $item): ?>
        <div class="item box"><!-- widgetBody -->
            <div class="box-header with-border">
                <h3 class="box-title pull-left"><?= Yii::t('app', 'Object') ?></h3>
                <div class="box-tools pull-right">
                    <button type="button" class="remove-item btn btn-danger btn-sm"><i class="glyphicon glyphicon-minus"></i></button>
                </div>
            </div>
            <div class="box-body">
                <?php
                // necessary for update action.
                if (! $item->isNewRecord) {
                    echo Html::activeHiddenInput($item, "[{$i}]id");
                }
                ?>
                <div class="row">
                    <div class="col-sm-6">
                        <?= $form->field($item, "[{$i}]name")->textInput(['maxlength' => true]) ?>
                        <?= $form->field($item, "[{$i}]text")->textarea(['rows' => 5]) ?>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group field-offeritem-0-text">
                            <label class="control-label" for="offeritem-0-text"><?= Yii::t('app', 'Photos') ?></label>

                        <?php
                        $preview = [];
                        $preview_config = [];
                        foreach($item->photos as $it){
                            $preview[] = Html::img(Yii::$app->params['http'].Yii::$app->params['offerPhotoThumb']['path'].$it->id.'.jpg', ['height' => '160']);
                            $preview_config[] = [
                                'url' => 'delete-photo',
                                'key' => $it->id,
                                'caption' => '<input type="hidden" name="FileId['.$i.'][]" value="'.$it->id.'">'
                            ];
                        }

                        echo FileInput::widget([
                            'name' => "Files[{$i}][file]",
                            'pluginOptions' => [
                                'minImageWidth' => Yii::$app->params['offerPhotoMin']['width']/2,
                                'minImageHeight' => Yii::$app->params['offerPhotoMin']['height']/2,
                                'overwriteInitial' => false,
                                'dropZoneEnabled' => false,
                                'showClose' => false,
                                'showCaption' => false,
                                'showRemove' => false,
                                'showUpload' => false,
                                'initialPreview' => $preview,
                                'initialPreviewConfig' => $preview_config,
                                'browseIcon' => '<i class="glyphicon glyphicon-camera"></i> ',
                                'browseLabel' =>  Yii::t('app', 'Select Photo'),
                                'allowedFileExtensions' => ['jpg'],
                                'uploadUrl' => Url::to(['upload-photo']),
                                'uploadExtraData' => [
                                ],
                                'fileActionSettings' => [
                                    'showZoom' => false,
                                ],
                                'layoutTemplates' => [
                                    'modalMain' => false,
                                ],
                            ],
                            'pluginEvents' => [
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
            </div>
        </div>
    <?php endforeach; ?>
</div>

<div class="box-footer">
    <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    <?= Html::button('<i class="glyphicon glyphicon-plus"></i> '.Yii::t('app', 'Add object'), ['class' => 'add-item btn btn-danger']) ?>
</div>

<?php DynamicFormWidget::end(); ?>

<?php ActiveForm::end(); ?>