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
});

$(".dynamicform_wrapper").on("beforeDelete", function(e, item) {
    if (! confirm("{$del_text}")) {
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

<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title pull-left"><?= Yii::t('app', 'Offer') ?></h3>
    </div>
    <div class="box-body">
        <?= $form->field($model, 'text')->textarea(['rows' => 6]) ?>
    </div>
</div>

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

<div class="container-items"><!-- widgetContainer -->
    <?php foreach ($items as $i => $item): ?>
        <div class="item box"><!-- widgetBody -->
            <div class="box-header with-border">
                <h3 class="box-title pull-left"><?= Yii::t('app', 'Object') ?></h3>
                <div class="box-tools pull-right">
                    <button type="button" class="add-item btn btn-success btn-sm"><i class="glyphicon glyphicon-plus"></i></button>
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
                        <div class="row">
                            <div class="col-sm-12">
                                <?= $form->field($item, "[{$i}]name")->textInput(['maxlength' => true]) ?>
                            </div>
                            <div class="col-sm-12">
                                <?php
                                $preview = [];
                                $preview_config = [];
                                echo FileInput::widget([
                                    'name' => "[{$i}]photos",
                                    'pluginOptions' => [
                                        'minImageWidth' => Yii::$app->params['salePhotoMin']['width']/2,
                                        'minImageHeight' => Yii::$app->params['salePhotoMin']['height']/2,
                                        'showCaption' => false,
                                        'showRemove' => false,
                                        //'showUpload' => false,
                                        'overwriteInitial' => false,
                                        'dropZoneEnabled' => false,
                                        'showClose' => false,
                                        'initialPreview' => $preview,
                                        'initialPreviewConfig' => $preview_config,
                                        //'browseClass' => 'btn btn-primary btn-block',
                                        'browseIcon' => '<i class="glyphicon glyphicon-camera"></i> ',
                                        'browseLabel' =>  Yii::t('app', 'Select Photo'),
                                        'allowedFileExtensions' => ['jpg'],
                                        'uploadUrl' => Url::to(['upload-photo']),
                                        'uploadExtraData' => [
                                            'offer_id' => $item->id
                                        ],
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
                    <div class="col-sm-6">
                        <?= $form->field($item, "[{$i}]text")->textarea(['rows' => 5]) ?>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>
<?php DynamicFormWidget::end(); ?>

<div class="box-footer">
    <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
</div>

<?php ActiveForm::end(); ?>
