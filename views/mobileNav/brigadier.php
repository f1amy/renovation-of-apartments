<?php

use yii\helpers\Url;
use rmrevin\yii\fontawesome\FAS;

function getBrigadierMobileNavItems()
{
    return [
        ['label' => FAS::icon('home') . ' ' .
            'Начальная', 'url' => Url::home()],
        '<div class="dropdown-divider"></div>',
        ['label' => FAS::icon('truck') . ' ' .
            'Выходы на объекты', 'url' => Url::to(['table/exit-to-object'])],
        ['label' => FAS::icon('hard-hat') . ' ' .
            'Ремонтные бригады', 'url' => Url::to(['table/renovating-brigade'])],
        ['label' => FAS::icon('toolbox') . ' ' .
            'Снаряжения', 'url' => Url::to(['table/equipment'])],
        ['label' => FAS::icon('thumbtack') . ' ' .
            'Рабочие задачи', 'url' => Url::to(['table/work-task'])],
    ];
}
