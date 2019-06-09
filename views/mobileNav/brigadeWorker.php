<?php

use yii\helpers\Url;

function getBrigadeWorkerMobileNavItems()
{
    return [
        [
            'label' => 'Начальная',
            'url' => Url::home()
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
    ];
}
