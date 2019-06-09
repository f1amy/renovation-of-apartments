<?php

include Yii::getAlias('@app/views/utility/renderSideNavLinks.php');

use yii\helpers\Url;

/* @var $this yii\web\View */
?>

<small>Навигация</small>
<section class="list-group list-group-flush">
    <?= renderSideNavLinks(
        [['label' => 'Начальная', 'link' => Url::home()]]
    ); ?>
</section>

<small>Выходы на объекты</small>
<section class="list-group list-group-flush">
    <?= renderSideNavLinks([
        ['label' => 'Выходы на объекты', 'link' => Url::to(['table/exit-to-object'])],
        ['label' => 'Снаряжения', 'link' => Url::to(['table/equipment'])],
        ['label' => 'Рабочие задачи', 'link' => Url::to(['table/work-task'])],
        ['label' => 'Ремонтные бригады', 'link' => Url::to(['table/renovating-brigade'])],
    ]); ?>
</section>
