<?php

use common\models\Group;
use yii\helpers\Html;
use yii\grid\GridView;
use common\models\User;
use backend\components\SetColumn;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Users');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box">
    <div class="box-body">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                [
                    'attribute' => 'id',
                    'headerOptions' => ['width' => '50'],
                ],
                'username',
                'email:email',
                [
                    'class' => SetColumn::className(),
                    'attribute' => 'group_id',
                    'filter' => Group::getList(),
                    'name' => 'group.name',
                ],
                [
                    'class' => SetColumn::className(),
                    'attribute' => 'status',
                    'filter' => User::getStatusList(),
                    'name' => 'statusName',
                    'cssClasses' => [
                        User::STATUS_DELETED => 'default',
                        User::STATUS_ACTIVE => 'success',
                    ],
                ],
                [
                    'attribute' => 'created_at',
                    'format' =>  ['date', 'dd.MM.Y']
                ],

                [
                    'class' => 'yii\grid\ActionColumn',
                    'headerOptions' => ['width' => '50'],
                    'template' => '{update} {delete}',
                ],
            ],
        ]); ?>
    </div>
    <div class="box-footer">
        <?= Html::a(Yii::t('app', 'Create'), ['create'], ['class' => 'btn btn-success']) ?>
    </div>
</div>
