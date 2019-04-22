<?php

/* @var $this yii\web\View */

$this->title = 'Домашняя страница';
?>

<div class="site-index">

    <div class="body-content">

        <div class="jumbotron">
            <img src="/icons/icons8-room-100px-4.png" alt="Лого">
            <h2>Добро пожаловать, <?= Yii::$app->user->identity->username; ?>!</h2>
            <h2><small>Перейдите на вкладку слева ←, чтобы начать работу.</small></h2>
        </div>

    </div>

</div>
