<?php
Yii::setAlias('common', dirname(__DIR__));
Yii::setAlias('frontend', dirname(dirname(__DIR__)) . '/frontend');
Yii::setAlias('backend', dirname(dirname(__DIR__)) . '/backend');
Yii::setAlias('console', dirname(dirname(__DIR__)) . '/console');

if (isset($_SERVER['SERVER_NAME'])) {
    define('BASE_HOST', str_replace(['admin.','www.'],'',$_SERVER['SERVER_NAME']));
} else {
    define('BASE_HOST', '');
}