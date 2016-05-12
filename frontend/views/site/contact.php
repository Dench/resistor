<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = Yii::t('app', 'Contact');
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="wrapper-md">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-4">
                <h3>Contact data</h3>
                <div class="well">
                    <p><i class="fa fa-map-marker"></i> 2637 Ridge Road, Wichita, KS 67202</p>
                    <p><i class="fa fa-phone"></i> 620-860-3068</p>
                    <p><i class="fa fa-phone"></i> 620-860-3068</p>
                    <p><i class="fa fa-envelope"></i> info@business.com</p>
                    <!--<hr>
                    <p>
                    </p><ul class="social-networks">
                        <li><a class="btn btn-twitter" href="#link"><i class="fa fa-fw fa-twitter"></i></a></li>
                        <li><a class="btn btn-facebook" href="#link"><i class="fa fa-fw fa-facebook"></i></a></li>
                        <li><a class="btn btn-google-plus" href="#link"><i class="fa fa-fw fa-google-plus"></i></a></li>
                        <li><a class="btn btn-pinterest" href="#link"><i class="fa fa-fw fa-pinterest"></i></a></li>
                        <li><a class="btn btn-linkedin" href="#link"><i class="fa fa-fw fa-linkedin"></i></a></li>
                        <li><a class="btn btn-youtube" href="#link"><i class="fa fa-fw fa-youtube"></i></a></li>
                        <li><a class="btn btn-vimeo" href="#link"><i class="fa fa-fw fa-vimeo-square"></i></a></li>
                        <li><a class="btn btn-tumblr" href="#link"><i class="fa fa-fw fa-tumblr"></i></a></li>
                        <li><a class="btn btn-instagram" href="#link"><i class="fa fa-fw fa-instagram"></i></a></li>
                        <li><a class="btn btn-flickr" href="#link"><i class="fa fa-fw fa-flickr"></i></a></li>
                        <li><a class="btn btn-dribbble" href="#link"><i class="fa fa-fw fa-dribbble"></i></a></li>
                        <li><a class="btn btn-foursquare" href="#link"><i class="fa fa-fw fa-foursquare"></i></a></li>
                        <li><a class="btn btn-vk" href="#link"><i class="fa fa-fw fa-vk"></i></a></li>
                    </ul>
                    <p></p>-->
                </div><!-- /.well -->
            </div><!-- /.col -->
            <div class="col-sm-12 col-md-4">
                <h3>Contact by email</h3>
                <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>

                <?= $form->field($model, 'name') ?>

                <?= $form->field($model, 'email') ?>

                <?= $form->field($model, 'subject') ?>

                <?= $form->field($model, 'body')->textArea(['rows' => 6]) ?>

                <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                    'template' => '<div class="row"><div class="col-lg-6">{image}</div><div class="col-lg-6">{input}</div></div>',
                ]) ?>

                <div class="form-group">
                    <?= Html::submitButton(Yii::t('app', 'Send'), ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div><!-- /.col -->
            <div class="col-sm-12 col-md-4">
                <h3>Find us on the map</h3>
                <div class="padding-sm widget-dashed">
                    <div class="embed-wrapper">
                        <iframe width="425" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=S%C3%A3o+Paulo,+Brazil&amp;aq=0&amp;oq=S%C3%A3o+Paulo&amp;sll=-14.264383,-51.943359&amp;sspn=52.984978,79.013672&amp;ie=UTF8&amp;hq=&amp;hnear=S%C3%A3o+Paulo,+Brazil&amp;t=m&amp;z=9&amp;ll=-23.55052,-46.633309&amp;output=embed"></iframe>
                    </div>
                </div>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div>
</section>
