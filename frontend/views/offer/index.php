<?php
/** @var $this yii\web\View */
/** @var $model \common\models\Offer */
/** @var $code string */

use frontend\assets\PhotoSwipe;
use yii\helpers\Html;

PhotoSwipe::register($this);

Yii::$app->view->registerJsFile('@web/js/photoswipe.js', ['depends' => 'frontend\assets\PhotoSwipe']);
$script = <<< JS
    initPhotoSwipeFromDOM('.property-gallery');
JS;
Yii::$app->view->registerJs($script, yii\web\View::POS_READY);

?>

<section class="wrapper-md post">
    <div class="container">
        <h1><?= Yii::t('app', 'Offer') ?> <span class="text-uppercase"> - <?= $code ?></span></h1>
        <div class="property-description">
            <?= Html::encode($model->text) ?>
        </div>
        <div class="property-description">
            <div><?= Html::encode($model->name) ?></div>
            <div><?= Html::encode($model->phone1) ?></div>
            <div><?= Html::encode($model->phone2) ?></div>
            <div><?= Html::encode($model->email) ?></div>
        </div>
        <?php foreach ($model->items as $item) : ?>
        <article>
            <h3><?= Html::encode($item->name) ?> (#<?= $item->id ?>)</h3>
            <div class="property-description">
                <?= Html::encode($item->text) ?>
            </div>
            <div class="property-gallery">
                <div class="row">
                    <?php
                    $images = [];
                    foreach ($item->images['thumb'] as $key => $src) {
                        echo Html::a(
                            Html::img($src, ['alt' => $item->name]),
                            $item->images['big'][$key], [
                                'data-size' => '1024x768',
                                'class' => 'col-xs-6 col-sm-4 col-md-3 col-lg-2'
                            ]
                        );
                    }
                    ?>
                </div>
            </div>
        </article>
        <?php endforeach; ?>
    </div>
</section>

<style>
    h1 {
        margin-top: 2rem;
        text-align: center;
    }
    article {
        padding: 5rem 0;
        border-top: 3px solid #736596;
    }
</style>

<!-- Root element of PhotoSwipe. Must have class pswp. -->
<div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">

    <!-- Background of PhotoSwipe.
         It's a separate element as animating opacity is faster than rgba(). -->
    <div class="pswp__bg"></div>

    <!-- Slides wrapper with overflow:hidden. -->
    <div class="pswp__scroll-wrap">

        <!-- Container that holds slides.
            PhotoSwipe keeps only 3 of them in the DOM to save memory.
            Don't modify these 3 pswp__item elements, data is added later on. -->
        <div class="pswp__container">
            <div class="pswp__item"></div>
            <div class="pswp__item"></div>
            <div class="pswp__item"></div>
        </div>

        <!-- Default (PhotoSwipeUI_Default) interface on top of sliding area. Can be changed. -->
        <div class="pswp__ui pswp__ui--hidden">

            <div class="pswp__top-bar">

                <!--  Controls are self-explanatory. Order can be changed. -->

                <div class="pswp__counter"></div>

                <button class="pswp__button pswp__button--close" title="Close (Esc)"></button>

                <button class="pswp__button pswp__button--share" title="Share"></button>

                <button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button>

                <button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button>

                <!-- Preloader demo http://codepen.io/dimsemenov/pen/yyBWoR -->
                <!-- element will get class pswp__preloader--active when preloader is running -->
                <div class="pswp__preloader">
                    <div class="pswp__preloader__icn">
                        <div class="pswp__preloader__cut">
                            <div class="pswp__preloader__donut"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
                <div class="pswp__share-tooltip"></div>
            </div>

            <button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)">
            </button>

            <button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)">
            </button>

            <div class="pswp__caption">
                <div class="pswp__caption__center"></div>
            </div>

        </div>

    </div>

</div>