<?php
/* @var $this yii\web\View */
use yii\helpers\Url;

?>

<div class="row">
    <div class="col-md-12">

        <a href="<?= Url::to(['aristo', 'url' => 'http://www.aristodevelopers.com/xml', 'lang' => 'en']) ?>" class="btn btn-primary">Aristo (EN)</a>
        <a href="<?= Url::to(['aristo', 'url' => 'http://www.aristodevelopers.com/ru/xml', 'lang' => 'ru']) ?>" class="btn btn-primary">Aristo (RU)</a>

    </div>
</div>

<div class="row">
    <div class="col-md-12">

        <a href="<?= Url::to(['pafilia', 'url' => 'http://api.pafilia.com/feed/datafeed?lang=EN&limit=3000', 'lang' => 'en']) ?>" class="btn btn-primary">Pafilia (EN)</a>
        <a href="<?= Url::to(['pafilia', 'url' => 'http://api.pafilia.com/feed/datafeed?lang=RU&limit=3000', 'lang' => 'ru']) ?>" class="btn btn-primary">Pafilia (RU)</a>

    </div>
</div>