<?php

use yii\helpers\Url;

function renderLinks($links)
{
    $currentUrl = strpos(Url::current(), '?') !== false
        ? substr(Url::current(), 0, strpos(Url::current(), '?'))
        : Url::current();

    $markup = '';

    foreach ($links as $link) {
        $classes = 'list-group-item list-group-item-action';

        if ($currentUrl == $link['link']) {
            $classes .= ' active';
        }

        $markup .= yii\helpers\Html::a(
            $link['label'],
            $link['link'],
            ['class' => $classes]
        );
    }

    return $markup;
}
