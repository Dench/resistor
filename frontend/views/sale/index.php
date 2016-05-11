<?php
/* @var $this yii\web\View */
use frontend\assets\PhotoSwipe;
use yii\bootstrap\Carousel;
use yii\bootstrap\Html;

PhotoSwipe::register($this);

Yii::$app->view->registerJsFile('@web/js/photoswipe.js', ['depends' => 'frontend\assets\PhotoSwipe']);
$script = <<< JS
    initPhotoSwipeFromDOM('.property-gallery');
JS;
Yii::$app->view->registerJs($script, yii\web\View::POS_READY);

$this->title = $model->name;
?>
<section class="wrapper-md post">
    <div class="container">
        <article>
            <h1><?= Html::encode($model->name) ?></h1>
            <div class="row">
                <div class="col-lg-9">
                    <?php
                    if ($model->images['slider']) {
                        $images = [];
                        foreach ($model->images['slider'] as $item) {
                            $images[] = Html::img($item, ['alt' => $model->name]);
                        }
                        echo Carousel::widget([
                            'items' => $images,
                            'id' => 'my-carousel',
                            'controls' => [
                                '<span class="glyphicon glyphicon-chevron-left"></span>',
                                '<span class="glyphicon glyphicon-chevron-right"></span>'
                            ],
                            'options' => [
                                'class' => 'slide'
                            ]
                        ]);
                    }
                    ?>
                </div>
                <div class="col-lg-3">
                    <div class="row property-main">
                        <div class="col-xs-5 col-sm-3 col-md-3 col-lg-12 property-id">
                            Property ID: <?= $model->code ?>
                        </div>
                        <div class="col-xs-7 col-sm-4 col-md-3 col-lg-12 property-price">
                            Current Price: <span>€ <?= number_format($model->price, 0, '.', ',') ?></span>
                        </div>
                        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-12 property-contact hidden-xs">
                            <div class="row">
                                <div class="col-xs-4 col-sm-3 col-md-3 col-lg-12 text-primary">
                                    <i class="fa fa-phone"></i>
                                </div>
                                <div class="col-xs-8 col-sm-9 col-md-9 col-lg-12">
                                    <div class="property-phone">
                                        +357 (99) 11-96-52
                                    </div>
                                    <div class="property-phone">
                                        +38 (067) 0-100-500
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 col-lg-12 hidden-sm hidden-xs">
                            <a href="#">Send messenge</a>
                        </div>
                    </div>
                </div>
            </div>
            <ul class="row property-list list-unstyled">
                <ul class="col-lg-4 list-unstyled">
                    <li>
                        <i class="fa fa-fw fa-map-marker"></i> <?= Html::encode($model->region->content->name) ?>, <?= Html::encode($model->district->content->name) ?>
                    </li>
                    <?php if ($model->covered): ?>
                        <li><i class="fa fa-fw fa-th"></i> <strong><?= $model->getAttributeLabel('covered') ?>:</strong> <?= $model->covered ?> m<sup>2</sup></li>
                    <?php endif ?>
                    <?php if ($model->uncovered): ?>
                        <li><i class="fa fa-fw fa-th"></i> <strong><?= $model->getAttributeLabel('uncovered') ?>:</strong> <?= $model->uncovered ?> m<sup>2</sup></li>
                    <?php endif ?>
                    <?php if ($model->plot): ?>
                        <li><i class="fa fa-fw fa-th"></i> <strong><?= $model->getAttributeLabel('plot') ?>:</strong> <?= $model->plot ?> m<sup>2</sup></li>
                    <?php endif ?>
                    <?php if ($model->year): ?>
                        <li><i class="fa fa-fw fa-calendar"></i> <strong><?= $model->getAttributeLabel('year') ?>:</strong> <?= $model->year ?></li>
                    <?php endif ?>
                </ul>
                <ul class="col-lg-4 list-unstyled">
                    <?php if ($model->bedroom): ?>
                        <li><i class="fa fa-fw fa-columns"></i> <strong><?= $model->getAttributeLabel('bedroom') ?>:</strong> <?= $model->bedroom ?></li>
                    <?php endif ?>
                    <?php if ($model->year): ?>
                        <li><i class="fa fa-fw fa-female"></i> <strong><?= $model->getAttributeLabel('bathroom') ?>:</strong> <?= $model->bathroom ?></li>
                    <?php endif ?>
                    <?php if ($model->parking): ?>
                        <li><i class="fa fa-fw fa-truck"></i> <strong><?= $model->getAttributeLabel('parking_id') ?>:</strong> <?= $model->parking ?></li>
                    <?php endif ?>
                </ul>
            </ul>
            <?php if ($model->content->description): ?>
            <div class="row property-description">
                <div class="col-lg-12">
                    <div class="h2">Description</div>
                    <?= nl2br(Html::encode($model->content->description)) ?>
                </div>
            </div>
            <?php endif ?>
            <div class="row property-gallery">
                    <?php
                    if ($model->images['thumb']) {
                        $images = [];
                        foreach ($model->images['thumb'] as $key => $item) {
                            echo Html::a(Html::img($item, ['alt' => $model->name]), $model->images['big'][$key], ['data-size' => '1024x768', 'class' => 'col-xs-6 col-sm-4 col-md-3 col-lg-2']);
                        }
                    }
                    ?>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="tools">
                        <a href="#link" class="btn btn-primary"><i class="fa fa-envelope"></i> Email to a friend</a>
                        <a href="#link" class="btn btn-facebook"><i class="fa fa-facebook"></i> Share</a>
                        <a href="#link" class="btn btn-twitter"><i class="fa fa-twitter"></i> Share</a>
                        <a href="#link" class="btn btn-default"><i class="fa fa-bookmark"></i> Bookmark</a>
                        <a href="#link" class="btn btn-default"><i class="fa fa-print"></i> Print</a>
                    </div>
                </div>
            </div>
        </article>
    </div>
</section>



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