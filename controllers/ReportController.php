<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\User;
use app\models\Product;

class ReportController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index'); // Shows links to all reports
    }

    public function actionUsers()
    {
        $users = User::find()->all();
        return $this->render('users', ['users' => $users]);
    }

    public function actionProducts()
    {
        $products = Product::find()->all();
        return $this->render('products', ['products' => $products]);
    }

    public function actionExpired()
    {
        $expired = Product::find()
            ->where(['<', 'ExpiryDate', date('Y-m-d')])
            ->all();
        return $this->render('expired', ['expired' => $expired]);
    }

    public function actionStock()
    {
        // Assuming you have a StockTransaction model/table
        $transactions = \app\models\StockTransaction::find()->all();
        return $this->render('stock', ['transactions' => $transactions]);
    }
}
