<?php
/**
 * Created by PhpStorm.
 * User: dench
 * Date: 12.07.16
 * Time: 19:35
 */

namespace common\widgets;


use yii\base\Widget;

class BootstrapSlider extends Widget
{
    public $id = 'ex';

    public $min;

    public $max;

    public $val_min;

    public $val_max;
    
    public $step = 1000;
    
    public $currency = '€';

    public function run()
    {
        echo '<span class="ex-wrap"><b class="ex-slider-label">' . $this->currency . ' <span class="ex-slider-min">' . $this->val_min . '</span></b> <input id="' . $this->id . '" style="display: none;" data-slider-id="exSlider" data-slider-min="' . $this->min . '" data-slider-max="' . $this->max . '" data-slider-step="' . $this->step . '" data-slider-value="[' . $this->val_min . ',' . $this->val_max . ']"/> <b class="ex-slider-label">' . $this->currency . ' <span class="ex-slider-max">' . $this->val_max . '</span></b></span>';
    }
}