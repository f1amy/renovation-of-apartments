<?php

namespace app\controllers\form;

use app\models\table\Contract;
use app\models\table\Customer;
use app\models\table\WorkObject;
use app\models\table\Order;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;

class OrderController extends \yii\web\Controller
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
        $contract = new Contract();
        $customer = new Customer();
        $workObject = new WorkObject();

        if ($contract->load(Yii::$app->request->post()) &&
            $customer->load(Yii::$app->request->post()) &&
            $workObject->load(Yii::$app->request->post())) {

            $isValid = $contract->validate() && $customer->validate() &&
                $workObject->validate();

            if ($isValid) {
                $contract->save();
                $customer->save();
                $workObject->save();

                $order = new Order();

                $order->contract_id = $contract->id;
                $order->customer_id = $customer->id;
                $order->work_object_id = $workObject->id;

                $order->save();

                return $this->redirect(['table/order/view', 'id' => $order->id]);
            }
        }

        return $this->render('create', [
            'contract' => $contract,
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

        $contract = Contract::findOne($order->contract_id);
        $customer = Customer::findOne($order->customer_id);
        $workObject = WorkObject::findOne($order->work_object_id);

        if ($contract->load(Yii::$app->request->post()) &&
            $customer->load(Yii::$app->request->post()) &&
            $workObject->load(Yii::$app->request->post())) {

            $isValid = $contract->validate() && $customer->validate() &&
                $workObject->validate();

            if ($isValid) {
                $contract->save(false);
                $customer->save(false);
                $workObject->save(false);

                return $this->redirect(['table/order/view', 'id' => $order->id]);
            }
        }

        return $this->render('update', [
            'order' => $order,
            'contract' => $contract,
            'customer' => $customer,
            'workObject' => $workObject,
        ]);
    }
}
