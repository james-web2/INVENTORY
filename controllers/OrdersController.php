<?php
// controllers/OrdersController.php

namespace app\controllers;

use app\models\Sales;
use Yii;
use yii\web\Controller;
use app\models\Sale;
use yii\filters\AccessControl;

class OrdersController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function () {
                            return Yii::$app->user->identity->role === 'customer';
                        },
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $userId = Yii::$app->user->id;
        $orders = Sales::find()->where(['customer_id' => $userId])->orderBy(['SaleDate' => SORT_DESC])->all();

        return $this->render('index', [
            'orders' => $orders,
        ]);
    }
}
