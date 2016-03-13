<?php
/** @var $item frontend\components\SaleItem */

use yii\helpers\Html;

?>
<div class="<?= $item->col ?>">
    <div class="thumbnail text-default">
        <div class="overlay-container">
            <img src="<?= $item->cover ?>">
            <div class="overlay-content">
                <h3 class="h4 headline"><?= Html::encode($item->name) ?></h3>
                <p><?= Html::encode($item->region) ?>, <?= Html::encode($item->district) ?></p>
            </div>
        </div>
        <div class="thumbnail-meta">
            <p><i class="fa fa-fw fa-home"></i> <?= Html::encode($item->name) ?></p>
            <p><i class="fa fa-fw fa-map-marker"></i> <?= $item->region ?>, <?= $item->district ?></p>
        </div>
        <div class="thumbnail-meta">
            <i class="fa fa-fw fa-info-circle"></i> <?= $item->bedroom ?> <?= Yii::t('app', 'Bedrooms') ?> | <?= $item->bathroom ?> <?= Yii::t('app', 'Bathrooms') ?>
        </div>
        <div class="thumbnail-meta">
            <i class="fa fa-fw fa-dollar"></i> <span class="h3 heading-default"><?= number_format($item->price, 0, ',', '.') ?></span> <a href="<?= $item->url ?>" class="btn btn-link pull-right" rel="nofollow"><?= Yii::t('app', 'View') ?> <i class="fa fa-arrow-right"></i></a>
        </div>
    </div>
</div>