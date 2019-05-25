<?php
namespace app\commands;

use Yii;
use yii\console\Controller;

class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;

        $brigadeWorker = $auth->createRole('brigadeWorker');
        $auth->add($brigadeWorker);

        $brigadier = $auth->createRole('brigadier');
        $auth->add($brigadier);

        $headOfAccounting = $auth->createRole('headOfAccounting');
        $auth->add($headOfAccounting);

        $auth->assign($headOfAccounting, 1);
        $auth->assign($brigadier, 2);
        $auth->assign($brigadeWorker, 3);
        $auth->assign($brigadeWorker, 4);
        $auth->assign($brigadeWorker, 5);
        $auth->assign($brigadeWorker, 6);
        $auth->assign($brigadeWorker, 7);
    }
}
