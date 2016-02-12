<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\User;
use backend\components\SetColumn;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create User', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'username',
            'email:email',
            [
                'class' => SetColumn::className(),
                'attribute' => 'status',
                'filter' => User::getStatusList(),
                'name' => 'statusName',
                'cssClasses' => [
                    User::STATUS_DELETED => 'default',
                    User::STATUS_BANNED => 'warning',
                    User::STATUS_ACTIVE => 'success',
                ],
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
