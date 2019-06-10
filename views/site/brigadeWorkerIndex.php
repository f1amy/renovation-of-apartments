<?php

/* @var $this yii\web\View */
use rmrevin\yii\fontawesome\FAS;

$this->title = 'Домашняя страница';
?>

<div class="site-index">

    <div class="container">

        <div class="jumbotron text-center bg-transparent">
            <h2>Добро пожаловать, <?= FAS::icon('user') ?> <?= Yii::$app->user->identity->username; ?>.</h2>
            <h2><small>Перейдите на вкладку слева <?= FAS::icon('arrow-left') ?>, чтобы начать работу.</small></h2>
        </div>

    </div>

</div>
