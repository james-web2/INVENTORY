<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Product;
use app\models\User;
use app\models\StockTransaction;

class AdminController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => \yii\filters\AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'], // Only logged-in users
                        'matchCallback' => function ($rule, $action) {
                            $user = Yii::$app->user->identity;

                            // ✅ Allow admins
                            if ($user->role === 'admin') {
                                return true;
                            }

                            // ✅ Also allow certain managers by email
                            $allowedManagerEmails = [
                                'johnkamau@gmail.com',
                                'jovialjaymol@gmail.com',
                            ];

                            return $user->role === 'manager' && in_array(strtolower($user->email), $allowedManagerEmails);
                        },
                    ],
                ],
            ],
        ];
    }

    public function actionDashboard()
    {
        return $this->render('dashboard', [
            'productCount' => Product::find()->count(),
            'userCount' => User::find()->count(),
            'expiredCount' => Product::find()->where(['<', 'ExpiryDate', date('Y-m-d')])->count(),
            'recentTransactions' => StockTransaction::find()->orderBy(['created_at' => SORT_DESC])->limit(5)->all(),
        ]);
    }
}
