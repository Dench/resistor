<?php

use yii\helpers\Html;
use yii\helpers\Url;

?>

<div class="row">
    <article class="post">
        <div class="col-sm-12 col-md-5">
            <a href="<?= Url::toRoute(['sale/index', 'id' => $model->id]) ?>"><img class="img-responsive img-thumbnail" src="<?= $model->cover['thumb'] ?>"></a>
        </div>
        <div class="col-sm-12 col-md-7">
            <h3><a href="<?= Url::toRoute(['sale/index', 'id' => $model->id]) ?>"><?= Html::encode($model->name) ?></a></h3>
            <p><?= $model->region->content->name ?>, <span class="text-muted"><?= $model->district->content->name ?></span></p>
            <ul class="list-unstyled">
                <li><i class="fa fa-fw fa-th"></i> 1.460 Ft<sup>2</sup></li>
                <li><i class="fa fa-fw fa-columns"></i> 2 Beds</li>
                <li><i class="fa fa-fw fa-female"></i> 1,5 Bathrooms</li>
                <li><i class="fa fa-fw fa-truck"></i> 2 Garage</li>
                <li><i class="fa fa-fw fa-signal"></i> Internet</li>
            </ul>
            <p><a href="<?= Url::toRoute(['sale/index', 'id' => $model->id]) ?>" class="btn btn-primary" rel="nofollow">View More »</a></p>
        </div>
    </article>
</div>