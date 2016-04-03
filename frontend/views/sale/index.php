<?php
/* @var $this yii\web\View */
use yii\bootstrap\Carousel;
use yii\bootstrap\Html;

$this->title = $model->name;
?>
<section class="wrapper-md post">
    <div class="container">
        <article>
            <h1><?= Html::encode($model->name) ?></h1>
            <div class="row">
                <div class="col-md-9">
                    <div class="row">
                        <div class="col-md-12">
                            <?php
                                if ($model->images['big']) {
                                    $images = [];
                                    foreach ($model->images['big'] as $item) {
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
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="panel panel-secondary">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Features</h3>
                                </div>
                                <div class="panel-body">
                                    <ul class="list-unstyled">
                                        <li><i class="fa fa-fw fa-map-marker"></i> <?= Html::encode($model->region->content->name) ?>, <?= Html::encode($model->district->content->name) ?></li>
                                        <? if ($model->covered): ?>
                                            <li><i class="fa fa-fw fa-th"></i> <strong><?= $model->getAttributeLabel('covered') ?>:</strong> <?= $model->covered ?> m<sup>2</sup></li>
                                        <? endif ?>
                                        <? if ($model->uncovered): ?>
                                            <li><i class="fa fa-fw fa-th"></i> <strong><?= $model->getAttributeLabel('uncovered') ?>:</strong> <?= $model->uncovered ?> m<sup>2</sup></li>
                                        <? endif ?>
                                        <? if ($model->plot): ?>
                                            <li><i class="fa fa-fw fa-th"></i> <strong><?= $model->getAttributeLabel('plot') ?>:</strong> <?= $model->plot ?> m<sup>2</sup></li>
                                        <? endif ?>
                                        <? if ($model->year): ?>
                                            <li><i class="fa fa-fw fa-calendar"></i> <strong><?= $model->getAttributeLabel('year') ?>:</strong> <?= $model->year ?></li>
                                        <? endif ?>
                                        <? if ($model->bedroom): ?>
                                            <li><i class="fa fa-fw fa-columns"></i> <strong><?= $model->getAttributeLabel('bedroom') ?>:</strong> <?= $model->bedroom ?></li>
                                        <? endif ?>
                                        <? if ($model->year): ?>
                                            <li><i class="fa fa-fw fa-female"></i> <strong><?= $model->getAttributeLabel('bathroom') ?>:</strong> <?= $model->bathroom ?></li>
                                        <? endif ?>
                                        <? if ($model->parking): ?>
                                            <li><i class="fa fa-fw fa-truck"></i> <strong><?= $model->getAttributeLabel('parking_id') ?>:</strong> <?= $model->parking ?></li>
                                        <? endif ?>
                                        <? if ($model->price): ?>
                                            <li><i class="fa fa-fw fa-eur"></i> <strong><?= $model->getAttributeLabel('price') ?>:</strong> <?= number_format($model->price, 0, ',', '.') ?></li>
                                        <? endif ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="panel panel-secondary">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Description</h3>
                                </div>
                                <div class="panel-body">
                                    <p><?= nl2br(Html::encode($model->content->description)) ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="panel panel-secondary">
                        <div class="panel-heading">
                            <h3 class="panel-title">Contact By Email</h3>
                        </div>
                        <div class="panel-body">
                            <form role="form">
                                <div class="form-group">
                                    <label for="exmaple-contact-email">Email address</label>
                                    <input type="email" class="form-control" id="exmaple-contact-email" placeholder="Enter email">
                                </div>
                                <div class="form-group">
                                    <label for="example-contact-name">Name</label>
                                    <input type="text" class="form-control" id="example-contact-name" placeholder="Your name">
                                </div>
                                <div class="form-group">
                                    <label for="example-contact-message">Message</label>
                                    <textarea id="example-contact-message" class="form-control" rows="4"></textarea>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox"> Send me a copy
                                    </label>
                                </div>
                                <button type="submit" class="btn btn-primary">Send Message</button>
                            </form>
                        </div>
                    </div>
                    <div class="tools">
                        <h3 class="h4">User Tools:</h3>
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