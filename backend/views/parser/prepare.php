<?php
/* @var $this yii\web\View */
/** @var $items array */

use backend\widgets\PrepareItem;
use yii\bootstrap\Html;
use yii\helpers\Url;

$to_send = Url::to(['send']);
$to_photo = Url::to(['photo']);
$count = count($items);
$js = <<<JS
var automatic = false;
var num = 1;
$('#submitAll').click(function() {
    automatic = true;
    $(this).hide();
    $('form.item').first().submit();
});
$('form.item').on('beforeSubmit', function() {
    var form = $(this);
    $.post('{$to_send}', form.serialize(), function(data) {
        if (data) {
            savePhoto(form, 0);
        } else {
            form.parents('.box').addClass('box-danger');
            nextItem(form);
        }
    });
    return false;
});
function progress(n) {
    var percent = Math.ceil(n/{$count}*100);
    $('.progress-bar').width(percent + '%').text(percent + '%');
}
function nextItem(form) {
    if (automatic) {
        progress(num++);
        form.parents('.box').next('.box').find('form.item').submit();
    }
}
function savePhoto(form, n) {
    var len = form.find('.photo').length;
    $.post('{$to_photo}', form.find('.photo').eq(n).serialize() + '&id=' + form.attr('id').replace('p', ''), function(data) {
        //console.log(data);
        if (len == n) {
            form.parents('.box').fadeOut();
            nextItem(form);
        } else {
            savePhoto(form, n+1);
        }
    });
}
$('select').change(function() {
    if (this.dataset.value) {
        if (confirm("Create an alias?")) {
            window.open("/alias/create?category=district&name=" + this.dataset.value + "&id=" + $(this).val());
        }
    }
});
JS;

$this->registerJs($js);

?>

<?= Html::button(Yii::t('app', 'Send'), ['class' => 'btn btn-primary btn-lg', 'id' => 'submitAll']) ?>

<div class="progress">
    <div class="progress-bar progress-bar-success"></div>
</div>

<?php foreach ($items as $item): ?>

    <?= PrepareItem::widget([
        'sale' => $item['sale'],
        'content' => $item['content'],
        'image' => $item['image'],
        'origin' => $item['origin'],
        'parse' => $item['parse']
    ]) ?>

<?php endforeach; ?>