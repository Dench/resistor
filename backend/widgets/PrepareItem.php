<?php

namespace backend\widgets;

use backend\models\Parse;
use common\models\Sale;
use common\models\SaleLang;
use yii\base\Widget;

class PrepareItem extends Widget
{
    /** @var $sale Sale */
    public $sale;

    /** @var $model SaleLang */
    public $content;

    /** @var $model array */
    public $image;

    /** @var $origin array */
    public $origin;

    /** @var $parse Parse */
    public $parse;
    
    public function run()
    {
        return $this->render('prepareItem', [
            'sale' => $this->sale,
            'content' => $this->content,
            'image' => $this->image,
            'origin' => $this->origin,
            'parse' => $this->parse
        ]);
    }
}