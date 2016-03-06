<?php
/* @var $this yii\web\View */
use yii\bootstrap\Carousel;

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
                        foreach ($model->photos as $item) {

                        }
                        echo Carousel::widget([
                            'items' => [
                                ['content' => '<img src="/assets/img/slide-1.jpg"/>'],
                                ['content' => '<img src="/assets/img/slide-1.jpg"/>'],
                                ['content' => '<img src="/assets/img/slide-1.jpg"/>'],
                            ],
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

                    <h2><i class="fa fa-map-marker"></i> 294 River Road, <span class="text-muted">Windsor CA, 95492</span></h2>
                    <p class="lead">Welcome to Grand Lagoon. This home offers a great family comfort.</p>

                    <hr>

                    <div class="row">
                        <div class="col-sm-12 col-md-5">
                            <div class="widget padding-md bg-secondary">
                                <h3 class="headline">Features:</h3>
                                <ul class="list-unstyled">
                                    <li><i class="fa fa-fw fa-th"></i> <strong>Property:</strong> 1.460 Ft<sup>2</sup></li>
                                    <li><i class="fa fa-fw fa-calendar"></i> <strong>Year Built:</strong> 1890</li>
                                    <li><i class="fa fa-fw fa-columns"></i> <strong>Bedrooms:</strong> 2</li>
                                    <li><i class="fa fa-fw fa-female"></i> <strong>Bathrooms:</strong> 1.5</li>
                                    <li><i class="fa fa-fw fa-truck"></i> <strong>Garage:</strong> 2 Spots</li>
                                    <li><i class="fa fa-fw fa-signal"></i> <strong>Internet:</strong> Wireless</li>
                                    <li><i class="fa fa-fw fa-fire"></i> <strong>Heating Type:</strong> Forced air</li>
                                    <li><i class="fa fa-fw fa-briefcase"></i> <strong>Last Sold:</strong> May 2006, for $106.000</li>
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

                    <div class="panel panel-secondary">
                        <div class="panel-heading">
                            <h3 class="panel-title">Contact agent</h3>
                        </div>
                        <div class="panel-body padding-md">
                            <div class="row">
                                <div class="col-sm-12 col-md-6">
                                    <h3>Agent details</h3>
                                    <div class="media">
                                        <a class="pull-left" href="#"><img class="media-object" src="/assets/img/user.jpg" width="64" height="64" alt="64x64"></a>
                                        <div class="media-body">
                                            <h4 class="media-heading">Troy J. Myers</h4>
                                            <ul class="list-unstyled">
                                                <li><i class="fa fa-fw fa-building-o"></i> <strong>Company:</strong> Graphikaria</li>
                                                <li><i class="fa fa-fw fa-phone"></i> <strong>Phone:</strong> 940-689-5799</li>
                                                <li><i class="fa fa-fw fa-mobile"></i> <strong>Mobile:</strong> 549-689-5710</li>
                                                <li><i class="fa fa-fw fa-map-marker"></i> <strong>Address:</strong> 1728 Olen Thomas Drive</li>
                                                <li><i class="fa fa-fw fa-globe"></i> <strong>Website:</strong> <a href="#link">www.graphikaria.com</a></li>
                                            </ul>
                                        </div><!-- /.media-body -->
                                    </div><!-- /.media -->
                                </div><!-- /.col -->
                                <div class="col-sm-12 col-md-6">
                                    <h3>Contact by email</h3>
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
                                            <textarea id="example-contact-message" class="form-control" rows="5"></textarea>
                                        </div>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox"> Send me a copy
                                            </label>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Send Message</button>
                                    </form>
                                </div><!-- /.col -->
                            </div><!-- /.row -->
                        </div><!-- /.panel-body -->
                    </div><!-- /.panel -->

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