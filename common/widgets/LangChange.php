<?php

namespace common\widgets;
use common\models\Lang;

class LangChange extends \yii\bootstrap\Widget
{
    public function init() {}

    public function run() {
        return $this->render('lang', [
            'current' => Lang::getCurrent(),
            'langs' => Lang::find()->where('id != :current_id', [':current_id' => Lang::getCurrent()->id])->all(),
        ]);
    }
}