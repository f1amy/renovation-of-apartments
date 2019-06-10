<?php

include Yii::getAlias('@app/views/utility/renderSideNavLinks.php');

use yii\helpers\Url;
use rmrevin\yii\fontawesome\FAS;

/* @var $this yii\web\View */
?>

<small>Навигация</small>
<section class="list-group list-group-flush">
    <?= renderSideNavLinks(
        [['label' => FAS::icon('home') . ' ' . 'Начальная', 'link' => Url::home()]]
    ); ?>
</section>

<small>Выходы на объекты</small>
<section class="list-group list-group-flush">
    <?= renderSideNavLinks([
        ['label' => FAS::icon('truck') . ' ' .
            'Выходы на объекты', 'link' => Url::to(['table/exit-to-object'])],
        ['label' => FAS::icon('hard-hat') . ' ' .
            'Ремонтные бригады', 'link' => Url::to(['table/renovating-brigade'])],
        ['label' => FAS::icon('toolbox') . ' ' .
            'Снаряжения', 'link' => Url::to(['table/equipment'])],
        ['label' => FAS::icon('thumbtack') . ' ' .
            'Рабочие задачи', 'link' => Url::to(['table/work-task'])],
    ]) ?>
</section>
