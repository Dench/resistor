<?php
/** @var $item frontend\widgets\SaleItem */

use yii\helpers\Html;

?>
<div class="<?= $item->col ?>" onclick="goto($(this));">
    <div class="thumbnail text-default">
        <div class="overlay-container">
            <?php
                if ($item->cover) {
                    echo Html::img($item->cover, ['alt' => $item->name]);
                } else {
                    echo Html::img(Yii::$app->params['image_none']['small']);
                }
            ?>
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
            <i class="fa fa-fw fa-info-circle"></i> <?= Yii::t('app', 'Bedrooms') ?>: <?= $item->bedroom ?> | <?= Yii::t('app', 'Bath') ?>: <?= $item->bathroom ?>
        </div>
        <div class="thumbnail-meta">
            <i class="fa fa-fw fa-eur"></i> <span class="h3 heading-default"><?= number_format($item->price, 0, ',', '.') ?></span> <a href="<?= $item->url ?>" class="btn btn-link pull-right" rel="nofollow"><?= Yii::t('app', 'View') ?> <i class="fa fa-arrow-right"></i></a>
        </div>
    </div>
</div>