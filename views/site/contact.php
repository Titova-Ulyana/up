<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var app\models\ContactForm $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;
use yii\captcha\Captcha;

$this->title = 'Где нас найти';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-contact">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="text-center">
        <h5>Мы на карте:</h5>
        <img src="../../assets/img/maps.png" class="w-50" alt="...">
    </div>
    <br>
    <div>
        <h5>Адрес:</h5><p>Плесецкая, д. 10</p>
        <h5>Телефон:</h5>
            <a href="tel:+79990009900">+7(999)000-99-00</a>
        <h5>Почта:</h5>
            <a href="mailto:flower24@mail.ru">flower24@mail.ru</a>
    </div>
</div>
