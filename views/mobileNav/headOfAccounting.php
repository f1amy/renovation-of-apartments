<?php

use yii\helpers\Url;

function getHeadOfAccountingMobileNavItems()
{
    return [
        [
            'label' => 'Начальная',
            'url' => Url::home()
        ],
        '<div class="dropdown-divider"></div>',
        [
            'label' => 'Заказы',
            'url' => Url::to('table/order')
        ],
        [
            'label' => 'Заказчики',
            'url' => Url::to('table/customer')
        ],
        [
            'label' => 'Рабочие объекты',
            'url' => Url::to('table/work-object')
        ],
        '<div class="dropdown-divider"></div>',
        [
            'label' => 'Выходы на объекты',
            'url' => Url::to('table/exit-to-object')
        ],
        [
            'label' => 'Снаряжения',
            'url' => Url::to('table/equipment')
        ],
        [
            'label' => 'Рабочие задачи',
            'url' => Url::to('table/work-task')
        ],
        [
            'label' => 'Ремонтные бригады',
            'url' => Url::to('table/renovating-brigade')
        ],
        '<div class="dropdown-divider"></div>',
        [
            'label' => 'Склады',
            'url' => Url::to('table/warehouse')
        ],
        [
            'label' => 'Вещи на складах',
            'url' => Url::to('table/item')
        ],
        [
            'label' => 'Задачи',
            'url' => Url::to('table/task')
        ],
        [
            'label' => 'Сотрудники',
            'url' => Url::to('table/employee')
        ],
    ];
}
