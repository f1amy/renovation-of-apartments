<?php

include Yii::getAlias('@app/views/utility/renderLinks.php');

use yii\helpers\Url;

/* @var $this yii\web\View */
?>

<div class="side-nav">
    <h3>Навигация</h3>
    <div class="list-group">
        <?= renderLinks(
            [['label' => 'Начальная', 'link' => Url::home()]]
        ); ?>
    </div>

    <h4>Заказы</h4>
    <div class="list-group">
        <?= renderLinks([
            ['label' => 'Заказы', 'link' => Url::to(['table/order'])],
            ['label' => 'Договоры', 'link' => Url::to(['table/contract'])],
            ['label' => 'Заказчики', 'link' => Url::to(['table/customer'])],
            ['label' => 'Рабочие объекты', 'link' => Url::to(['table/work-object'])],
        ]); ?>
    </div>

    <h4>Выходы на объекты</h4>
    <div class="list-group">
        <?= renderLinks([
            ['label' => 'Выходы на объекты', 'link' => Url::to(['table/exit-to-object'])],
            ['label' => 'Снаряжения', 'link' => Url::to(['table/equipment'])],
            ['label' => 'Рабочие задачи', 'link' => Url::to(['table/work-task'])],
            ['label' => 'Ремонтные бригады', 'link' => Url::to(['table/renovating-brigade'])],
        ]); ?>
    </div>

    <h4>Остальное</h4>
    <div class="list-group">
        <?= renderLinks([
            ['label' => 'Склады', 'link' => Url::to(['table/warehouse'])],
            ['label' => 'Вещи на складах', 'link' => Url::to(['table/item'])],
            ['label' => 'Задачи', 'link' => Url::to(['table/task'])],
            ['label' => 'Сотрудники', 'link' => Url::to(['table/employee'])],
        ]); ?>
    </div>
</div>
