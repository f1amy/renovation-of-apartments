<?php

namespace app\controllers\form;

use app\models\table\Customer;
use app\models\table\WorkObject;
use app\models\table\Order;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;

class OrderController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['create', 'update'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['create', 'update'],
                        'roles' => ['headOfAccounting'],
                    ],
                ],
            ],
        ];
    }

    public function actionCreate()
    {
        $order = new Order();
        $customer = new Customer();
        $workObject = new WorkObject();

        if (
            $order->load(Yii::$app->request->post()) &&
            $customer->load(Yii::$app->request->post()) &&
            $workObject->load(Yii::$app->request->post())
        ) {
            $isValid = $order->validate([
                'contract_date', 'period_of_execution', 'status'
            ]) && $customer->validate() && $workObject->validate();

            if ($isValid) {
                $customer->save(false);
                $workObject->save(false);

                $order->customer_id = $customer->id;
                $order->work_object_id = $workObject->id;

                $order->save();

                return $this->redirect(['table/order/index']);
            }
        }

        return $this->render('create', [
            'order' => $order,
            'customer' => $customer,
            'workObject' => $workObject,
        ]);
    }

    public function actionUpdate($id)
    {
        $order = Order::findOne($id);

        if (!$order) {
            throw new NotFoundHttpException("Заказ не найден.");
        }

        $order->contract_date = \Yii::$app->formatter
            ->asDate($order->contract_date, 'php:d.m.Y');
        $order->period_of_execution = \Yii::$app->formatter
            ->asDate($order->period_of_execution, 'php:d.m.Y');

        $customer = Customer::findOne($order->customer_id);
        $workObject = WorkObject::findOne($order->work_object_id);

        if (
            $order->load(Yii::$app->request->post()) &&
            $customer->load(Yii::$app->request->post()) &&
            $workObject->load(Yii::$app->request->post())
        ) {
            $isValid = $order->validate([
                'contract_date', 'period_of_execution', 'status'
            ]) && $customer->validate() && $workObject->validate();

            if ($isValid) {
                $order->save(false);
                $customer->save(false);
                $workObject->save(false);

                return $this->redirect(['table/order/index']);
            }
        }

        return $this->render('update', [
            'order' => $order,
            'customer' => $customer,
            'workObject' => $workObject,
        ]);
    }
}
