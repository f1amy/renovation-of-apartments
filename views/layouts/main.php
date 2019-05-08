<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\assets\AppAsset;
use app\widgets\Alert;
//use yii\bootstrap\Nav;
//use yii\bootstrap\NavBar;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;
use yii\helpers\Url;
use yii\helpers\Html;
//use yii\widgets\Breadcrumbs;
use yii\bootstrap4\Breadcrumbs;

AppAsset::register($this);
?>
<?php $this->beginPage(); ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">

<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="/favicon.png">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head(); ?>
</head>

<body>
    <?php $this->beginBody(); ?>

    <?php
    NavBar::begin([
        'brandLabel' => '<img src="/icons/room.png" width="34" height="34" ' .
            ' class="d-inline-block align-top" alt="logo">'
            . ' ' . Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        //'brandImage' => '/favicon.png',
        'options' => [
            'class' => 'navbar navbar-expand-lg navbar-dark bg-dark',
        ],
    ]);

    echo Nav::widget([
        'options' => ['class' => 'navbar-nav ml-auto'],
        'items' => [
            //['label' => 'Домашняя страница', 'url' => [Url::home()]],
            Yii::$app->user->isGuest ? ([
                'label' => 'Вход',
                'url' => [Url::to(['site/login'])]
            ]) : ('<li class="nav-item">'
                . Html::beginForm([Url::to(['site/logout'])], 'post')
                . Html::submitButton(
                    'Выйти (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'btn btn-link nav-link logout']
                )
                . Html::endForm()
                . '</li>'),
        ],
    ]);
    NavBar::end();
    ?>

    <div class="wrap">

        <?php
        if (Yii::$app->user->can('headOfAccounting')) {
            $this->beginContent("@app/views/sideNav/headOfAccountingSideNav.php");
            $this->endContent();
        } else if (Yii::$app->user->can('brigadier')) {
            $this->beginContent("@app/views/sideNav/brigadierSideNav.php");
            $this->endContent();
        } else if (Yii::$app->user->can('brigadeWorker')) {
            $this->beginContent("@app/views/sideNav/brigadeWorkerSideNav.php");
            $this->endContent();
        }
        ?>

        <div class="container">
            <?= Breadcrumbs::widget([
                'homeLink' => [
                    'label' => 'Домашняя страница',
                    'url' => Url::home()
                ],
                'links' => isset($this->params['breadcrumbs']) ?
                    $this->params['breadcrumbs'] : [],
            ]) ?>
            <?= Alert::widget() ?>
            <?= $content ?>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
            <p class="float-left">&copy; Про-ремонт <?= date('Y') ?> г.</p>
            <p class="float-right"><?= Yii::powered() ?></p>
        </div>
    </footer>

    <?php $this->endBody(); ?>
</body>

</html>
<?php $this->endPage(); ?>
