<?php
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */

?>

<header class="main-header">

    <?= Html::a('<span class="logo-mini">APP</span><span class="logo-lg">' . Yii::$app->name . '</span>', Yii::$app->homeUrl, ['class' => 'logo']) ?>

    <nav class="navbar navbar-static-top" role="navigation">

        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <li><?= Html::a('<i class="fa fa-home"></i>'.Yii::t('app', 'To site'), Yii::$app->params['frontend_home'].'/', ['target' => '_blank']) ?></li>
                <li><?= Html::a('<i class="fa fa-sign-out"></i>'.Yii::t('app', 'Logout'), ['site/logout'], ['data-method' => 'post']) ?></li>
            </ul>
        </div>

    </nav>

</header>
