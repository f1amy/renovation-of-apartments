<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
use rmrevin\yii\fontawesome\FAS;

$this->title = 'Домашняя страница';
?>

<div class="site-index">

    <div class="container">

        <div class="jumbotron text-center bg-transparent">
            <h2>Добро пожаловать, <?= Yii::$app->user->identity->username; ?>.</h2>
            <h2><small>Перейдите на вкладку слева ← <br>
                    или на ссылку снизу ↓, чтобы начать работу.</small></h2>
        </div>

        <div class="row justify-content-around">
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">Формы</h5>
                    <p class="card-text">Формы позволяют быстро создать информацию
                        сразу в несколько таблиц.</p>
                    <div class="card-links">
                        <?= Html::a(
                            FAS::icon('file-alt') .
                                ' Создание выхода на объект',
                            ['form/exit-to-object/create'],
                            ['class' => 'btn btn-primary']
                        ) ?>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>
