<?php

/* @var $this yii\web\View */

$this->title = 'Домашняя страница';
?>

<div class="site-index">

    <div class="container">

        <div class="jumbotron">
            <h2>Добро пожаловать, <?= Yii::$app->user->identity->username; ?>.</h2>
            <h2><small>Перейдите на вкладку слева ←, чтобы начать работу.</small></h2>
        </div>

    </div>

</div>
