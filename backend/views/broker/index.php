<?php

use backend\components\SetColumn;
use common\models\Broker;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\BrokerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Agents');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box">
    <div class="box-body">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                [
                    'attribute' => 'user_id',
                    'headerOptions' => ['width' => '50'],
                ],
                [
                    'class' => SetColumn::className(),
                    'attribute' => 'type_id',
                    'filter' => Broker::getTypeList(),
                    'name' => 'typeName',
                ],
                'name',
                'company',
                'phone',
                'email:email',
                'address',
                // 'contact',
                // 'recommend',
                // 'note_user:ntext',
                // 'note_admin:ntext',
                // 'sale_add',

                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]); ?>
    </div>
    <div class="box-footer">
        <?= Html::a(Yii::t('app', 'Add agent'), ['create', 'type_id' => 1], ['class' => 'btn btn-success']) ?>
        <?= Html::a(Yii::t('app', 'Add company'), ['create', 'type_id' => 2], ['class' => 'btn btn-success']) ?>
    </div>
</div>
