<?php
namespace frontend\widgets;

use yii\base\Widget;

class SaleItem extends Widget
{
    public $col;
    public $id;
    public $cover;
    public $name;
    public $region;
    public $district;
    public $price;
    public $bedroom;
    public $bathroom;
    public $url;

    public function init()
    {
        parent::init();
    }

    public function run()
    {
        return $this->render('saleItem', [
            'item' => $this
        ]);
    }
}