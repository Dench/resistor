<?php

namespace common\widgets;
use common\models\Lang;
use yii\base\Widget;

class LangChange extends Widget
{
    public function run()
    {
        return $this->render('lang', [
            'current' => Lang::getCurrent(),
            'langs' => Lang::find()->where('id != :current_id', [':current_id' => Lang::getCurrent()->id])->all(),
        ]);
    }
}