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

    <h4>Выходы на объекты</h4>
    <div class="list-group">
        <?= renderLinks([
            ['label' => 'Выходы на объекты', 'link' => Url::to(['table/exit-to-object'])],
            ['label' => 'Снаряжения', 'link' => Url::to(['table/equipment'])],
            ['label' => 'Рабочие задачи', 'link' => Url::to(['table/work-task'])],
            ['label' => 'Ремонтные бригады', 'link' => Url::to(['table/renovating-brigade'])],
        ]); ?>
    </div>
</div>
