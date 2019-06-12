<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap4\Breadcrumbs;
use rmrevin\yii\fontawesome\FAS;

Yii::$app->view->registerJs("
    $(document).ready(function () {
        const sidebarClientHeight = document.querySelector('.sidebar').clientHeight;
        const sidebarScrollHeight = document.querySelector('.sidebar').scrollHeight;
    
        if (sidebarScrollHeight > sidebarClientHeight) {
            if (sessionStorage.getItem('sidebarPosition') !== null) {
                document.querySelector('.sidebar').scrollTop =
                    sessionStorage.getItem('sidebarPosition');
                console.log('Sidebar position restored from session storage.');
            }
        
            window.onbeforeunload = () => {
                sessionStorage.setItem(
                    'sidebarPosition',
                    document.querySelector('.sidebar').scrollTop
                );
                console.log('Sidebar position saved to session storage.');
            }
        }
    });
    ",
    $this::POS_READY,
    'remember-sidebar-position'
);

$navBarNavItems = [
    Yii::$app->user->isGuest ? (Html::a(
        FAS::icon('sign-in-alt') . ' ' . 'Вход',
        Url::to(['site/login']),
        ['class' => 'nav-link']
    )) : ('<li class="nav-item">'
        . Html::beginForm([Url::to(['site/logout'])], 'post')
        . Html::submitButton(
            FAS::icon('user-circle') . ' ' .
                Yii::$app->user->identity->username . ' (Выйти)',
            ['class' => 'btn btn-link nav-link logout border-0']
        )
        . Html::endForm()
        . '</li>')
];

if (!Yii::$app->user->isGuest) {
    array_push(
        $navBarNavItems,
        [
            'label' => 'Навигация',
            'options' => ['class' => 'd-sm-none'],
            'items' => []
        ],
    );

    if (Yii::$app->user->can('headOfAccounting')) {
        include Yii::getAlias('@app/views/mobileNav/headOfAccounting.php');
        $navBarNavItems[1]['items'] = getHeadOfAccountingMobileNavItems();
    } else if (Yii::$app->user->can('brigadier')) {
        include Yii::getAlias('@app/views/mobileNav/brigadier.php');
        $navBarNavItems[1]['items'] = getBrigadierMobileNavItems();
    } else if (Yii::$app->user->can('brigadeWorker')) {
        include Yii::getAlias('@app/views/mobileNav/brigadeWorker.php');
        $navBarNavItems[1]['items'] = getBrigadeWorkerMobileNavItems();
    }
}

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

    <header>
        <?php
        NavBar::begin([
            'brandLabel' => '<img src="/icons/room.png" width="34" height="34" ' .
                ' class="d-inline-block align-top" alt="logo">'
                . ' ' . Yii::$app->name,
            'brandUrl' => Yii::$app->homeUrl,
            'innerContainerOptions' => ['class' => 'container-fluid'],
            'options' => [
                'class' => 'navbar navbar-expand-sm navbar-dark bg-dark',
            ],
        ]);
        echo Nav::widget([
            'options' => ['class' => 'navbar-nav ml-auto'],
            'items' => $navBarNavItems,
            'encodeLabels' => false
        ]);
        NavBar::end();
        ?>
    </header>

    <div class="container-fluid">
        <div class="row flex-sm-nowrap">

            <nav class="sidebar border-right col-xl-2 px-0 d-none d-sm-block">
                <?php
                if (Yii::$app->user->isGuest) {
                    $this->beginContent("@app/views/sideNav/guest.php");
                    $this->endContent();
                } else if (Yii::$app->user->can('headOfAccounting')) {
                    $this->beginContent("@app/views/sideNav/headOfAccounting.php");
                    $this->endContent();
                } else if (Yii::$app->user->can('brigadier')) {
                    $this->beginContent("@app/views/sideNav/brigadier.php");
                    $this->endContent();
                } else if (Yii::$app->user->can('brigadeWorker')) {
                    $this->beginContent("@app/views/sideNav/brigadeWorker.php");
                    $this->endContent();
                }
                ?>
            </nav>

            <div class="main-wrap bg-light col-xl">
                <main class="container border-left border-right bg-white mx-auto">
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
                </main>
            </div>

        </div>
    </div>

    <?php $this->endBody(); ?>
</body>

</html>
<?php $this->endPage(); ?>
