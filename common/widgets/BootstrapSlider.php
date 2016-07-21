<?php
/**
 * Created by PhpStorm.
 * User: dench
 * Date: 12.07.16
 * Time: 19:35
 */

namespace common\widgets;


use Yii;
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
        echo '<span class="ex-wrap"><span class="text-nowrap"><label>' . Yii::t('app', 'Price from') . '</label><b class="ex-slider-label-min">' . $this->currency . ' <span class="ex-slider-min">' . $this->val_min . '</span></b> <b class="ex-slider-label-max hidden-sm hidden-md hidden-lg"> ' . mb_strtolower(Yii::t('app', 'To'), 'UTF-8') . ' ' . $this->currency . ' <span class="ex-slider-max">' . $this->val_max . '</span></b></span> <input id="' . $this->id . '" style="display: none;" data-slider-tooltip="hide" data-slider-id="exSlider" data-slider-min="' . $this->min . '" data-slider-max="' . $this->max . '" data-slider-step="' . $this->step . '" data-slider-value="[' . $this->val_min . ',' . $this->val_max . ']"/> <b class="ex-slider-label-max hidden-xs">' . $this->currency . ' <span class="ex-slider-max">' . $this->val_max . '</span></b></span>';
    }
}