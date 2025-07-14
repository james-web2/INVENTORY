<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use app\models\Product;
use app\models\StockTransaction;

class ManagerController extends Controller
{
    public function beforeAction($action)
    {
        if (Yii::$app->user->isGuest) {
            throw new ForbiddenHttpException('You must login to access this section.');
        }

        $user = Yii::$app->user->identity;

        // ✅ List of approved manager emails
        $allowedManagers = ['jovialjaymol@gmail.com', 'johnkamau@gmail.com'];

        // ✅ Allow admin OR allowed manager
        if (
            $user->role === 'admin' || 
            ($user->role === 'manager' && in_array(strtolower($user->email), $allowedManagers))
        ) {
            return parent::beforeAction($action);
        }

        throw new ForbiddenHttpException('Access denied. You are not authorized.');
    }

    public function actionDashboard()
    {
        $totalProducts = Product::find()->count();
        $totalStockIn = StockTransaction::find()->where(['transaction_type' => 'IN'])->sum('quantity');
        $totalStockOut = StockTransaction::find()->where(['transaction_type' => 'OUT'])->sum('quantity');
        $lowStockProducts = Product::find()->where(['<', 'Quantity', 10])->all();

        $recent = StockTransaction::find()
            ->orderBy(['created_at' => SORT_DESC])
            ->limit(5)
            ->all();

        return $this->render('dashboard', [
            'totalProducts' => $totalProducts,
            'totalStockIn' => $totalStockIn,
            'totalStockOut' => $totalStockOut,
            'lowStockProducts' => $lowStockProducts,
            'recent' => $recent,
        ]);
    }
}
