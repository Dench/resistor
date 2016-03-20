<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = Yii::t('app', 'Agents');
?>
<section class="wrapper-md">
    <div class="container">

        <h1><?= Html::encode($this->title) ?></h1>

        <div class="row">
            <div class="col-md-4">
            </div>
            <div class="col-md-4">
                <div class="widget padding-md">
                    <h3>Access your account</h3>
                    <form action="/login" role="form">
                        <div class="form-group">
                            <label for="exmaple-contact-email">Username</label>
                            <input type="text" name="username" class="form-control" id="exmaple-contact-email" placeholder="Username">
                        </div>
                        <div class="form-group">
                            <label for="example-contact-password">Password</label>
                            <input type="password" name="password" class="form-control" id="example-contact-password" placeholder="Your password">
                        </div>
                        <button type="submit" class="btn btn-primary">Access account</button>
                    </form>
                </div>
            </div>
            <div class="col-md-4">
            </div>
        </div>

    </div>
</section>
