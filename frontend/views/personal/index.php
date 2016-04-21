<?php
/* @var $this yii\web\View */
/* @var $user common\models\User */
/* @var $broker common\models\Broker */

use common\helpers\Format;
use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = Yii::t('app', 'Personal');
?>
<section class="wrapper-sm">
    <div class="container">

        <?= Html::a('<i class="fa fa-sign-out"></i> '.Yii::t('app', 'Logout'), ['site/logout'], ['data-method' => 'post', 'class' => 'btn btn-primary pull-right']) ?>
        <h1><?= $this->title ?></h1>

        <div class="row">
            <div class="col-md-5">
                <?php
                echo DetailView::widget([
                    'model' => $user,
                    'attributes' => [
                        'username',
                        [
                            'attribute' => 'password',
                            'value' => '******',
                        ],
                        'email',
                    ],
                ]);
                ?>
                <?= Html::a(Yii::t('app', 'Edit'), ['user'], ['class' => 'btn btn-primary']) ?>
            </div>
            <div class="col-md-7">
                <?php
                echo DetailView::widget([
                    'model' => $broker,
                    'attributes' => [
                        [
                            'attribute' => 'type_id',
                            'value' => $broker->typeName,
                        ],
                        [
                            'attribute' => 'name',
                            'label' => $broker->type_id ? Yii::t('app', 'Full name') : Yii::t('app', 'Name'),
                            'value' => $broker->name,
                        ],
                        'company',
                        [
                            'attribute' => 'phone',
                            'value' => Format::phone($broker->phone, 2),
                        ],
                        'email',
                        'address',
                        'contact',
                        'recommend',
                        'note_user',
                        [
                            'attribute' => 'sale_add',
                            'value' => $broker->sale_add ? Yii::t('app', 'Yes') : Yii::t('app', 'No'),
                        ],
                    ],
                ]);
                ?>
                <?= Html::a(Yii::t('app', 'Edit'), ['broker'], ['class' => 'btn btn-primary']) ?>
            </div>
        </div>

    </div>
</section>