<?php

use yii\helpers\Html;

?>
<span id="lang">
    <span id="current-lang">
        <?= $current->name;?>
    </span>
    <span id="langs">
    <?php foreach ($langs as $lang):?>
        <?= Html::a($lang->name, '/'.$lang->code.Yii::$app->getRequest()->getLangUrl()) ?>
    <?php endforeach;?>
    </span>
</span>