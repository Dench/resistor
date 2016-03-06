<?php
/* @var $this yii\web\View */
use yii\bootstrap\Carousel;
use yii\bootstrap\Html;

$this->title = $model->name;
?>
<section class="wrapper-md bg-">
    <div class="container">
        <div class="row">
            <!-- Main -->
            <div class="col-sm-12 col-md-9">
                <article class="post">
                    <?php
                        $images = [];
                        foreach ($model->images['small'] as $item) {
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
                    ?>

                    <h2><i class="fa fa-map-marker"></i> <?= $model->name ?>, <span class="text-muted">Windsor CA, 95492</span></h2>
                    <p class="lead">Welcome to Grand Lagoon. This home offers a great family comfort.</p>

                    <hr>

                    <div class="row">
                        <div class="col-sm-12 col-md-5">
                            <div class="widget padding-md bg-secondary">
                                <h3 class="headline">Features:</h3>
                                <ul class="list-unstyled">
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
                                        <li><i class="fa fa-fw fa-truck"></i> <strong><?= $model->getAttributeLabel('parking') ?>:</strong> <?= $model->parking_list[$model->parking] ?></li>
                                    <? endif ?>
                                    <? if ($model->price): ?>
                                        <li><i class="fa fa-fw fa-briefcase"></i> <strong><?= $model->getAttributeLabel('price') ?>:</strong> <?= $model->price ?></li>
                                    <? endif ?>
                                </ul>
                            </div><!-- /.widget -->
                        </div><!-- /.col -->
                        <div class="col-sm-12 col-md-7">
                            <div class="panel panel-secondary">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Description</h3>
                                </div>
                                <div class="panel-body">
                                    <p><?= nl2br($model->content->description) ?></p>
                                </div><!-- /.panel-body -->
                            </div><!-- /.panel -->
                            <h3 class="h4">User Tools:</h3>
                            <p>
                                <a href="#link" class="btn btn-primary"><i class="fa fa-envelope"></i> Email to a friend</a>
                                <a href="#link" class="btn btn-facebook"><i class="fa fa-facebook"></i> Share</a>
                                <a href="#link" class="btn btn-twitter"><i class="fa fa-twitter"></i> Share</a>
                            </p>
                            <p>
                                <a href="#link" class="btn btn-default"><i class="fa fa-bookmark"></i> Bookmark</a>
                                <a href="#link" class="btn btn-default"><i class="fa fa-print"></i> Print</a>
                                <a href="#link" class="btn btn-default"><i class="fa fa-bell"></i> Get notified</a>
                            </p>
                        </div><!-- /.col -->
                    </div><!-- /.row -->

                </article><!-- /.post -->
            </div><!-- /.col -->
            <!-- End of main -->

            <!-- Sidebar -->
            <div class="col-sm-12 col-md-3">
                <div class="panel panel-secondary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Social Networks</h3>
                    </div>
                    <div class="panel-body">
                        <ul class="social-networks">
                            <li><a class="btn btn-twitter" href="#"><i class="fa fa-fw fa-twitter"></i></a></li>
                            <li><a class="btn btn-facebook" href="#"><i class="fa fa-fw fa-facebook"></i></a></li>
                            <li><a class="btn btn-google-plus" href="#"><i class="fa fa-fw fa-google-plus"></i></a></li>
                            <li><a class="btn btn-pinterest" href="#"><i class="fa fa-fw fa-pinterest"></i></a></li>
                        </ul>
                    </div>
                </div><!-- /.panel -->
                <div class="panel panel-secondary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Search</h3>
                    </div>
                    <div class="panel-body">
                        <form action="" role="form">
                            <label class="sr-only" for="example-search">Sidebar Search</label>
                            <input type="text" class="form-control" id="example-search" placeholder="Search blog">
                        </form>
                    </div>
                </div><!-- /.panel -->
                <div class="panel panel-secondary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Text Widget</h3>
                    </div>
                    <div class="panel-body">
                        <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don’t look even slightly believable.</p>
                    </div>
                </div><!-- /.panel -->
                <div class="panel panel-secondary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Taxonomy</h3>
                    </div>
                    <div class="panel-body">
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
                    </div>
                </div><!-- /.panel -->
                <div class="widget">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab-1" data-toggle="tab">Popular</a></li>
                        <li><a href="#tab-2" data-toggle="tab">Recent</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade active in" id="tab-1">
                            <ul class="list-unstyled">
                                <li><h3 class="h5"><i class="fa fa-file-text-o"></i> <a href="#link">Efficiently Modifying Posts</a></h3></li>
                                <li><h3 class="h5"><i class="fa fa-file-text-o"></i> <a href="#link">Taxonomy Regulation</a></h3></li>
                                <li><h3 class="h5"><i class="fa fa-file-text-o"></i> <a href="#link">7 Things You Love</a></h3></li>
                                <li><h3 class="h5"><i class="fa fa-file-text-o"></i> <a href="#link">Why I Love Jazz Music</a></h3></li>
                                <li><h3 class="h5"><i class="fa fa-file-text-o"></i> <a href="#link">Learn The Basics Of Muse</a></h3></li>
                                <li><h3 class="h5"><i class="fa fa-file-text-o"></i> <a href="#link">Start A New Business</a></h3></li>
                            </ul>
                        </div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane fade" id="tab-2">
                            <ul class="list-unstyled">
                                <li>
                                    <h3 class="h5"><i class="fa fa-comment-o"></i> <a href="#link">Efficiently Modifying Posts</a></h3>
                                    <p>Color manipulation in Photoshop can be used to correct mistakes...</p>
                                </li>
                                <li>
                                    <h3 class="h5"><i class="fa fa-comment-o"></i> <a href="#link">Taxonomy Regulation</a></h3>
                                    <p>You can’t design without type. However, you can use only type (or mostly only type)...</p>
                                </li>
                                <li>
                                    <h3 class="h5"><i class="fa fa-comment-o"></i> <a href="#link">7 Things You Love</a></h3>
                                    <p>Continuing from Part 1, let’s extend into tools for linting, measuring performance, checking for...</p>
                                </li>
                            </ul>
                        </div><!-- /.tab-pane -->
                    </div><!-- /.tab-content -->
                </div><!-- /.widget -->
                <div class="widget">
                    <h3 class="h5">Advertising</h3>
                    <ul class="img-stream">
                        <li><a href="#link"><img class="media-object" data-src="holder.js/125x125/#2A2F37:#ffffff" alt="img"></a></li>
                        <li><a href="#link"><img class="media-object" data-src="holder.js/125x125/#2A2F37:#ffffff" alt="img"></a></li>
                        <li><a href="#link"><img class="media-object" data-src="holder.js/125x125/#2A2F37:#ffffff" alt="img"></a></li>
                        <li><a href="#link"><img class="media-object" data-src="holder.js/125x125/#2A2F37:#ffffff" alt="img"></a></li>
                        <li><a href="#link"><img class="media-object" data-src="holder.js/125x125/#2A2F37:#ffffff" alt="img"></a></li>
                        <li><a href="#link"><img class="media-object" data-src="holder.js/125x125/#2A2F37:#ffffff" alt="img"></a></li>
                    </ul>
                </div><!-- /.widget -->
            </div><!-- /.col --> <!-- End of sidebar -->
        </div><!-- /.row -->
    </div><!-- /.container -->
</section>