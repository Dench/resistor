<?php

/* @var $this \yii\web\View */
/* @var $content string */

use common\widgets\Alert;
use frontend\assets\AppAssetIE9;
use frontend\assets\BootstrapSelect;
use frontend\assets\FontAwesome;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Html;
use frontend\assets\AppAsset;

AppAsset::register($this);
AppAssetIE9::register($this);
BootstrapSelect::register($this);
FontAwesome::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>

<body>
<?php $this->beginBody() ?>
<?php
    NavBar::begin([
        'brandLabel' => Html::img('@web/images/logo.jpg', ['alt' => Yii::$app->params['sitename']]),
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-default navbar-static-top',
        ],
    ]);
    $menuItems = [
        ['label' => Yii::t('app', 'Home'), 'url' => ['/site/index']],
        [
            'label' => Yii::t('app', 'Real Estate'),
            'url' => ['/site/contact'],
            'items' => [
                ['label' => Yii::t('app', 'Search Results'), 'url' => ['/site/about']],
                ['label' => Yii::t('app', 'Item Page'), 'url' => ['/site/about']],
                ['label' => Yii::t('app', 'Services'), 'url' => ['/site/about']],
                ['label' => Yii::t('app', 'Gallery'), 'url' => ['/site/about']],
            ]
        ],
        [
            'label' => Yii::t('app', 'Agents'),
            'url' => ['/site/contact'],
            'items' => [
                ['label' => Yii::t('app', 'All Agents'), 'url' => ['/site/about']],
                ['label' => Yii::t('app', 'Agent Profile'), 'url' => ['/site/about']],
            ]
        ],
        [
            'label' => Yii::t('app', 'Corporate'),
            'url' => ['/site/contact'],
            'items' => [
                ['label' => Yii::t('app', 'About'), 'url' => ['/site/about']],
                ['label' => Yii::t('app', 'Contact'), 'url' => ['/site/about']],
            ]
        ],
    ];
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav'],
        'items' => $menuItems,
    ]);
    NavBar::end();
?>

<?= Alert::widget() ?>

<?= $content ?>

<!-- Footer -->
<footer class="footer-container">
    <section class="footer-primary">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-md-3">
                    <h3>Footer Component</h3>
                    <p>Choose from our favourite tags:</p>
                    <ul class="tags">
                        <li><a href="#link">design</a></li>
                        <li><a href="#link">layout</a></li>
                        <li><a href="#link">stack</a></li>
                        <li><a href="#link">PSD</a></li>
                        <li><a href="#link">bootstrap</a></li>
                        <li><a href="#link">menu</a></li>
                        <li><a href="#link">type</a></li>
                        <li><a href="#link">paper</a></li>
                        <li><a href="#link">press</a></li>
                    </ul>
                </div><!-- /.col -->
                <div class="col-sm-6 col-md-3">
                    <h3>Image Stream List</h3>
                    <p>View our latest stills in Flicker:</p>
                    <ul class="img-stream">
                        <li><a href="#link"><img class="media-object" data-src="holder.js/55x55" alt="img"></a></li>
                        <li><a href="#link"><img class="media-object" data-src="holder.js/55x55" alt="img"></a></li>
                        <li><a href="#link"><img class="media-object" data-src="holder.js/55x55" alt="img"></a></li>
                        <li><a href="#link"><img class="media-object" data-src="holder.js/55x55" alt="img"></a></li>
                        <li><a href="#link"><img class="media-object" data-src="holder.js/55x55" alt="img"></a></li>
                        <li><a href="#link"><img class="media-object" data-src="holder.js/55x55" alt="img"></a></li>
                        <li><a href="#link"><img class="media-object" data-src="holder.js/55x55" alt="img"></a></li>
                        <li><a href="#link"><img class="media-object" data-src="holder.js/55x55" alt="img"></a></li>
                    </ul>
                </div><!-- /.col -->
                <div class="col-sm-6 col-md-3">
                    <h3>Hyperlinks List</h3>
                    <p>Contact us whenever you want:</p>
                    <ul class="list-unstyled">
                        <li><i class="fa fa-angle-right"></i> <a href="#link">9am-6pm ET Mon-Fri</a></li>
                        <li><i class="fa fa-angle-right"></i> <a href="#link">US (877) 977-8732</a></li>
                        <li><i class="fa fa-angle-right"></i> <a href="#link">International +1 646 490 1679</a></li>
                    </ul>
                </div><!-- /.col -->
                <div class="col-sm-6 col-md-3">
                    <h3>Social Media List</h3>
                    <p>Stick to the social media hype:</p>
                    <ul class="social-networks">
                        <li><a class="btn btn-twitter" href="#"><i class="fa fa-fw fa-twitter"></i></a></li>
                        <li><a class="btn btn-facebook" href="#"><i class="fa fa-fw fa-facebook"></i></a></li>
                        <li><a class="btn btn-google-plus" href="#"><i class="fa fa-fw fa-google-plus"></i></a></li>
                        <li><a class="btn btn-pinterest" href="#"><i class="fa fa-fw fa-pinterest"></i></a></li>
                    </ul>
                    <p>We are friendly. Give us a ding!</p>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container -->
    </section><!-- /.wrapper-sm -->
    <section class="footer-secondary">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <p class="no-margin-bottom">All Rights Reserved ® Designed by <a href="http://twitter.com/graphikaria" target="_blank">@Graphikaria</a></p>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container -->
    </section><!-- /.footer-secondary -->
</footer><!-- /.footer-container --> <!-- End of footer -->
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>