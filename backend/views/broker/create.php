<?php

/* @var $this yii\web\View */
/* @var $model common\models\Broker */
/* @var $user common\models\User */

$this->title = Yii::t('app', 'Add agent');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Agents'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="agent-create">

    <?= $this->render('_form', [
        'model' => $model,
        'user' => $user,
    ]) ?>

</div>
