<?php

/* @var $this yii\web\View */

$this->title = 'Домашняя страница';
?>

<div class="site-index">

    <div class="jumbotron">

        <img src="/favicon.png" alt="Лого">
        <h1>Здравствуйте!</h1>
        <p class="lead">Для продолжения, пожалуйста, пройдите аутентификацию.</p>
        <a class="btn btn-primary" href="<?= yii\helpers\Url::to(['site/login']) ?>">Войти</a>

    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-4">
                <h2>О компании</h2>

                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Vel doloribus quod at consectetur laborum,
                eligendi dolores mollitia, iusto eveniet inventore nam rem. A dolor excepturi tenetur maxime dolorum,
                officiis exercitationem!</p>

                <p><a class="btn btn-default" href="#">Подробнее &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Структура компании</h2>

                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ullam, earum in? Repellendus, accusamus
                itaque officia blanditiis nesciunt dolores id odit consequatur porro atque quidem eaque dicta commodi
                dolorum aut. Consectetur?</p>

                <p><a class="btn btn-default" href="#">Подробнее &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Контакты</h2>

                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Odit unde repellat iste culpa fuga eum nisi
                voluptatum, illo, ratione placeat blanditiis ut consequuntur delectus ab voluptatem, provident suscipit
                rerum deleniti.</p>

                <p><a class="btn btn-default" href="#">Подробнее &raquo;</a></p>
            </div>
        </div>

    </div>
</div>
