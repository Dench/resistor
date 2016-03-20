<?php

use frontend\widgets\SaleItem;
use yii\helpers\Url;

?>

<?php
    echo SaleItem::widget([
        'col' => 'col-sm-6 col-md-3',
        'id' => $model->id,
        'url' => Url::toRoute(['sale/index', 'id' => $model->id]),
        'cover' => $model->cover['small'],
        'name' => $model->name,
        'region' => $model->region->content->name,
        'district' => $model->district->content->name,
        'price' => $model->price,
        'bedroom' => $model->bedroom,
        'bathroom' => $model->bathroom
    ]);
?>