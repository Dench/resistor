<?php

/* @var $this \yii\web\View */
/* @var $content string */

use common\widgets\Alert;
use common\widgets\LangChange;
use frontend\assets\AppAssetIE9;
use frontend\assets\BootstrapSelect;
use frontend\assets\FontAwesome;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Html;
use frontend\assets\AppAsset;
use yii\helpers\Url;

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

<section id="top" class="bg-primary">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-sm-8 col-md-8">
                <?php
                    if (Yii::$app->params['phone1']) {
                        echo '<span><i class="fa fa-phone"></i> '.Yii::$app->params['phone1'].'</span>';
                    }
                    if (Yii::$app->params['phone2']) {
                        echo '<span class="hidden-xs"><i class="fa fa-phone"></i> '.Yii::$app->params['phone2'].'</span>';
                    }
                    if (Yii::$app->params['email']) {
                        echo '<a href="#" class="hidden-xs"><i class="fa fa-envelope"></i> '.Yii::$app->params['email'].'</a>';
                    }
                ?>
            </div>
            <div class="col-xs-3 col-sm-2 col-md-2">
                <?php
                    if (!Yii::$app->user->isGuest) {
                        echo Html::a('<i class="fa fa-user fa-fw"></i> '.Yii::t('app', 'Personal'), Url::toRoute('personal/index'));
                    }
                ?>
            </div>
            <div class="col-xs-3 col-sm-2 col-md-2">
                <?= LangChange::widget() ?>
            </div>
        </div>
    </div>
</section>
<?php
    NavBar::begin([
        'brandLabel' => Html::img('@web/source/img/logo.png', ['alt' => Yii::$app->params['sitename'], 'height' => '100%']),
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-default navbar-static-top',
        ],
    ]);
    $menuItems = [
        ['label' => Yii::t('app', 'Home'), 'url' => ['/'], 'active' => (Yii::$app->controller->id == 'site' && Yii::$app->controller->action->id == 'index')],
        ['label' => Yii::t('app', 'Property search'), 'url' => ['/search'], 'active' => Yii::$app->controller->id == 'search'],
        ['label' => Yii::t('app', 'Agents to'), 'url' => ['/site/agent']],
        ['label' => Yii::t('app', 'About'), 'url' => ['/site/about']],
        ['label' => Yii::t('app', 'Contact'), 'url' => ['/site/contact']],
    ];
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav'],
        'items' => $menuItems,
    ]);
    NavBar::end();
?>

<?= Alert::widget() ?>

<?= $content ?>

<footer class="footer-container">
    <section class="footer-secondary">
        <div class="container">
            <div class="row">
                <div class="col-sm-8">
                    <div class="copy">
                        All Rights Reserved ® <a href="#" target="_blank">Cyprus</a>
                    </div>
                </div>
                <div class="col-sm-4 text-right">
                    <ul class="social-networks">
                        <li><a class="btn btn-twitter" href="#"><i class="fa fa-fw fa-twitter"></i></a></li>
                        <li><a class="btn btn-facebook" href="#"><i class="fa fa-fw fa-facebook"></i></a></li>
                        <li><a class="btn btn-google-plus" href="#"><i class="fa fa-fw fa-google-plus"></i></a></li>
                        <li><a class="btn btn-pinterest" href="#"><i class="fa fa-fw fa-pinterest"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
</footer>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>