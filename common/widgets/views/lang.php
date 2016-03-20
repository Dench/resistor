<?php

use yii\helpers\Html;

?>
<div id="lang">
    <div id="current-lang">
        <span class="hidden-xs hidden-sm"><?= $current->name;?></span>
        <span class="visible-xs-block visible-sm-block"><?= $current->code;?></span>
    </div><div id="langs">
    <?php foreach ($langs as $lang):?>
        <?= Html::a($lang->name, '/'.$lang->code.Yii::$app->getRequest()->getLangUrl(), ['class' => 'hidden-xs hidden-sm']) ?>
        <?= Html::a($lang->code, '/'.$lang->code.Yii::$app->getRequest()->getLangUrl(), ['class' => 'visible-xs-block visible-sm-block']) ?>
    <?php endforeach;?>
    </div>
</div>