<?php

include Yii::getAlias('@app/views/utility/renderLinks.php');

use yii\helpers\Url;

/* @var $this yii\web\View */
?>

<nav class="side-nav border-right">
    <h6>Навигация</h6>
    <section class="list-group list-group-flush">
        <?= renderLinks(
            [['label' => 'Начальная', 'link' => Url::home()]]
        ); ?>
    </section>

    <h6>Выходы на объекты</h6>
    <section class="list-group list-group-flush border-bottom">
        <?= renderLinks([
            ['label' => 'Выходы на объекты', 'link' => Url::to(['table/exit-to-object'])],
            ['label' => 'Снаряжения', 'link' => Url::to(['table/equipment'])],
            ['label' => 'Рабочие задачи', 'link' => Url::to(['table/work-task'])],
            ['label' => 'Ремонтные бригады', 'link' => Url::to(['table/renovating-brigade'])],
        ]); ?>
    </section>
</nav>
