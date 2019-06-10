<?php

use yii\helpers\Url;
use rmrevin\yii\fontawesome\FAS;

function getHeadOfAccountingMobileNavItems()
{
    return [
        ['label' => FAS::icon('home') . ' ' .
            'Начальная', 'url' => Url::home()],
        '<div class="dropdown-divider"></div>',
        ['label' => FAS::icon('shopping-cart') . ' ' .
            'Заказы', 'url' => Url::to(['table/order'])],
        ['label' => FAS::icon('users') . ' ' .
            'Заказчики', 'url' => Url::to(['table/customer'])],
        ['label' => FAS::icon('briefcase') . ' ' .
            'Рабочие объекты', 'url' => Url::to(['table/work-object'])],
        '<div class="dropdown-divider"></div>',
        ['label' => FAS::icon('truck') . ' ' .
            'Выходы на объекты', 'url' => Url::to(['table/exit-to-object'])],
        ['label' => FAS::icon('hard-hat') . ' ' .
            'Ремонтные бригады', 'url' => Url::to(['table/renovating-brigade'])],
        ['label' => FAS::icon('toolbox') . ' ' .
            'Снаряжения', 'url' => Url::to(['table/equipment'])],
        ['label' => FAS::icon('thumbtack') . ' ' .
            'Рабочие задачи', 'url' => Url::to(['table/work-task'])],
        '<div class="dropdown-divider"></div>',
        ['label' => FAS::icon('boxes') . ' ' .
            'Вещи на складах', 'url' => Url::to(['table/item'])],
        ['label' => FAS::icon('warehouse') . ' ' .
            'Склады', 'url' => Url::to(['table/warehouse'])],
        ['label' => FAS::icon('tasks') . ' ' .
            'Задачи', 'url' => Url::to(['table/task'])],
        ['label' => FAS::icon('id-card') . ' ' .
            'Сотрудники', 'url' => Url::to(['table/employee'])],
    ];
}
