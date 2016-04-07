<?php
/* @var $this yii\web\View */

use backend\assets\MapAsset;

MapAsset::register($this);

$script = <<< JS
    $(function(){
        saleMarkers(-1);
    });
JS;

$this->registerJs($script, yii\web\View::POS_READY);
?>

<div class="box">
    <div class="box-body">
        <div id="map_canvas" style="height: 70vh;"></div>
    </div>
</div>