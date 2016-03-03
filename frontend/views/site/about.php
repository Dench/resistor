<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = Yii::t('app', 'TITLE_ABOUT');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>This is the About page. You may modify the following file to customize its content:</p>

    <code><?= __FILE__ ?></code>

    <?php if (!Yii::$app->user->identity->group_id): ?>
        <h1>Guest</h1>
    <?php endif ?>

    <?php if (Yii::$app->user->identity->group_id == 1): ?>
        <h1>Admin</h1>
    <?php endif ?>

    <?php if (Yii::$app->user->identity->group_id > 0): ?>
        <h1>User</h1>
    <?php endif ?>

</div>
