<?php

include Yii::getAlias('@app/views/utility/renderLinks.php');

use yii\helpers\Url;

use rmrevin\yii\fontawesome\FAS;

/* @var $this yii\web\View */
?>

<nav class="side-nav border-right">
    <h6>Навигация</h6>
    <section class="list-group list-group-flush">
        <?= renderLinks(
            [['label' => FAS::icon('home') . ' ' . 'Начальная', 'link' => Url::home()]]
        ); ?>
    </section>

    <h6>Заказы</h6>
    <section class="list-group list-group-flush">
        <?= renderLinks([
            ['label' => FAS::icon('shopping-cart') . ' ' . 'Заказы', 'link' => Url::to(['table/order'])],
            ['label' => FAS::icon('file-contract') . ' ' . 'Договоры', 'link' => Url::to(['table/contract'])],
            ['label' => FAS::icon('users') . ' ' . 'Заказчики', 'link' => Url::to(['table/customer'])],
            ['label' => FAS::icon('briefcase') . ' ' . 'Рабочие объекты', 'link' => Url::to(['table/work-object'])],
        ]); ?>
    </section>

    <h6>Выходы на объекты</h6>
    <section class="list-group list-group-flush">
        <?= renderLinks([
            ['label' => FAS::icon('truck') . ' ' . 'Выходы на объекты', 'link' => Url::to(['table/exit-to-object'])],
            ['label' => FAS::icon('toolbox') . ' ' . 'Снаряжения', 'link' => Url::to(['table/equipment'])],
            ['label' => FAS::icon('thumbtack') . ' ' . 'Рабочие задачи', 'link' => Url::to(['table/work-task'])],
            ['label' => FAS::icon('hard-hat') . ' ' . 'Ремонтные бригады', 'link' => Url::to(['table/renovating-brigade'])],
        ]); ?>
    </section>

    <h6>Остальное</h6>
    <section class="list-group list-group-flush border-bottom">
        <?= renderLinks([
            ['label' => FAS::icon('warehouse') . ' ' . 'Склады', 'link' => Url::to(['table/warehouse'])],
            ['label' => FAS::icon('boxes') . ' ' . 'Вещи на складах', 'link' => Url::to(['table/item'])],
            ['label' => FAS::icon('tasks') . ' ' . 'Задачи', 'link' => Url::to(['table/task'])],
            ['label' => FAS::icon('id-card') . ' ' . 'Сотрудники', 'link' => Url::to(['table/employee'])],
        ]); ?>
    </section>
</nav>
